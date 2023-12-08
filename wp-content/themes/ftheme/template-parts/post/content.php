<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftheme
 */

?>
<div class="wrapper">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        headerHomePage(); ?>
        <section class="m-blogSinglePost-hero wrapper">
            <div class="container inner">
                <div class="categories-wrapper">
                    <?php if (get_the_category()) { ?>
                    <?php
                            foreach((get_the_category()) as $category) { ?>
                    <span class="category">

                        <?php echo $category->cat_name; ?>
                    </span>
                    <?php } ?>
                    <?php } ?>
                </div>

                <h1 class="title heading heading_wrapper wrapper_size_xl wrapper_color_primary">
                    <?php echo the_title(); ?>
                </h1>
                <div class="date"> <?php echo the_date('j. M Y'); ?>
                </div>
            </div>

            <img class="background-image lg-hidden"
                src="<?php echo get_template_directory_uri() ?>/src/images/backgroundImageLgUp.svg" alt=""
                aria-hidden />
            <img class="background-image lg-visible"
                src="<?php echo get_template_directory_uri() ?>/src/images/backgroundImageLgDown.svg" alt=""
                aria-hidden />
        </section>

        <article class="wrapper m-blogSinglePost-content">
            <div class="container">
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

        <!-- TO DO: this should be dynamic -->
        <?php
        $author_id = get_the_author_meta('ID');
        $avatar_url = get_avatar_url($author_id, array('size' => 100));
        ?>
        <section class="wrapper m-blogSinglePost-author">
            <div class="container">
                <div class="items-wrapper">
                    <div class="image gatsby-image">
                    <?php 
                    if($avatar_url): ?>
                        <img class="avatar" src="<?php echo esc_url($avatar_url); ?>">
                    <?php
                    else : ?>
                        <img class="no-avatar" src="<?php echo get_template_directory_uri() ?>/src/images/no-avatar.svg">
                    <?php
                    endif; ?>
                    </div>
                    </img>
                    <div class="content">
                        <h3 class="name heading wrapper_size_lg"><?php the_author(); ?></h3>
                        <p class="description"><?php echo get_the_author_meta('description'); ?></p>
                    </div>
                </div>
            </div>
        </section>

        
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => '9',
        );
        ?>
        <section class="news wrapper">
            <div class="container">
                <div class="wrapper lg-down blog-posts-carousel">
                    <div class="container">
                        <div class="header">
                            <h2>Latest news </h2>

                            <div class="buttons-wrapper">
                                <button id="button-previous" class="button" type="button" aria-label="Previous slide">
                                    <svg class="arrow flipped" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 24">
                                        <defs />
                                        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="M2 2l10 10L2 22" />
                                    </svg>
                                </button>
                                <button id="button-next" class="button" type="button" aria-label="Next slide">
                                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 24">
                                        <defs />
                                        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="M2 2l10 10L2 22" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $news_slider_posts = new WP_Query( $args );
        
                if( $news_slider_posts->have_posts() ): ?>
                <div class="swiper" id="items-wrapper">
                    <div class="swiper-wrapper">
                    <?php
                    while( $news_slider_posts->have_posts() ): $news_slider_posts->the_post(); 
                        $categories = get_the_category(); ?>
                        <div class="swiper-slide">
                            <div class="blog-posts-carousel-item wrapper">
                                <div class="inner">
                                    <ul class="categories-wrapper">
                                    <?php
                                    foreach( $categories as $category ) { ?>
                                        <li class="category"><?= $category->name; ?></li>
                                        <?php
                                    } ?>
                                    </ul>
                                    <h2 class="title"><?php the_title(); ?></h2>
                                    <a href="<?php the_permalink(); ?>" class="read-more button wrapper wrapper_size_xs"><?php pll_e('Read more'); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile; ?>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <?php
                endif; 
                wp_reset_postdata(); ?>
            </div>
        </section>
        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>
    </article><!-- #post-## -->
</div>