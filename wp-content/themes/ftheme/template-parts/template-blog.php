<?php
/* Template Name: Blog */
//this is same as single products
get_header(); ?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <?php include( get_template_directory() . '/template-parts/blog/featured-post.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/blog/categories.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/blog/blog-post-list.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>

    </main>
</div>
<?php
get_footer();