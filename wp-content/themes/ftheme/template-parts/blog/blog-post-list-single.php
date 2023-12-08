<?php
$date = get_the_date();
$day = date('j', strtotime($date));
$month = date('M', strtotime($date));
?>
    <article class="wrapper blog-post-list-item">
        <div class="date">
            <span class='day'><?= $day; ?></span>
            <span class='month'><?= $month; ?></span>
        </div>
        <div>
            <h3 class='title' tag="h3" color="primary">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class='short-description'>
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="button wrapper wrapper_size_xs" class="header wrapper wrapper_size_xs">Read more</a>
        </div>
    </article>
<?php