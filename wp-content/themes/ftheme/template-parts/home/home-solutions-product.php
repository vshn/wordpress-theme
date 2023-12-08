<?php
if( have_rows('solutions_products') ):
    while( have_rows('solutions_products') ): the_row();

    $footer_text = get_sub_field('item_footer_text');

    if( have_rows('items') ):
?>
    <section class="wrapper solutions-product">
        <div class="container md-hidden">
            <div class="content">
            <?php
            
            while( have_rows('items') ): the_row();

            $title = get_sub_field('title');
            $description = get_sub_field('description'); 
            $footer_url = get_sub_field('footer_url'); ?>
                <div class="item-wrapper" >
                    <h2 class="title"><?= $title; ?></h2>
                    <p class="description"><?= $description; ?></p>
                    <?php
                    if( have_rows('list') ): 
                    $counter = 1; ?>
                    <ul class="list">
                    <?php
                        while( have_rows('list') ): the_row(); ?>
                        <li class="item" key={index}>
                            <div class="number">
                                <span><?= $counter; ?></span>
                            </div>
                            <?= get_sub_field('item'); ?>
                        </li>
                        <?php

                        $counter++;
                        endwhile;?>
                    </ul>
                    <?php
                    endif; ?>

                    <a href="<?php echo esc_url($footer_url['url']); ?>" class="button wrapper wrapper_size_md">Learn more</a>
                </div>
            <?php 
                endwhile; ?>
            </div>
        </div>
    </section>
<?php
    endif;

    endwhile;
endif;