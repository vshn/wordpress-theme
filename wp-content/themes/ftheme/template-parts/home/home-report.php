<?php
$report_block = get_field('report');

$report_link = $report_block['button_link'];
$image = $report_block['image'];
?>

<section class="wrapper report">
    <div class="container inner">
        <div class="content">
            <h2 class="title" size="xl"><?= $report_block['title']; ?></h2>
            <p class="text"><?= $report_block['description']; ?></p>

            <?php
            if( $report_link ): 
                $link_url = $report_link['url'];
                $link_title = $report_link['title'];
                $link_target = $report_link['target'] ? $report_link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button wrapper wrapper_size_md"><?php echo esc_html( $link_title ); ?></a>
            
            <?php
            endif; ?>
        </div>

        <div class="illustration">
            <span class="rectangle rectangle-1"></span>
            <span class="rectangle rectangle-2"></span>
            <span class="rectangle rectangle-3"></span>
            <div class="image gatsby-image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="">
            </div>
        </div>
    </div>
</section>