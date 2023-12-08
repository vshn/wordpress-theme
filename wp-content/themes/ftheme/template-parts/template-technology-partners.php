<?php
/* Template Name: Technology partners */
get_header(); 

?>

<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <section class="s-products wrapper">
            <div class="container inner">
                <div class="breadcrumbs">
                    <a class="link" href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners' )->ID));?>">Partners</a>
                    <span>technology partners</span>
                </div>
                <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-clients.svg" alt="hero background" class="background-image">
        </section>

        <?php

        if( have_rows('technology_partners_list') ): ?>
        <section class="technology-partners-list wrapper">
            <div class="container">
                <ul class="technology-partners-list__items-wrapper">
                <?php
                while( have_rows('technology_partners_list') ): the_row(); 

                    $logo = get_sub_field('logo');
                    $name = get_sub_field('name');
                    $url = get_sub_field('url');
                    ?>
                    <li class="technology-partners-list__item">
                        <a href="<?= esc_url( $url ); ?>" class="technology-partners-list__link" target="_blank" rel="noopener">
                            <div class="technology-partners-list__logo-wrapper">
                                <div class="logo gatsby-image-wrapper">
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="">
                                </div>
                            </div>
                            <p class="technology-partners-list__name"><?= $name; ?></p>
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