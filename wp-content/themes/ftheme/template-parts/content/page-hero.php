<?php

?>

<section class="s-products wrapper">
    <div class="container inner">
    <?php
    if( have_rows('breadcrumbs') ):
    ?>
        <div class="breadcrumbs">
        <?php
        while( have_rows('breadcrumbs') ): the_row(); 
            $link = get_sub_field('link');

            if( $link ) {
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
            <a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php
            }
        endwhile; ?>
            <span><?php the_title();?></span>
        </div>
    <?php
    endif; ?>
        <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
    </div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-content-page.svg" alt="hero background" class="background-image">
</section>