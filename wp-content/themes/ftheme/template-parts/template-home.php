<?php
/* Template Name: Home */
get_header(); ?>
    <div id="content" class="site-content">
        <?php
        headerHomePage(); ?>
        <main id="main" class="page-main site-main" role="main">
            <?php include( get_template_directory() . '/template-parts/home/home-hero.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-advantages.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-solutions-product.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-news.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-upcoming-events.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-technology.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-partners.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-jobs.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-report.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/home/home-awards.php' ); ?>
            <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>



        </main>
    </div>
<?php
get_footer();
