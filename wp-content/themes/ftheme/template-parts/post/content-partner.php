<?php
$partner_logo = get_field('logo');
$success_story_card = get_field('success_story_card');
?>
<div class="wrapper">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="hero wrapper">
            <div class="container hero__inner">
                <div class="hero__crumbs-wrapper">
                    <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners' )->ID));?>" class="link">partners</a>
                    <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners/clients' )->ID));?>" class="link"><?php pll_e('Clients'); ?></a>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="wrapper wrapper_size_xxl title"><?php the_title(); ?></h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/partner-hero-background-image.svg" alt="background image" class="hero__background-image">
        </section>
        <div class="content wrapper">
            <div class="content__inner container">
                <div class="content__content">
                    <?php the_content(); ?>
                </div>
                <div class="content__info-wrapper">
                    <div class="partner-info wrapper">
                        <div class="partner-info__logo-wrapper" style="background-color: <?php echo $partner_logo['logo_background_color']; ?>">
                        <?php
                        if( $partner_logo['logo_image'] ): ?>
                            <img src="<?php echo esc_url($partner_logo['logo_image']['url']); ?>" alt="partner logo" class="logo">
                        <?php
                        endif; ?>
                        </div>
                        <?php
                        if( have_rows('partner_info') ):
                            while( have_rows('partner_info') ): the_row();
                        
                                if( have_rows('items') ): ?>
                                <ul class="partner-info__items">
                                <?php
                                    while( have_rows('items') ): the_row(); 
                                    $value = get_sub_field('value');
                                    $text = get_sub_field('text');
                                    ?>
                                    <li class="partner-info__item">
                                        <strong><?= $value; ?></strong>
                                        <span><?= $text; ?></span>
                                    </li>
                                    <?php
                                    endwhile; ?>
                                </ul>
                                <?php
                                endif; 
                                
                                $partner_link = get_sub_field('partner_link');

                                if( $partner_link ):
                                    $link_url = $partner_link['url'];
                                    $link_title = $partner_link['title'];
                                    $link_target = $partner_link['target'] ? $partner_link['target'] : '_self';
                                ?>
                                    <div class="partner-info__link-wrapper">
                                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="partner-info__link"><?php echo esc_html( $link_title ); ?></a>
                                    </div>
                                <?php
                                endif; ?>
                        <?php
                            endwhile;
                        endif; ?>        
                    </div>

                    <?php
                    $success_story = get_sub_field('success_story'); 
                    
                    if( $success_story_card ):

                        $success_story = $success_story_card['success_story'];

                        if( $success_story ):

                        $description = get_field('description', $success_story->ID);
                    ?>
                        <article class="success-story-card wrapper">
                            <span class="success-story-card__category">success stories</span>
                            <h3 class="wrapper_size_xxl success-story-card__title"><?php echo $success_story->post_title; ?></h3>
                            <p class="success-story-card__description"><?= $description; ?></p>
                            <a href="<?php echo esc_url($success_story->url); ?>" class="success-story-card__read-more button wrapper wrapper_size_xs"><?= $success_story_card['footer_text']; ?></a>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/circles.svg" alt="circles" class="success-story-card__circles">
                        </article>
                    <?php
                        endif;
                    endif; ?>
                </div>
            </div>
        </div>

        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>
    </article>
</div>