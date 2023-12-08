<?php
$news_block = get_field('news');

$args = array(
    'post_type' => 'post',
    'posts_per_page' => '9',
);

if( $news_block ):
?>

<section class="news wrapper blog-post-carousel">
    <div class="container">
        <div class="wrapper lg-down blog-posts-carousel">
            <div class="container">
                <div class="header">
                    <h2 class="title heading wrapper wrappes_size_xl"><?= $news_block['title']; ?></h2>

                    <div class="buttons-wrapper">
                        <button id="button-previous" class="button" type="button" aria-label="Previous slide">
                            <svg class="arrow flipped" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 24">
                                <defs />
                                <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M2 2l10 10L2 22" />
                            </svg>
                        </button>
                        <button id="button-next" class="button" type="button" aria-label="Next slide">
                            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 24">
                                <defs />
                                <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M2 2l10 10L2 22" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $news_slider_posts = new WP_Query( $args );
        
        if( $news_slider_posts->have_posts() ):
        ?>
        <div class="swiper" id="items-wrapper">
            <div class="swiper-wrapper">

            <?php
            while( $news_slider_posts->have_posts() ): $news_slider_posts->the_post(); 
                $categories = get_the_category();
            ?>
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
                            <a href="<?php the_permalink(); ?>"
                                class="read-more button wrapper wrapper_size_xs"><?= $news_block['item_footer_text']; ?></a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile; ?>
            </div>
        </div>
        <div id="swiper-pagination" class="swiper-pagination"></div>
        <?php
        endif; 
        
        wp_reset_postdata(); ?>
    </div>
</section>

<?php
endif; ?>