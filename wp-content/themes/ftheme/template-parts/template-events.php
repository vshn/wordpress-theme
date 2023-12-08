<?php
/* Template Name: Events */
get_header();

$upcoming_events_group = get_field('upcoming_events');

$current_date = date('Y-m-d');
$current_year = date('Y');

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
?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <section class="s-products wrapper">
            <div class="container inner">
                <div class="breadcrumbs">
                    <a class="link" href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'learn' )->ID));?>">LEARN</a>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-content-events.svg" alt="hero background" class="background-image">
        </section>

        <section class="wrapper upcoming-events">
            <div class="container">
                <h2 class="title"><?= $upcoming_events_group['title']; ?></h2>
                <ul class="items-wrapper">
                <?php
                if( $upcoming_events->have_posts() ): ?>
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

                    <?php
                endif;
                wp_reset_postdata(); 
                    

                $next_year_start = date('Y-01-01', strtotime('+1 year'));

                $next_year_events_args = array(
                    'post_type' => 'cpt-events',
                    'posts_per_page' => -1,
                    'meta_key' => 'schedule_start_date',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'schedule_start_date',
                            'value' => $next_year_start, // First day of the next year
                            'compare' => '>=',
                            'type' => 'DATE',
                        ),
                    ),
                );

                $next_year_events = new WP_Query( $next_year_events_args );

                if( $next_year_events->have_posts() ):
                ?>
                    <div class="upcoming-events">
                        <h4 class="year-title"><?php echo $current_year+1; ?></h4>
                        <?php
                        while( $next_year_events->have_posts() ): $next_year_events->the_post(); 
                            $link = get_field('link');
                            $schedule = get_field('schedule');
                            $start_date_string = $schedule['start_date'];
                            $date = new DateTime($start_date_string);
                            $day = $date->format('d');
                            $month = $date->format('M');
                        
                            ?>
                            <li class="item">
                                <div class="date">
                                    <span class="day"><?= $day; ?></span>
                                    <?= $month; ?>
                                </div>
                                <div>
                                    <a href="<?php echo esc_url($link); ?>" class="item__event-title"><?php the_title(); ?></a>
                                    <div class="details"><span><?php the_field('description'); ?></span></div>
                                </div>
                            </li>
                        <?php
                        endwhile; ?>
                    </div>

                <?php
                endif; ?>
                </ul>
                
            </div>
        </section>


        <?php
        $all_events_args = array(
            'post_type' => 'cpt-events', // Change to your custom post type name
            'posts_per_page' => -1,
        );

        $all_events_query = new WP_Query($all_events_args);

        if( $all_events_query->have_posts() ):
            $events_years = array();

            while( $all_events_query->have_posts() ): $all_events_query->the_post();

            $schedule = get_field('schedule');
            $start_date = $schedule['start_date'];

            if ($start_date) {
                $year = date('Y', strtotime($start_date));
    
                // Make sure year only gets added once to array
                if (!in_array($year, $events_years) AND $year <= $current_year) {
                    $events_years[] = $year;
                }
            }

            endwhile;
        endif;
        arsort($events_years);
        ?>
        <section class="events-list">
            <div class="container">
                <h2 class="heading events-list__title">Past Events</h2>
                <?php
                if (!empty($events_years)): ?>
                <div class="events-list__years-wrapper">
                    <?php
                    foreach( $events_years as $event_year ): 
                        $active_class = ($current_year == $event_year) ? 'active' : '';
                        ?>
                        <a href="<?php echo pll_home_url() . 'past-events/' . $event_year; ?>" class="events-list__year <?php echo $active_class; ?>"><?= $event_year; ?></a>
                    <?php
                    endforeach; ?>
                </div>
                <?php
                endif; 
                
                wp_reset_postdata();
                
                $current_year_events_args = array(
                    'post_type' => 'cpt-events',
                    'posts_per_page' => -1,
                    'meta_key' => 'schedule_start_date',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'schedule_start_date',
                            'value' => date('Y-01-01'), // First day of the current year
                            'compare' => '>=',
                            'type' => 'DATE',
                        ),
                        array(
                            'key' => 'schedule_start_date',
                            'value' => $current_date, // Today's date
                            'compare' => '<=',
                            'type' => 'DATE',
                        ),
                    ),
                );
                
                $current_year_events = new WP_Query( $current_year_events_args );
                
                if( $current_year_events->have_posts() ): ?>
                <ul class="events-list__items-wrapper">
                <?php
                    while( $current_year_events->have_posts() ): $current_year_events->the_post(); 
                    
                        $link = get_field('link');
                        $schedule = get_field('schedule');
                        $start_date_string = $schedule['start_date'];
                        $date = new DateTime($start_date_string);
                        $day = $date->format('d');
                        $month = $date->format('M'); ?>

                        <li class="events-list__items-item">
                            <div class="events-list__date">
                                <span class="events-list__day"><?= $day ?></span>
                                <span><?= $month; ?></span>
                            </div>
                            <div>
                                <a href="<?= esc_url($link); ?>" class="events-list__event-title"><?php the_title(); ?></a>
                                <div class="events-list__item-details">
                                    <span><?php the_field('description'); ?></span>
                                </div>
                            </div>
                        </li>

                <?php
                    endwhile; ?>
                </ul>
                <?php
                endif;

                wp_reset_postdata(); ?>
            </div>
        </section>

        <?php include( get_template_directory() . '/template-parts/general/general-contact.php' ); ?>


    </main>
</div>
<?php
get_footer();