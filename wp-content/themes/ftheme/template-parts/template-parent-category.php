<?php
/* Template Name: Parent Category */
get_header(); ?>
    <div id="content" class="site-content">
        <?php
        headerHomePage(); ?>
        <main id="main" class="page-main site-main" role="main">
            <?php include( get_template_directory() . '/template-parts/parent-category/parent-category-hero.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/parent-category/parent-category-sub_pages.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/parent-category/parent-category-related_items.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>


        </main>
    </div>
<?php
get_footer();
