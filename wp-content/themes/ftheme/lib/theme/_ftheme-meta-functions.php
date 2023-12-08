<?php
/**
 * Custom meta functions for ftheme
 * Functions like custom excerpt, share link, mail chimp integration etc...
 */

/**
 * Custom Excerpt function for Advanced Custom Fields
 * @param $field - ACF field with content to do excerpt
 */
function get_ftheme_excerpt($field, $count = '', $end = '') {;

    if ( '' != $field ) {
        $field = strip_shortcodes( $field );
        $field = apply_filters('the_content', $field);
        $field = str_replace(']]&gt;', ']]&gt;', $field);
        //$excerpt_length = rand(22, 60); for randoming
        if( $count ) $excerpt_length = $count;
        else $excerpt_length = 20;

        if( $end ) $excerpt_more = apply_filters('excerpt_more', ' ' . $end);
        else $excerpt_more = apply_filters('excerpt_more', ' ' . '...');

        $field = wp_trim_words( $field, $excerpt_length, $excerpt_more );
    }
    return apply_filters('the_excerpt', $field);
}

/**
 * Custom excerpt function for Advanced Custom Fields
 *
 * Echo Custom Excerpt function for Advanced Custom Fields
 * @param $field - ACF field with content to do excerpt
 */
function the_ftheme_excerpt($field, $count = '', $end = '') {
    echo get_ftheme_excerpt($field, $count, $end);
}

/**
 * Get the sharing link
 *
 * Helper function for share links
 *
 * @param  string $network   Default '', network to share to, values to use: twitter, facebook, google, linkedin
 * @param  boolean $icon     Default false, set to true, if you want icon instead of text
 * @param  string $hashtags  Hashatgs (Twitter)
 * @param  string $text      Some networks allow extra text (Twitter)
 * @return string            Returns share link markup
 */
function get_share_link($network = '', $icon = false, $text = '', $hashtags = '') {
    $link = get_permalink();
    if( !$text ) $text = get_the_title();
    if ( $network == 'twitter' ) {
        /**
         * Example usage: share_link('facebook', true); or share_link('twitter', false, 'lol,hi,hashtag', 'Custom Text For Twitter') ...
         */
        $href = 'http://twitter.com/share?text=' . $text . ' - ' . '&url=' . $link . '&hashtags=' . $hashtags;
        if( !$icon ) $print_name = 'Twitter'; else $print_name = '<i class="fa fa-twitter" aria-hidden="true"></i>';

    } elseif ( $network == 'facebook' ) {
        $href = 'http://www.facebook.com/sharer/sharer.php?u=' . $link;
        if( !$icon ) $print_name = 'Facebook'; else $print_name = '<i class="fa fa-facebook" aria-hidden="true"></i>';
    } elseif ( $network == 'google' ) {
        $href = 'https://plus.google.com/share?url=' . $link;
        if( !$icon ) $print_name = 'Google +'; else $print_name = '<i class="fa fa-google-plus" aria-hidden="true"></i>';
    } elseif ( $network == 'linkedin' ) {
        $href = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $link . '&title=' . $text . '&summary=&source=';
        if( !$icon ) $print_name = 'Linkedin'; else $print_name = '<i class="fa fa-linkedin" aria-hidden="true"></i>';
    } else {
        return;
    }

    $output = '<a href="' . $href . '"';
    $output .= ' onclick="javascript:window.open(this.href, \'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=650,centerscreen=yes\');return false;"';
    $output .= '>';
    $output .= $print_name;
    $output .= '</a>';

    return $output;
}

/**
 * Share link
 *
 * Echo share link
 *
 * @param  string $network   Default '', network to share to, values to use: twitter, facebook, google, linkedin
 * @param  boolean $icon     Default false, set to true, if you want icon instead of text
 * @param  string $hashtags  Hashatgs (Twitter)
 * @param  string $text      Some networks allow extra text (Twitter)
 * @return string            Echo share link markup
 */
function the_share_link($network = '', $icon = '', $text = '', $hashtags = '') {
    echo get_share_link($network, $icon, $text, $hashtags);
}

/**
 * Get first item from array
 * @param $vars {array} - List of variables
 * @return mixed - First available in array
 */
function get_ftheme_first($vars) {
    if ( !$vars )
        return '';

    foreach ( $vars as $var ) :
        if ( $var )
            return $var;
    endforeach;
}

/**
 * Echo first item from array
 * @param $vars {array} - List of variables
 * @return mixed - First available in array
 */
function the_ftheme_first($vars) {
    if ( !$vars )
        return '';

    foreach ( $vars as $var ) :
        if ( $var ) {
            echo $var;
            return;
        }
    endforeach;
}

function remove_category( $string, $type )  {           
    if ( $type != 'single' && $type == 'category' && ( strpos( $string, 'category' ) !== false ) )          
    {              
        $url_without_category = str_replace( "/category/", "/", $string );              
        return trailingslashit( $url_without_category );          
    }      return $string;  
}     
add_filter( 'user_trailingslashit', 'remove_category', 100, 2);

add_image_size( 'lazy-block-personal-card', 120);
add_image_size( 'lazy-block-rating-cards', 240);

add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'lazy-block-personal-card' => __( 'Lazy Block: Personal Card' ),
        'lazy-block-rating-cards' => __( 'Lazy Block: Rating Cards' ),
    ) );
}

add_filter('lazyblock/personal-card/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/rating-cards/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/hubspot-form/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/subpage-cards/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/features/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/promminent-text/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/cards/frontend_allow_wrapper', '__return_false');
add_filter('lazyblock/relative-link/frontend_allow_wrapper', '__return_false');

// Remove unnecessary fields in profile
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );
 
function modify_user_contact_methods( $methods ) {
 
 
    // Remove user contact methods
    unset( $methods['twitter']    );
    unset( $methods['facebook'] );
    unset( $methods['instagram'] );
	unset( $methods['linkedin'] );
	unset( $methods['pinterest'] );
	unset( $methods['myspace'] );
	unset( $methods['soundcloud'] );
	unset( $methods['tumblr'] );
	unset( $methods['youtube'] );
	unset( $methods['wikipedia'] );
    return $methods;
}

function remove_rows_from_profile()
{
    echo '<style>tr.user-url-wrap{ display: none; }</style>';
}
add_action( 'admin_head-user-edit.php', 'remove_rows_from_profile' );

add_filter('manage_post_posts_columns', function($columns) {
    $columns['isPublished'] = __('Is Published', 'your-textdomain');
    return $columns;
});

add_action('manage_posts_custom_column', function($column_name, $post_id) {
    if ($column_name === 'isPublished') {
        $is_published = get_post_meta($post_id, 'is_published', true);
        echo $is_published ? 'True' : 'False';
    }
}, 10, 2);

function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        
        $templateNames = array(
            "template-parts/template-home.php", 
            "template-parts/template-blog.php",
            "template-parts/template-partners.php",
	        "template-parts/template-parent-category.php",
	        "template-parts/template-events.php",
	        "template-parts/template-login.php",
	        "template-parts/template-technology-partners.php",
	        "template-parts/template-clients.php",
            "template-parts/template-success-stories.php",
	        "template-parts/template-team.php",
            "template-parts/template-contact.php",
            );
            
        if(in_array($template,$templateNames)){ 
            remove_post_type_support( 'page', 'editor' );
        }
        
    }
}
add_action('init', 'remove_editor');