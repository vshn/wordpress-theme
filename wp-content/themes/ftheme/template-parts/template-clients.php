<?php
/* Template Name: Clients */
get_header();

$industries = get_terms(array(
    'taxonomy' => 'industry',
    'hide_empty' => false,
));

$infrastructures = get_terms(array(
    'taxonomy' => 'infrastructure',
    'hide_empty' => false
));

$technologies = get_terms(array(
    'taxonomy' => 'technology',
    'hide_empty' => false
));

$args = array(
    'post_type' => 'partner',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
);

?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <section class="s-products wrapper">
            <div class="container inner">
                <div class="breadcrumbs">
                    <a class="link" href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'partners' )->ID));?>"><?php pll_e('Clients'); ?></a>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-clients.svg" alt="hero background" class="background-image">
        </section>

        <section class="partners-list">
            <div class="container">
                <div class="filters-wrapper">
                    <div class="select wrapper filter-industry">
                        <button class="filter" type="button" aria-label="Filter">
                            <span class="label">Industry</span>
                            <div class="arrow">
                                <span class="left"></span><span class="right"></span>
                            </div>
                        </button>
                        <div class="items-wrapper">
                            <button class="item team-button" type="button" value="all">Industry</button>
                        <?php
                        foreach( $industries as $industry ): ?>
                            <button class="item" type="button" value="<?= $industry->name; ?>"><?= $industry->name; ?></button>
                        <?php
                        endforeach; ?>
                        </div>
                    </div>
                    <div class="select wrapper filter-infrastructure">
                        <button class="filter" type="button" aria-label="Filter">
                            <span class="label">Infrastructure</span>
                            <div class="arrow">
                                <span class="left"></span><span class="right"></span>
                            </div>
                        </button>
                        <div class="items-wrapper">
                            <button class="item team-button" type="button" value="all">Infrastructure</button>
                        <?php
                        foreach ($infrastructures as $infrastructure): ?>
                            <button class="item" type="button" value="<?= $infrastructure->name; ?>"><?= $infrastructure->name; ?></button>
                        <?php
                        endforeach; ?>   
                        </div>
                    </div>
                    <div class="select wrapper filter-technology">
                        <button class="filter" type="button" aria-label="Filter">
                            <span class="label">Technology</span>
                            <div class="arrow">
                                <span class="left"></span><span class="right"></span>
                            </div>
                        </button>
                        <div class="items-wrapper">
                            <button class="item team-button" type="button" value="all">Technology</button>
                        <?php
                        foreach ($technologies as $technology): ?>
                            <button class="item" type="button" value="<?= $technology->name; ?>"><?= $technology->name; ?></button>
                        <?php
                        endforeach; ?>   
                        </div>
                    </div>
                </div>

                <?php
                $partners_query = new WP_Query( $args );

                if( $partners_query->have_posts() ): ?>
                <ul class="partners-wrapper client-members-list">
                    <?php
                    while( $partners_query->have_posts() ): $partners_query->the_post(); 

                    $content = get_the_content();
                    $partner_info = get_field('partner_info');

                    if(!empty($content)): 
                        $partner_link = get_the_permalink();
                        $target = '_self';
                    else:
                        $partner_link = $partner_info['partner_link']['url'];
                        $target = '_blank';
                    endif;
                    
                    $industry_terms = wp_get_post_terms(get_the_ID(), 'industry');
                    $infrastructure_terms = wp_get_post_terms(get_the_ID(), 'infrastructure');
                    $technology_terms = wp_get_post_terms(get_the_ID(), 'technology');

                    $current_industry_terms = array();

                    if ($industry_terms) {
                        foreach ($industry_terms as $industry_term) {
                            $current_industry_terms[] = $industry_term->name;
                        }
                    }

                    $combined_industry_terms = implode(' ', $current_industry_terms);
                    $combined_industry_terms = str_replace(',', '', $combined_industry_terms);

                    $current_infrastructure_terms = array();

                    if ($infrastructure_terms) {
                        foreach ($infrastructure_terms as $infrastructure_term) {
                            $current_infrastructure_terms[] = $infrastructure_term->name;
                        }
                    }

                    $combined_infrastructure_terms = implode(' ', $current_infrastructure_terms);
                    $combined_infrastructure_terms = str_replace(',', '', $combined_infrastructure_terms);

                    $current_technology_terms = array();

                    if ($technology_terms) {
                        foreach ($technology_terms as $technology_term) {
                            $current_technology_terms[] = $technology_term->name;
                        }
                    }

                    $combined_technology_terms = implode(' ', $current_technology_terms);
                    $combined_technology_terms = str_replace(',', '', $combined_technology_terms);

                    
                    ?>
                    <li class="partner client-member-card" data-industry="<?php echo $combined_industry_terms; ?>" data-infrastructure="<?php echo $combined_infrastructure_terms; ?>" data-technology="<?php echo $combined_technology_terms; ?>" ><a href="<?php echo $partner_link; ?>" target=<?php echo $target; ?>  class="partner-link"><?php the_title(); ?></a></li>
                    <?php
                    endwhile; ?>

                    <!-- Note: When there is no team members found -->
                    <p class="no-matches hidden">
                        <span class="icon"> </span>
                        No matches found
                    </p>
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