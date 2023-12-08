<?php
/* Template Name: Jobs */
get_header(); ?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">

        <?php include( get_template_directory() . '/template-parts/jobs/jobs-hero.php' ); ?>
        <?php include( get_template_directory() . '/template-parts/jobs/jobs-content.php' ); ?>
    </main>
</div>
<?php
get_footer(); ?>