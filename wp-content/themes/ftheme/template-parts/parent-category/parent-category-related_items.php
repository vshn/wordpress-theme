<?php
if( have_rows('related_items') ):
    while( have_rows('related_items') ): the_row();

    $title = get_sub_field('title');
?>

<section class="wrapper related-items">
    <div class="container">
        <h2 class="title"><?= $title; ?></h2>
        <?php
        if( have_rows('items') ): ?>
            <div class="items-wrapper">
            <?php
            while( have_rows('items') ): the_row(); 
            
            $link = get_sub_field('link');

            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="item"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
            <?php
            endwhile; ?>
            </div>
        <?php
        endif;
        ?>
    </div>
</section>
<?php
    endwhile;
endif;