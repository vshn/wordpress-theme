<?php
$current_date = date('Y-m-d');

$args = array(
    'post_type' => 'cpt-events',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_query' => array(
        array(
            'key' => 'schedule_start_date',
            'value' => $current_date,
            'compare' => '>=',
            'type' => 'DATE'
        )
    )
);

$upcoming_events = new WP_Query( $args );

if( $upcoming_events->have_posts() ):
?>

<section class="wrapper upcoming-events">
    <div class="container">
        <h1 class="title">Upcoming events</h1>
        <ul class="items-wrapper">
            <div class="cards-wrapper">
            <?php
            while( $upcoming_events->have_posts() ): $upcoming_events->the_post(); 
            
                $featured_image = get_field('logo');
                $schedule = get_field('schedule');
                $start_date_string = $schedule['start_date'];
                $date = new DateTime($start_date_string);
                $day = $date->format('d');
                $month = $date->format('M');
                $link = get_field('link');
                ?>
                <li class="wrapper">
                    <a href="<?= $link; ?>" class="inner">
                        <div class="date">
                            <span class="day"><?= $day; ?></span>
                            <?= $month; ?>
                        </div>
                        <div class="image-wrapper gatsby-image wrapper">
                            <img src="<?php echo $featured_image['url']; ?>" class="image" loading="lazy" />
                        </div>
                        <div class="content">
                            <h3 class="title heading wrapper_size_lg"><?php the_title(); ?></h3>
                            <span class="learn-more">Learn more</span>
                        </div>
                    </a>
                </li>
            <?php
            endwhile; ?>
            </div>
        </ul>
    </div>
</section>

<?php
endif;

wp_reset_postdata();