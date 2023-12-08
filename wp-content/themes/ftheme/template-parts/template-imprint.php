<?php
/* Template Name: Imprint */
//this is same as single products
get_header(); ?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <?php include( get_template_directory() . '/template-parts/imprint/imprint-hero.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/imprint/imprint-content.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>

    </main>
</div>
<?php
get_footer();