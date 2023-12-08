<?php 
function register_acf_options_pages() {

    // check function exists
    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    // register options page
    $my_options_page = acf_add_options_page(
        array(
            'page_title'      => __( 'Global Fields' ),
            'menu_title'      => __( 'Global Fields' ),
            'menu_slug'       => 'global_fields',
            'capability'      => 'edit_posts',
            'show_in_graphql' => true,
        )
    );
}

add_action( 'acf/init', 'register_acf_options_pages' );

function register_my_menus() {
  register_nav_menus(
    array(
	  'top-menu' => __( 'Top Menu', 'vshn' ),
      'main-menu' => __( 'Main Menu', 'vshn' ),
      'footer-menu' => __( 'Footer Menu', 'vshn' ),
      'mobile-menu' => __( 'Mobile Menu', 'vshn' ),
     )
   );
 }

add_action( 'init', 'register_my_menus' );
 
add_action('rest_api_init', function () {
  if (defined('REST_REQUEST') && REST_REQUEST) {
    // Add all WPML language translations to rest api when type is page
    add_action('parse_query', function ($q) {
      if ($q->query_vars['post_type'] == 'page') {
        $q->query_vars['suppress_filters'] = true;
      }
    });
  }
});
 
function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        
        $templateNames = array(
            "templates/home.php", 
            "templates/blog.php",
            "templates/partners.php",
	    "templates/parent-category.php",
	    "templates/events.php",
	    "templates/login.php",
	    "templates/technology-partners.php",
	    "templates/clients.php",
            "templates/success-stories.php",
	    "templates/team.php",
            "templates/contact.php",
            );
            
        if(in_array($template,$templateNames)){ 
            remove_post_type_support( 'page', 'editor' );
        }
        
    }
}
add_action('init', 'remove_editor');

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

// Fix wp-acf-graphl bug https://github.com/wp-graphql/wp-graphql-acf/issues/76#issuecomment-612067382

function expose_acf_to_graphql_only($result, $rule, $screen, $field_group) {
  if(!is_graphql_http_request()) {
    return $result;
  }

  $page_template_acf_groups = [
    'acf',
  ];

  if(in_array($field_group['graphql_field_name'], $page_template_acf_groups) && isset($screen['post_type']) && $screen['post_type'] === 'page') {
    return true;
  }

  return $result;
}
add_filter('acf/location/rule_match', __NAMESPACE__.'\\expose_acf_to_graphql_only', 10, 4);

// Test changes in permalink
 
// function change_permalink_html( $return ) {
// //     $return = '';
//     return str_replace("https://vshn.cyon.site", "https://vshn.netlify.app", $return);;
// }
// add_filter( 'get_sample_permalink_html', 'change_permalink_html' );

// add_filter( 'preview_post_link', 'the_preview_fix', 10, 2);

// function the_preview_fix($preview_link, $post) {
//     $slug = parse_url(get_permalink($post))["path"];
//     return "https://vshn-preview.pixelpoint.io$slug";
// }

function remove_tags_from_excerpt( $excerpt ) {
  return wp_strip_all_tags($excerpt);
}
add_filter( 'the_excerpt', 'remove_tags_from_excerpt' );

function change_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'change_excerpt_length', 999 );

// add_action( 'transition_post_status', 'automation_on_post_status', 10, 3 );

// function automation_on_post_status( $new_status, $old_status, $post ) {
//   if ( 'publish' === $new_status && 'future' === $old_status ) {
//     $url = curl_init('https://webhook.gatsbyjs.com/hooks/data_source/publish/2a2f9ec1-3043-4dcb-b8c8-714849a591ed');
//     curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'POST');
//     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
//     curl_exec($url);
//   }
// }

// Unescape HTML entities https://github.com/wp-graphql/wp-graphql/pull/1550
// https://github.com/wp-graphql/wp-graphql/issues/1622
// add_filter( 'graphql_html_entity_decoding_enabled', '__return_true' );

// add_filter( 'graphql_html_entity_decoding_enabled', function( $enabled, $string, $field_name, $model ) {
// 	if ( $model instanceof \WPGraphQL\Model\Post && 'title' === $field_name ) {
// 		return true;
// 	}
// 	return $enabled;

// }, 10, 4 );
// 

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


add_action('graphql_register_types', function() {
    register_graphql_field('RootQueryToPostConnectionWhereArgs', 'isPublished', [
        'type' => 'Boolean',
        'description' => __( 'Filter by whether the post is ready to be published', 'your-textdomain' ),
    ]);
});

add_action('graphql_register_types', function() {
    register_graphql_field('Post', 'isPublished', [
        'type' => 'Boolean',
        'description' => __( 'If the post is ready to be published', 'your-textdomain' ),
        'resolve' => function($post) {
            return get_field('is_published', $post->ID);
        }
    ]);
});


add_filter('graphql_post_object_connection_query_args', function($query_args, $source, $args, $context, $info) {
    if (isset($args['where']['isPublished'])) {
        $is_published_acf = $args['where']['isPublished'];
        $meta_query = [
            'key' => 'is_published',
            'value' => $is_published_acf,
            'compare' => $is_published_acf ? '=' : '!=',
        ];

        if (isset($query_args['meta_query'])) {
            $query_args['meta_query'][] = $meta_query;
        } else {
            $query_args['meta_query'] = [$meta_query];
        }
    }
    return $query_args;
}, 10, 5);

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


add_action( 'save_post', 'trigger_revalidate', 10, 3 );

function trigger_revalidate( $post_id, $post, $update ) {

    // Check if this isn't an auto save.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check if this isn't a revision.
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    // We only want to trigger the revalidation if the post was updated and not just created.
    if ( $update ) {
        // Only proceed if the post_type is 'post' or 'page'
        if ($post->post_type == 'post' || $post->post_type == 'page') {
            // Get the post's slug
            $slug = preg_replace('/-\d+$/', '', $post->post_name); 

            // Retrieve the post's language.
            $terms = get_the_terms($post_id, 'language');
            if (!empty($terms) && !is_wp_error($terms)) {
                $language = $terms[0]->slug; // assuming each post has only one language
            } else {
                $language = 'de'; // default language if language cannot be retrieved
            }

            // Determine the path
            if ($post->post_type == 'post') {
                // This is a blog post
                $path = '/' . $language . '/blog/' . $slug . '/';
				
				// Refresh the blog page
                $blog_path = '/' . $language . '/blog/';
                $blog_response = wp_remote_get( "https://vshn-next.vercel.app/api/revalidate?path={$blog_path}" );

                // Error handling if request to refresh the blog page fails.
                if ( is_wp_error( $blog_response ) ) {
                    // Log the error message instead of echoing it
                    error_log($blog_response->get_error_message());
                }
            } else {
                // This is a regular page
                $path = '/' . $language . '/' . $slug . '/';
            }

            // Send GET request to your Next.js API
            $response = wp_remote_get( "https://vshn-next.vercel.app/api/revalidate?path={$path}" );

            // Error handling if request fails.
            if ( is_wp_error( $response ) ) {
                // Log the error message instead of echoing it
                error_log($response->get_error_message());
            }
        }
    }
}





