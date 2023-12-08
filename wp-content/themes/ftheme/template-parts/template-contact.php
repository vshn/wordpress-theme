<?php
/* Template Name: Contact */
get_header(); ?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <?php include( get_template_directory() . '/template-parts/contact/contact-hero.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/contact/contact-content.php' ); ?>

    </main>
</div>
<?php
get_footer();