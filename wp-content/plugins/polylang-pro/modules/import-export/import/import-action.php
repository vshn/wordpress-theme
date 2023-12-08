<?php
/**
 * @package Polylang-Pro
 */

/**
 * A class that handle the import action.
 *
 * @since 2.7
 *
 * Class PLL_Import_Action
 */
class PLL_Import_Action {

	/**
	 * Used to set import action name in forms.
	 *
	 * @var string
	 */
	const ACTION_NAME = 'pll_import';

	/**
	 * Used to create nonce for this action.
	 *
	 * @var string
	 */
	const NONCE_NAME = '_pll_import_nonce';

	/**
	 * Used to query languages and translations.
	 *
	 * @var PLL_Model
	 */
	private $model;

	/**
	 * @var PLL_Import_Uploader
	 */
	private $import_factory;

	/**
	 * The various import types.
	 *
	 * @var PLL_Import_Object_Interface[]
	 */
	private $imports;

	/**
	 * PLL_Import_Action constructor.
	 *
	 * @since 2.7
	 * @since 3.3 Add $imports parameter to handle the various import types.
	 *
	 * @param PLL_Model                     $model   Instance of PLL_Model.
	 * @param PLL_Import_Object_Interface[] $imports The import types.
	 */
	public function __construct( $model, $imports ) {
		$this->model = $model;
		$this->import_factory = new PLL_Import_Uploader();
		$this->imports = $imports;
	}

	/**
	 * Processes the import and redirects.
	 *
	 * @since 2.7
	 *
	 * @return void
	 */
	public function import() {
		$error = $this->_import();

		if ( $error->has_errors() ) {
			$error_codes = array(
				'pll_import_error',
				'pll_import_warning',
				'pll_import_updated',
			);

			foreach ( $error->get_error_codes() as $error_code ) {
				foreach ( $error->get_error_messages( $error_code ) as $message ) {
					$type = in_array( $error_code, $error_codes, true ) ? substr( $error_code, 11 ) : 'error';

					add_settings_error(
						'import-action',
						$error_code,
						$message,
						$type
					);
				}
			}
		}

		PLL_Settings::redirect();
	}

	/**
	 * Processes the imported objects retrieved in an import file.
	 *
	 * @since 2.7
	 *
	 * @return WP_Error
	 */
	protected function _import() {
		if ( empty( $_FILES['importFileToUpload']['name'] ) ) {
			// No uploaded file.
			return new WP_Error( 'pll_import_error', esc_html__( "Error: You haven't selected a file to be uploaded.", 'polylang-pro' ) );
		}

		$import = $this->import_factory->load( $_FILES['importFileToUpload'] ); //phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( is_wp_error( $import ) ) {
			// Error while uploading.
			return $import;
		}

		$is_targeted_site_valid = $this->is_valid_site( $import );
		if ( is_wp_error( $is_targeted_site_valid ) ) {
			return $is_targeted_site_valid;
		}

		$is_generator_valid = $this->is_valid_generator( $import );
		if ( is_wp_error( $is_generator_valid ) ) {
			return $is_generator_valid;
		}

		$target_language = $this->get_target_language( $import );
		if ( is_wp_error( $target_language ) ) {
			return $target_language;
		}

		$error = new WP_Error();

		$entry = $import->get_next_entry();
		while ( ! empty( $entry ) ) {
			if ( isset( $this->imports[ $entry['type'] ] ) ) {
				$this->imports[ $entry['type'] ]->translate( $entry, $target_language );
			}
			$entry = $import->get_next_entry();
		}

		foreach ( $this->imports as $import ) {
			$import_type = $import->get_type();
			$imported_objects_ids = $import->get_imported_object_ids();

			/**
			 * Fires after objects have been imported.
			 *
			 * @since 3.3
			 *
			 * @param PLL_Language $target_language      The targeted language for import.
			 * @param array        $imported_objects_ids The imported object ids of the import.
			 */
			do_action( "pll_after_{$import_type}_import", $target_language, $imported_objects_ids );

			$error->merge_from( $import->get_warning_notice() );
			$error->merge_from( $import->get_updated_notice() );
		}

		return $error;
	}

	/**
	 * Check if the current site corresponding on the targeted one in the import file.
	 *
	 * @since 3.3
	 *
	 * @param PLL_Import_File_Interface $import Import file.
	 * @return true|WP_Error
	 */
	public function is_valid_site( $import ) {
		if ( $import->get_site_reference() !== get_site_url() ) {
			return new WP_Error(
				'pll_import_error',
				esc_html__( 'Error: The site targeted in the imported file does not match the current site.', 'polylang-pro' )
			);
		}

		return true;
	}

	/**
	 * Check if the import file has been generated by Polylang Pro.
	 *
	 * @since 3.3
	 *
	 * @param PLL_Import_File_Interface $import Import file.
	 * @return true|WP_Error
	 */
	public function is_valid_generator( $import ) {
		if ( $import->get_generator_name() !== PLL_Import_Export::APP_NAME ) {
			return new WP_Error(
				'pll_import_error',
				esc_html(
					sprintf(
						/* translators: %s is the plugin's name. */
						__( 'Error: The imported file has not been generated by %s.', 'polylang-pro' ),
						POLYLANG
					)
				)
			);
		}

		return true;
	}

	/**
	 * Check if the targeted language is valid for the import.
	 *
	 * @since 3.3
	 *
	 * @param PLL_Import_File_Interface $import Import file.
	 * @return PLL_Language|WP_Error
	 */
	public function get_target_language( $import ) {

		$locale = $import->get_target_language();

		if ( false === $locale ) {
			return new WP_Error(
				'pll_import_error',
				esc_html__( 'Error: No target languages have been provided in the imported file.', 'polylang-pro' )
			);
		}
		$language = $this->model->get_language( $locale );
		if ( ! $language ) {
			return new WP_Error(
				'pll_import_error',
				esc_html__( "Error: You are trying to import a file in a language which doesn't exist on your site.", 'polylang-pro' )
			);
		}

		return $language;
	}
}
