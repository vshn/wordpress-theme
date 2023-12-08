<?php
/**
 * Template part for displaying hero section on Home page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftheme
 */


if( have_rows('hero') ):
    while( have_rows('hero') ): the_row();

    $description = get_sub_field('description');
    $link = get_sub_field('button_link');
?>

<section class="wrapper hero">
    <div class="container">
        <h1 class="title heading wrapper wrapper_size_xxl">
            <?= get_sub_field('title'); ?>
            <div class="typewriter" id="typewriter">
                <?php
            if( have_rows('animated_text') ):
                while( have_rows('animated_text') ): the_row(); 

                $typewriter_text = get_sub_field('text'); ?>
                <span class=typewriter-text>
                    <?php echo $typewriter_text; ?>
                </span>
                <?php
                endwhile;
            endif; ?>
            </div>
        </h1>
        <p class="description">
            <?= $description; ?>
        </p>
        <?php
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"
            class="button wrapper wrapper_size_md"><?php echo esc_html( $link_title ); ?></a>

        <?php
        endif; ?>

        <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/src/images/shape-1.svg"></img>
        <img class="shape-2" src="<?php echo get_template_directory_uri(); ?>/src/images/shape-2.svg"></img>



        <div class="animation-wrapper visible" id="animation-wrapper">
            <div class="animation animation-initial"></div>
            <div class="animation animation-loop hidden">
            
            </div>
        </div>

    </div>
</section>

<?php
    endwhile;
endif;