<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ftheme
 */

get_header(); ?>

<div id="content" class="site-content">
	<?php
    headerHomePage(); ?>

	<main id="main" class="page-main site-main" role="main">
		<div class="content content-404">
			<div class="container content-404__inner">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/404-error.svg" alt="404" class="content-404__image">
				<h1 class="content-404__title heading wrapper_size_xl">Ooops! Error page 404</h1>
				<p class="content-404__description">The page you requested could not be found</p>
				<a href="<?php echo home_url(); ?>" class="button wrapper wrapper_size_md">Back to home</a>
			</div>
		</div>
	</main>
</div>

<?php
get_footer();
