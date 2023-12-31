<?php

require_once(ABSPATH . 'wp-admin/includes/post.php');
use WPGatsby\Admin\Preview;

global $post;

$next_preview_url = get_field('next_preview_url', 'option');
$next_preview_secret = get_field('next_preview_secret', 'option');
$revisions = wp_get_post_revisions($post->ID);
$latest_revision = reset($revisions);

$post_data = array(
'slug' => $post->post_name,
'permalink' => get_sample_permalink($post->ID)[1],
'post_status' => $post->post_status,
'id' => $post->ID,
'post_type' => $post->post_type,
'secret' => $next_preview_secret,
); 

$post_data_json = json_encode($post_data);
$post_data_base64 = base64_encode($post_data_json);

$gatsby_content_sync_url = $next_preview_url .'/api/preview?data=' . $post_data_base64;
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Gatsby Preview</title>

	<style>
		<?php Preview::print_file_contents( 'includes/style.css' ); ?>
	</style>

	<script>
		<?php
			if ( $gatsby_content_sync_url ) {
				// Redirecting via JS because the page headers have already been set by the time we get into this template so PHP wont redirect.
				echo 'window.location.replace("'. $gatsby_content_sync_url .'");';
			}
		?>
	</script>
</head>

<body>
<div class="content error" style="<?php echo $gatsby_content_sync_url ? 'display: none;' : ''; ?>">
	<h1>The Preview couldn't be loaded</h1>
	<p>
		Please add your Gatsby Cloud Content Sync URL to the WPGatsby plugin <a
				href="<?php echo get_bloginfo( 'url' ); ?>/wp-admin/options-general.php?page=gatsbyjs"
				target="_blank" rel="noopener, nofollow. noreferrer, noopener, external"
		>settings page</a>.
	</p>
	<br>
	<pre id="error-message-element"></pre>
	<h2>Troubleshooting</h2>
	<span id="troubleshooting-html-area">
		<p>
			Please ensure your URL is correct and your Preview instance is up and running.
			<br>
			<br>
			If you've set the correct URL, your Preview instance is currently running, and you're still having trouble, please <a
					href="https://www.gatsbyjs.com/cloud/docs/wordpress/getting-started/" target="_blank"
					rel="noopener, nofollow. noreferrer, noopener, external">refer to the docs</a> for
			troubleshooting steps, ask your developer, or <a href="https://www.gatsbyjs.com/contact-us/" target="_blank"
										rel="noopener, nofollow. noreferrer, noopener, external">contact
				support</a> if that doesn't solve your issue.
			<br>
			<br>
			If you don't have a valid Gatsby Preview instance, you can <a
					href="https://www.gatsbyjs.com/preview/" target="_blank"
					rel="noopener, nofollow. noreferrer, noopener, external">set one up now on Gatsby
				Cloud.</a>
			</p>
	</span>
	<h2>Developer instructions</h2>
	<p>Please visit 
		<a
			href="https://github.com/gatsbyjs/gatsby/blob/master/packages/gatsby-source-wordpress/docs/tutorials/configuring-wp-gatsby.md#setting-up-preview" target="_blank"
			rel="noopener, nofollow. noreferrer, noopener, external"
		>
		the docs
		</a> for instructions on setting up Gatsby Preview.
	</p>
</div>
</body>

<?php wp_footer(); ?>

</html>