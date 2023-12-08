<?php
$hero_image = get_field('jobs_hero_image');
?>

<section class="jobs-hero wrapper">
    <div class="wrapper-inner">
        <div class="container inner">
            <div class="breadcrumbs">
                <a class="link" href="/about">About</a>
                <span><?php echo the_title();?></span>
            </div>
            <h1 class="title heading wrapper wrapper_size_xl">
                <?php echo the_title();?>
            </h1>
        </div>
    </div>
    <div class="image-wrapper">
        <div class="gatsby-image">
            <img class="image" src="<?php echo esc_url($hero_image['url']); ?>"></img>
        </div>
    </div>
</section>