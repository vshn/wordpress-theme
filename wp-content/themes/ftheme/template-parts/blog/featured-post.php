<?php 
$imageLgUp = get_template_directory_uri() . '/src/images/backgroundImageLgUp.svg';
$imageLgDown = get_template_directory_uri() . '/src/images/backgroundImageLgDown.svg';

if( have_rows('featured_post') ):
    while( have_rows('featured_post') ): the_row();
        
        $featured_post = get_sub_field('post');

        if( $featured_post ):

        $post_day = get_the_date('j', $featured_post->ID);
        $post_month = get_the_date('M', $featured_post->ID);
?>

        <article class="wrapper featured-post">
            <div class="container inner">
                <div class="date">
                    <span class="day"><?= $post_day; ?></span>
                    <span class="month"><?= $post_month; ?></span>
                </div>

                <h2 class="title" tag="h2" class="heading wrapper wrapper_size_xl"><?php echo esc_html($featured_post->post_title); ?></h2>

                <div class="content">
                    <div class="short-description"><?php echo esc_html($featured_post->post_excerpt); ?></div>
                    <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>" class="button wrapper wrapper_size_xs" class="header wrapper wrapper_size_xs">Read more</a>
                </div>
            </div>

            <img class="background-image lg-hidden" src="<?php echo $imageLgUp ?>" alt="" aria-hidden />
            <img class=" background-image lg-visible" src="<?php echo $imageLgDown ?>" alt="" aria-hidden />
        </article>
<?php
        endif;
    endwhile;
endif;