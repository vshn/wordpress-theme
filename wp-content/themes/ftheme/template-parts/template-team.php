<?php
/* Template Name: Team */
get_header(); 

$hero_description = get_field('hero_description');
$team_members = 'team';

$team_terms = get_terms(array(
    'taxonomy' => 'team',
    'hide_empty' => false,
));

$args = array(
    'post_type' => $team_members,
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
);

$role_query = new WP_Query($args);
if( $role_query->have_posts() ) {
    while( $role_query->have_posts() ) {
        $role_query->the_post();

        $job_title = get_field('job_title');

        if ($job_title) {
            $job_titles[] = $job_title;
        }
    }

    wp_reset_postdata();
}

$job_titles = array_unique($job_titles);
sort( $job_titles );

?>
<div id="content" class="site-content">
    <?php
        headerHomePage(); ?>
    <main id="main" class="page-main site-main" role="main">
        <section class="s-products wrapper">
            <div class="container inner">
                <div class="breadcrumbs">
                    <a class="link" href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'about' )->ID));?>">ABOUT</a>
                    <span>Team</span>
                </div>
                <h1 class="title heading wrapper wrapper_size_xl"><?php the_title();?></h1>
                <p class="description"><?= $hero_description; ?></p>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/background-image-hero-team.svg" alt="hero background" class="background-image">
        </section>

        <section class="wrapper team-members">
            <div class="container">
                <div class="filters-wrapper">
                    <div class="select wrapper filter-team">
                        <button class="filter" type="button" aria-label="Filter">
                            <span class="label">Teams</span>
                            <div class="arrow">
                                <span class="left"></span><span class="right"></span>
                            </div>
                        </button>
                        <div class="items-wrapper">
                            <button class="item team-button" type="button" value="all">Teams</button>
                        <?php
                        foreach( $team_terms as $team_term ): ?>
                            <button class="item team-button" type="button" value="<?= $team_term->name; ?>"><?= $team_term->name; ?></button>
                        <?php
                        endforeach; ?>
                        </div>
                    </div>
                    <div class="select wrapper filter-role">
                        <button class="filter" type="button" aria-label="Filter">
                            <span class="label">Roles</span>
                            <div class="arrow">
                                <span class="left"></span><span class="right"></span>
                            </div>
                        </button>
                        <div class="items-wrapper">
                        <button class="item team-button" type="button" value="all">Roles</button>
                        <?php
                        foreach ($job_titles as $job_title): ?>
                            <button class="item role-button" type="button" value="<?= $job_title; ?>"><?= $job_title; ?></button>
                        <?php
                        endforeach; ?>   
                        </div>
                    </div>
                </div>
                
                <?php
                $members_query = new WP_Query($args);

                if( $members_query->have_posts() ):
                ?>
                <div class="list team-members-list">
                <?php
                while( $members_query->have_posts() ): $members_query->the_post(); 
                
                $job_title = get_field('job_title');
                $job_position = get_field('job_position');
                $image = get_field('image');

                $post_id = get_the_ID();
                $team_terms = get_the_terms($post_id, 'team');

                $current_terms = array();

                if ($team_terms) {
                    foreach ($team_terms as $term) {
                        $current_terms[] = $term->name;
                    }
                }
                
                // if ($job_title) {
                //     $current_terms[] = $job_title;
                // }

                $combined_terms = implode(' ', $current_terms);
                $combined_terms = str_replace(',', '', $combined_terms);
                ?>
                    <div class="item-wrapper team-member-card <?php echo $combined_terms; ?>" data-target-team="<?php echo $combined_terms; ?>" data-target-role="<?php echo $job_title; ?>">
                        <div class="image-wrapper">
                            <div class="gatsby-image image" alt="">
                            <?php
                            if( $image ): ?>
                                <img class="image" src="<?php echo esc_url($image['url']); ?>">
                            <?php
                            endif; ?>
                            </div>
                        </div>
                        <div class="content">
                            <div class="details">
                                <span class="job-title"><?= $job_title; ?></span>
                                <h4 class="name heading wrapper wrapper_size_lg"> <?php the_title(); ?> </h4>
                                <span class="job-position"><?= $job_position; ?></span>
                            </div>
                            <?php
                            if( have_rows('social_links') ): 
                                while( have_rows('social_links') ): the_row();
                                $email = get_sub_field('email');
                                $key = get_sub_field('key');
                                $ssh_key = get_sub_field('ssh_key');
                                $twitter = get_sub_field('twitter_link');
                                $linkedin = get_sub_field('linkedin_link');
                                $xing = get_sub_field('xing_link');
                                $github = get_sub_field('github_link');
                                $personal = get_sub_field('personal_link');
                                $mastodon = get_sub_field('mastodon_link');                                
                                ?>
                                <ul class="social-links">
                                <?php
                                if( $email ): ?>
                                    <li class="social-link-wrapper">
                                        <!-- NOTE STEFAN: This social_link_email class depends on icon social_link_$companuy -->
                                        <a class="social-link social-link_email" href="mailto:<?php echo $email ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 16 10" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.634 4.834c-.38.27-.89.27-1.27-.001L.639.066C.752.024.873 0 1.001 0h13.998c.128 0 .25.025.362.066L8.634 4.834zM15.872.487c.08.135.128.286.128.45v8.127a.888.888 0 01-.135.463L9.505 5 15.872.487zM.128.487A.888.888 0 000 .937v8.128a.88.88 0 00.135.462L6.495 5 .128.487zM8 5.66c.328 0 .656-.095.944-.275l6.398 4.554c-.107.037-.222.06-.343.06H1a1.07 1.07 0 01-.346-.06l6.4-4.554c.29.18.616.276.945.276z"
                                                    fill="#fff"></path>
                                            </svg>
                                        </a>
                                    </li>
                                <?php
                                endif;

                                if( $key ):
                                ?>
                                    <li class="social-link-wrapper">
                                        <!-- NOTE STEFAN: This social_link_email class depends on which social media is in use -->
                                        <a class="social-link social-link_key" href="<?php echo $key; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.737 5.938h-.474v-1.72c0-1.118-.449-2.191-1.248-2.982A4.286 4.286 0 006 0C4.87 0 3.785.444 2.985 1.236a4.197 4.197 0 00-1.248 2.983v1.718h-.474a1.27 1.27 0 00-.893.367c-.237.234-.37.552-.37.883v6.563c0 .332.133.65.37.884.237.234.558.366.893.366h9.474c.335 0 .656-.132.893-.366.237-.235.37-.553.37-.884V7.187c0-.331-.133-.649-.37-.883a1.27 1.27 0 00-.893-.367zM6 11.563c-.25 0-.494-.074-.702-.211a1.238 1.238 0 01-.191-1.923 1.267 1.267 0 011.376-.271c.231.094.428.254.567.46a1.24 1.24 0 01-.157 1.578 1.27 1.27 0 01-.893.367zm2.684-5.938a.31.31 0 01-.092.221.317.317 0 01-.224.091H3.632a.317.317 0 01-.224-.091.31.31 0 01-.092-.221V4.219c0-.705.283-1.38.786-1.879A2.699 2.699 0 016 1.563c.712 0 1.395.28 1.898.778.503.498.786 1.173.786 1.878v1.406z"
                                                    fill="#fff"></path>
                                            </svg>
                                        </a>
                                    </li>
                                <?php
                                endif;

                                if( $ssh_key ):
                                ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_sshKey" href="<?php echo $ssh_key; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><path d="M13.708 0h-1.75a.291.291 0 00-.206.086l-5.56 5.56a4.375 4.375 0 102.163 2.162l1.349-1.35 1.127.376a.583.583 0 00.759-.641l-.211-1.41.424-.423.849.386a.583.583 0 00.804-.688l-.295-1.056.754-.754A.291.291 0 0014 2.042V.292A.292.292 0 0013.708 0zM4.083 10.791a.875.875 0 11-1.75 0 .875.875 0 011.75 0z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif;

                                if( $twitter ):
                                ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_twitter" href="<?php echo $twitter; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg"><path d="M19.204 3.485a.403.403 0 00-.162-.703l-.64-.161a.404.404 0 01-.266-.566l.356-.72a.404.404 0 00-.47-.565l-1.618.452a.405.405 0 01-.356-.064 4.049 4.049 0 00-5.288.375 4.038 4.038 0 00-1.185 2.858v.29a.202.202 0 01-.178.202c-2.274.267-4.45-.889-6.797-3.588a.413.413 0 00-.413-.121.404.404 0 00-.234.34 6.12 6.12 0 00.372 3.976.202.202 0 01-.21.29l-.907-.177a.405.405 0 00-.461.477 4.159 4.159 0 001.918 3.055.202.202 0 010 .363l-.43.17a.405.405 0 00-.21.558 3.524 3.524 0 002.59 2.004.202.202 0 010 .38c-1.1.454-2.281.682-3.472.67a.412.412 0 10-.161.809 16.247 16.247 0 006.586 1.56c2.006.03 3.977-.532 5.664-1.617a10.108 10.108 0 004.5-8.43V4.9a.402.402 0 01.145-.307l1.327-1.108z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif; 
                                
                                if( $linkedin ): ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_linkedin" href="<?php echo $linkedin; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 17 18" xmlns="http://www.w3.org/2000/svg"><path d="M2.353 4.848a2.013 2.013 0 002.002-2.023A2.013 2.013 0 002.353.8 2.013 2.013 0 00.35 2.825c0 1.117.897 2.023 2.003 2.023zM3.984 6.467H.754a.404.404 0 00-.404.405v10.524c0 .223.18.405.404.405h3.23a.404.404 0 00.404-.405V6.872a.404.404 0 00-.404-.405zM16.096 17.8h-2.422a.403.403 0 01-.404-.404v-6.071c0-.537-.213-1.052-.591-1.431a2.016 2.016 0 00-3.446 1.43v6.072a.405.405 0 01-.404.405H6.406a.403.403 0 01-.403-.405V6.872a.405.405 0 01.403-.405H8.83a.403.403 0 01.404.405.332.332 0 00.412.323.33.33 0 00.169-.104 3.4 3.4 0 012.56-1.028c2.406 0 4.126 1.481 4.126 4.533v6.8a.405.405 0 01-.404.405z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif; 
                                
                                if( $xing ): ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_xing" href="<?php echo $xing; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg"><path d="M11.812.508c.143-.29.357-.508.713-.508h2.566a.54.54 0 01.356.145.47.47 0 010 .436l-5.63 10.16 3.563 6.678a.47.47 0 010 .436.539.539 0 01-.356.145h-2.566c-.356 0-.57-.29-.712-.508l-3.635-6.75c.214-.29 5.701-10.234 5.701-10.234zM1.48 3.699a.54.54 0 01.356-.145h2.566c.356 0 .57.29.712.508l1.782 3.12c-.143.146-2.78 4.936-2.78 4.936-.142.218-.356.508-.712.508H.91a.54.54 0 01-.357-.145.47.47 0 010-.435L3.19 7.183 1.48 4.134a.47.47 0 010-.435z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif; 
                                
                                if( $github ): ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_github" href="<?php echo $github; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 24 23" xmlns="http://www.w3.org/2000/svg"><path d="M12 .95C5.895.95.95 5.826.95 11.843c0 4.814 3.166 8.897 7.555 10.336.553.103.755-.234.755-.523 0-.26-.009-.945-.013-1.853-3.074.657-3.722-1.461-3.722-1.461-.503-1.258-1.23-1.594-1.23-1.594-1-.676.078-.662.078-.662 1.11.076 1.692 1.123 1.692 1.123.985 1.666 2.587 1.184 3.218.906.1-.705.384-1.184.7-1.457-2.454-.272-5.033-1.21-5.033-5.383 0-1.19.428-2.161 1.137-2.924-.124-.275-.497-1.383.097-2.883 0 0 .925-.292 3.039 1.117a10.754 10.754 0 012.762-.368c.94.006 1.879.126 2.763.368 2.1-1.409 3.025-1.117 3.025-1.117.594 1.5.22 2.608.11 2.883.705.763 1.133 1.735 1.133 2.924 0 4.185-2.583 5.106-5.042 5.374.387.327.746.995.746 2.016 0 1.458-.014 2.63-.014 2.983 0 .286.194.627.76.518 4.42-1.43 7.584-5.516 7.584-10.323C23.05 5.827 18.102.949 12 .949z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                
                                if( $personal ): ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_personal" href="<?php echo $personal; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg viewBox="0 0 16 14" xmlns="http://www.w3.org/2000/svg"><path d="M14.864 6.453L8.697.286a1.02 1.02 0 00-1.408 0l-6.21 6.21a.291.291 0 00.206.499h.875v6.708c0 .161.13.292.292.292h3.5c.16 0 .291-.13.291-.292V8.745h3.5v4.958c0 .161.131.292.292.292h3.5c.161 0 .292-.13.292-.292V6.994h.88a.29.29 0 00.298-.291.293.293 0 00-.14-.25z" fill="#fff"></path></svg>
                                        </a>
                                    </li>
                                <?php
                                endif; 
                                
                                if( $mastodon ): ?>
                                    <li class="social-link-wrapper">
                                        <a class="social-link social-link_mastodon" href="<?php echo $mastodon; ?>" target="_blank"
                                            rel="noopener noreferrer">
                                            <svg width="17" height="18" viewBox="0 0 15.954 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.823.403c-2.827 0-3.433.174-3.755.221C2.212.9.518 2.207.106 4.076c-.197.92-.22 1.941-.183 2.878.053 1.342.064 2.682.186 4.02.084.887.23 1.77.44 2.637.39 1.602 1.972 2.934 3.522 3.478a9.448 9.448 0 005.154.273c.188-.044.375-.096.558-.153.416-.132.903-.28 1.261-.539a.04.04 0 00.01-.014.039.039 0 00.006-.017v-1.296a.04.04 0 00-.004-.017.039.039 0 00-.026-.02.039.039 0 00-.017 0 14.285 14.285 0 01-3.345.391c-1.939 0-2.46-.92-2.609-1.303a4.03 4.03 0 01-.226-1.026c0-.006 0-.013.002-.019a.036.036 0 01.01-.013.036.036 0 01.017-.007.04.04 0 01.018 0c1.077.26 2.18.39 3.289.39.267 0 .533.001.8-.006 1.114-.031 2.289-.09 3.386-.303.027-.006.054-.01.078-.017 1.73-.332 3.375-1.375 3.542-4.015.006-.104.023-1.088.023-1.196 0-.366.117-2.6-.018-3.972-.249-1.848-1.859-3.304-3.768-3.586C11.89.577 10.67.403 7.844.403zM5.465 3.216c.93 0 1.634.358 2.103 1.073l.453.76.453-.76c.469-.715 1.172-1.073 2.102-1.073.803 0 1.452.283 1.947.834.479.552.717 1.297.717 2.235v4.59H11.42V6.42c0-.938-.39-1.416-1.185-1.416-.874 0-1.312.566-1.312 1.684v2.437H7.116V6.688c0-1.118-.439-1.684-1.313-1.684-.79 0-1.185.478-1.185 1.416v4.455H2.801v-4.59c0-.938.239-1.683.718-2.235.494-.551 1.142-.834 1.946-.834z" fill="#fff"></path><defs id="mastodon_inline_svg__defs191"><linearGradient id="mastodon_inline_svg__paint0_linear_89_8" x1="30.5" y1="0" x2="30.5" y2="65" gradientUnits="userSpaceOnUse" gradientTransform="scale(.42896)"><stop stop-color="#6364ff" id="mastodon_inline_svg__stop186"></stop><stop offset="1" stop-color="#563acc" id="mastodon_inline_svg__stop188"></stop></linearGradient></defs></svg>
                                        </a>
                                    </li>
                                <?php
                                endif; ?>
                                </ul>
                            <?php
                                endwhile;
                            endif; ?>
                        </div>
                    </div>
                <?php
                endwhile; ?>

                    <!-- Note: When there is no team members found -->
                    <p class="no-matches hidden">
                        <span class="icon"> </span>
                        No matches found
                    </p>
                </div>
                <?php
                endif; 
                wp_reset_postdata(); ?>
            </div>
        </section>
        <?php include( get_template_directory() . '/template-parts/general/general-jobs.php' ); ?>


    </main>
</div>
<?php
get_footer();