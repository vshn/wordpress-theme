<?php
if( have_rows('sub_pages') ):
    while( have_rows('sub_pages') ): the_row();

    $item_footer_text = get_sub_field('item_footer_text');

    if( have_rows('items') ):
        $counter = 1;
?>

<section class="wrapper sub-pages">
    <div class="container">
        <ul class="items-wrapper">
        <?php
        while( have_rows('items') ): the_row(); 
            $title = get_sub_field('title');
            $link = get_sub_field('link');
            $icon = get_sub_field('icon');
        ?>
            <li class="wrapper sub-pages-item">
                <a class="inner" href="<?php echo esc_url($link['url']); ?>">
                    <span class="number" class="heading wrapper wrapper_size_lg"><?= $counter; ?></span>
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="" class="image">
                    <div class="content">
                        <h3 class="title heading wrapper wrapper_size_lg"><?= $title; ?></h3>
                        <span class="footer-text"><?= $item_footer_text; ?></span>
                    </div>
                </a>
            </li>
        <?php
            $counter++;
        endwhile; ?>
        </ul>
    </div>
</section>

<?php
        endif;
    endwhile;
endif;