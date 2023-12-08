<?php
/* Template Name: Success Stories */
get_header(); 

$args = array(
    'post_type' => 'success_stories',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
);

?>

<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
    <section class="s-products wrapper">
            <div class="container inner">
                <div class="breadcrumbs">
                    <a class="link" href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners' )->ID));?>">Partners</a>
                    <span>success stories</span>
                </div>
                <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-clients.svg" alt="hero background" class="background-image">
        </section>

        <?php

        $stories_list = new WP_Query( $args );

        if( $stories_list->have_posts() ): ?>
        <section class="success-stories-list wrapper">
            <div class="container">
                <ul class="success-stories-list__items-wrapper">
                <?php
                while( $stories_list->have_posts() ): $stories_list->the_post(); 

                    $logo = get_field('logo');
                    ?>
                    <li class="success-stories-list__item">
                        <a href="<?php the_permalink(); ?>" class="success-stories-list__link">
                            <div class="success-stories-list__logo-wrapper">
                                <div class="logo gatsby-image-wrapper">
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="">
                                </div>
                            </div>
                            <div class="success-stories-list__footer-text">
                                Read more
                            </div>
                        </a>
                    </li>
                <?php
                endwhile; ?>
                </ul>
            </div>
        </section>
        <?php
        endif;

        wp_reset_postdata(); ?>

    <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>
    </main>
</div>
<?php
get_footer();