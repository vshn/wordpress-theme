<?php
/* Template Name: Products */
get_header(); ?>
<div id="content" class="site-content">
    <?php
    headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <?php include( get_template_directory() . '/template-parts/products/products-hero.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/products/products-sub_pages.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/products/products-related_items.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>


    </main>
</div>
<?php
get_footer();
