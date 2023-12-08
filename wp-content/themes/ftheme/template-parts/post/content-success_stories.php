<div class="wrapper">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="success-story-hero wrapper">
            <div class="container success-story-hero__inner">
                <div class="success-story-hero__crumbs-wrapper">
                    <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners' )->ID));?>" class="link">partners</a>
                    <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners/success-stories' )->ID));?>" class="link">success stories</a>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="wrapper wrapper_size_xxl title"><?php the_title(); ?></h1>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/hero-circles.svg" alt="hero circles" class="success-story-hero__circles">
            </div>
        </section>

        <section class="content wrapper">
            <div class="container content__inner">
                <div class="content__content">
                    <?php the_content(); ?>
                </div>
                
                    <div class="content__info-wrapper">
                    <?php
                        if( have_rows('partner_info') ):
                            while( have_rows('partner_info') ): the_row();
                            $partner_logo = get_sub_field('logo_in_card');
                            $logo_bg = get_sub_field('logo_background_color');
                        ?>
                            <div class="partner-info wrapper">
                                <div class="partner-info__logo-wrapper" style="background-color: <?= $logo_bg; ?>">
                                <?php
                                if( $partner_logo ): ?>
                                    <img src="<?php echo esc_url($partner_logo['url']); ?>" alt="partner logo" class="logo">
                                <?php
                                endif; ?>
                                </div>
                                <?php
                                
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
                            </div>
                        <?php
                            endwhile;
                        endif; 
                        
                        if( have_rows('facts') ):
                            while( have_rows('facts') ): the_row();

                            $title = get_sub_field('title');
                        ?>
                            <div class="facts wrapper">
                                <h3 class="facts__title"><?= $title; ?></h3>
                                <?php
                                if( have_rows('items') ): 
                                $counter = 1;
                                ?>
                                <ul class="facts__items-wrapper">
                                    <?php
                                    while( have_rows('items') ): the_row();
                                    $item = get_sub_field('item');
                                    ?>
                                    <li class="facts__item">
                                        <div class="facts__number">
                                            <span><?= $counter; ?></span>
                                        </div>
                                        <?= $item; ?>
                                    </li>
                                    <?php
                                    $counter++;
                                    endwhile; ?>
                                </ul>
                                <?php
                                endif; ?>
                            </div>
                        <?php
                            endwhile;
                        endif; ?>
                    </div>
                
            </div>
        </section>

        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>
    </article>
</div>