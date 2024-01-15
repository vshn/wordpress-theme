<?php
/**
 * ftheme functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package ftheme
 */

if( !class_exists('acf') ) {

    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Advanced Custom Fields plugin is not activated. Make sure you activate plugin at <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    } );
}

/**
 * Include after_theme setup functions
 * This is main file for including functions and all other theme related files
 */
include ( get_template_directory() . '/lib/theme/_ftheme-setup.php');

/**
 * Include ftheme register functions
 * @link ./lib/register/index.php
 */
include( get_template_directory() . '/lib/register/index.php' );

/**
 * Include acf setup functions
 * Note: this should be only setup for backend, any functions for template usage
 * should be created inside ftheme/inc/_partials
 * @link ./lib/acf/index.php
 */
include( get_template_directory() . '/lib/acf/index.php' );


function remove_tags_from_excerpt( $excerpt ) {
    return wp_strip_all_tags($excerpt);
  }
add_filter( 'the_excerpt', 'remove_tags_from_excerpt' );

function change_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'change_excerpt_length', 999 );

function custom_wp_nav_menu($menu, $args) {
    // Check if the current menu location is 'top-menu'
    if ($args->theme_location == 'top-menu') {
        // Remove <li> tags from the 'top-menu'
        $menu = strip_tags($menu, '<a>');
        $menu = preg_replace('/<a /', '<a class="list-item" ', $menu);
    }

    return $menu;
}
add_filter('wp_nav_menu', 'custom_wp_nav_menu', 10, 2);


function custom_rewrite_rules() {
    add_rewrite_rule(
        '^past-events/([0-9]{4})/?$',
        'index.php?post_type=cpt-events&year=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

function filter_posts() {
    $category = $_POST['category'];
    $page = isset($_POST['page']) ? $_POST['page'] : 1;

    $args = array(
        'posts_per_page' => 20,
        'post_type' => 'post',
        'paged' => $page,
        'post_status' => 'publish'
    );

    if ($category !== 'all') {
        $args['category_name'] = $category;
    }

    $posts_query = new WP_Query($args);

    $output = '';

    if ($posts_query->have_posts()) :
        ob_start();
        while ($posts_query->have_posts()) : $posts_query->the_post();

            include('template-parts/blog/blog-post-list-single.php');

        endwhile;
        $output = ob_get_clean();
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    $max_pages = ceil($posts_query->found_posts / $args['posts_per_page']);

    wp_send_json(array(
        'html' => $output,
        'max_pages' => $max_pages
    ));

    wp_die();
}
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');


add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

function my_ajax_pagination() {

    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $category = isset($_POST['category']) ? $_POST['category'] : 'all';

    $args = array(
        'posts_per_page' => 20,
        'post_type' => 'post',
        'paged' => $page
    );

    if ($category !== 'all') {
        $args['category_name'] = $category;
    }

    $posts_query = new WP_Query($args);

    $output = '';

    if ($posts_query->have_posts()) :
        ob_start();
        while ($posts_query->have_posts()) : $posts_query->the_post();

            include('template-parts/blog/blog-post-list-single.php');

        endwhile;
        $output = ob_get_clean();
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    $max_pages = ceil($posts_query->found_posts / $args['posts_per_page']);

    wp_send_json(array(
        'html' => $output,
        'max_pages' => $max_pages
    ));

    wp_die();
}

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'ftheme-lottie' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

pll_register_string('readmore', 'Read more');
pll_register_string('clients', 'Clients');

function add_sitemap_link_to_head() {
    // Check if Yoast SEO is active
    if (function_exists('wpseo_init')) {
        $sitemap_url = get_home_url() . '/sitemap_index.xml'; // Update with your actual sitemap URL
        echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . esc_url($sitemap_url) . '" />' . PHP_EOL;
    }
}

add_action('wpseo_head', 'add_sitemap_link_to_head');

// function add_category_rss_links_to_head() {
//     $categories = get_categories();

//     foreach ($categories as $category) {
//         $feed_url = get_category_feed_link($category->term_id, 'rss2');

//         if ($feed_url) {
//             $feed_title = 'VSHN ' . $category->name . ' - Blog';
//             $feed_path = '/' . sanitize_title($category->slug) . '-rss.xml';

//             echo '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($feed_title) . '" href="' . home_url($feed_path) . '" />' . PHP_EOL;
//         }
//     }
// }

//add_action('wp_head', 'add_category_rss_links_to_head');

function feed_rewrite_rules() {
    // Default language category feeds
    add_rewrite_rule('([^/]+)-rss.xml$', 'index.php?category_name=$matches[1]&feed=rss2', 'top');

    // English language category feeds
    add_rewrite_rule('en/([^/]+)-rss.xml$', 'index.php?category_name=$matches[1]&feed=rss2&lang=en', 'top');
}

add_action('init', 'feed_rewrite_rules');


function custom_feed_templates() {
    // Get the post categories
    $categories = get_the_category();

    // Loop through each category and include the corresponding feed template
    foreach ($categories as $category) {
        // Get the feed template file
        $feed_template = locate_template('category-rss2.php', false, false);

        // Include the feed template if found
        if ($feed_template) {
            include $feed_template;
        }
    }
}

remove_all_actions('do_feed_rss2');
add_action('do_feed_rss2', 'custom_feed_templates', 10, 1);


add_action('wp_head', 'add_custom_feed_links');

function add_custom_feed_links() {
    // Get all categories for the default language
    $default_categories = get_categories();

    // Loop through each category and add the feed link to the head
    foreach ($default_categories as $category) {
        // Exclude the "Uncategorized" category
        if ($category->slug === 'uncategorized') {
            continue;
        }

        $feed_url = get_category_feed_link($category->term_id, 'rss2');

        if ($feed_url) {
            $feed_title = 'VSHN ' . $category->name . ' - Blog';
            $feed_path = '/' . sanitize_title($category->slug) . '-rss.xml';

            echo '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($feed_title) . '" href="' . esc_attr($feed_path) . '" />' . PHP_EOL;
        }
    }

    // If Polylang is active, get all categories for the English language
    if (function_exists('pll_get_term')) {
        $english_categories = get_categories(array('lang' => 'en'));

        // Loop through each English category and add the feed link to the head
        foreach ($english_categories as $category) {
            // Exclude the "Uncategorized" category
            if ($category->slug === 'uncategorized') {
                continue;
            }

            $feed_url = get_category_feed_link($category->term_id, 'rss2');

            if ($feed_url) {
                $feed_title = 'VSHN ' . $category->name . ' - Blog (English)';
                $feed_path = '/en/' . sanitize_title($category->slug) . '-rss.xml';

                echo '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($feed_title) . '" href="' . esc_attr($feed_path) . '" />' . PHP_EOL;
            }
        }
    }
}

