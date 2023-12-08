<?php
/**
* Register nav menus
* This function is attached to 'init' action hook. @see ftheme_setup()
* @uses register_nav_menu() 	Add support for navigation menus.
* @link http://codex.wordpress.org/Function_Reference/register_nav_menu
*/
function ftheme_menus() {
    register_nav_menus(
        array(
          'top-menu' => __( 'Top Menu', 'vshn' ),
          'main-menu' => __( 'Main Menu', 'vshn' ),
          'footer-menu' => __( 'Footer Menu', 'vshn' ),
          'mobile-menu' => __( 'Mobile Menu', 'vshn' ),
         )
      );
}

class Top_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = null) {
      $output .= "\n<ul>\n";
  }

  function end_lvl(&$output, $depth = 0, $args = null) {
      $output .= "</ul>\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null) {
      $indent = ($depth) ? str_repeat("\t", $depth) : '';

      $output .= $indent;

      $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
      $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
      $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
      $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

      $item_output = '<a class="list-item"' . $attributes . '>';
      $item_output .= esc_html($item->title);
      $item_output .= '</a>';

      $output .= $item_output . "\n";
  }

  function end_el(&$output, $item, $depth = 0, $args = null) {
      $output .= "\n";
  }
}

class Footer_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = null) {
      $output .= "\n<ul>\n";
  }

  function end_lvl(&$output, $depth = 0, $args = null) {
      $output .= "</ul>\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null) {
      $indent = ($depth) ? str_repeat("\t", $depth) : '';

      $output .= $indent;

      $classes = empty($item->classes) ? array() : (array) $item->classes;
      $classes[] = 'menu-item';
      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

      $output .= '<li class="' . esc_attr($class_names) . '">';

      $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
      $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
      $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
      $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

      $item_output = '<a class="menu-link"' . $attributes . '>';
      $item_output .= esc_html($item->title);
      $item_output .= '</a>';

      $output .= $item_output;
  }

  function end_el(&$output, $item, $depth = 0, $args = null) {
      $output .= "</li>\n";
  }
}

// class Main_Menu_Walker extends Walker_Nav_Menu {

//     function start_lvl( &$output, $depth = 0, $args = null ) {
//         if ($depth === 0) {
//             // Open the outer submenu wrapper for first-level items
//             $output .= '<div class="sub-menu wrapper">';
//             $output .= '<div class="container inner">';
//             //$output .= '<a href="#" class="banner">';
//             //$output .= '<h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">Watch the APPUiO video</h2>';
//             //$output .= '<h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">Watch the APPUiO video</h2>';
//             //$output .= '<span class="banner-link-text">Read more</span>';
//            //$output .= '<span class="banner-link-text">Read more</span>';
//             //$output .= '</a>';
//             //$output .= $this->get_acf_banner($item->ID, 'link', 'link_text');
//             $output .= '<ul class="items">';
//         } elseif ($depth === 1) {
//             // Open the inner submenu wrapper for second-level items
//             $output .= '<ul class="sub-sub-menu container">';
//         }
//     }

//     function end_lvl(&$output, $depth=0, $args=null) {
//         if ($depth === 0) {
//             // Close the first-level submenu wrapper
//             $output .= '</ul>';
//             $output .= '</div></div>';
//         } elseif ($depth === 1) {
//             // Close the second-level submenu wrapper
//             $output .= '</ul>';
//         }
//     }

//     function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
//         if ($depth === 0) {
//             // Output for first-level menu items
//             $output .= '<li class="menu-item with-sub-menu">';
//             $output .= '<div class="link">';
//             $output .= '<a href="' . esc_url($item->url) . '" class="link">' . esc_html($item->title) . '</a>';
//         } elseif ($depth === 1) {
//             // Output for second-level menu items
//             $output .= '<li class="item';
//             if ($args->walker->has_children) {
//                 $output .= ' with-sub-item'; // Add class for menu items with sub-sub-menu
//             }
//             $output .= '">';
//             $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
//         } elseif ($depth === 2) {
//             // Output for third-level menu items (sub-sub-menu items)
//             $output .= '<li class="sub-item">';
//             $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
//         } 
//     }

//     function end_el(&$output, $item, $depth=0, $args=null) {
//         if ($depth === 0) {
//             // Close the first-level menu item
//             $output .= '</div>';
//             $output .= '</li>';
//         } elseif ($depth === 1) {
//             // Close the second-level menu item
//             $output .= '</li>';
//         } elseif ($depth === 2) {
//             // Close the third-level menu item
//             $output .= '</li>';
//         }
//     }

//     // // Function to get ACF banner data
//     // function get_acf_banner($item_id, $acf_link_field, $acf_text_field) {
//     //     $acf_link = get_field($acf_link_field, $item_id);
//     //     $acf_text = get_field($acf_text_field);

//     //     if ($acf_link) {
//     //         $output = '<a href="' . esc_url($acf_link['url']) . '" class="banner">';
//     //         $output .= '<h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">';
//     //         $output .= esc_html($acf_link['title']) . '</h2>';
//     //         $output .= '<span class="banner-link-text">' . esc_html($acf_text) . '</span>';
//     //         $output .= '</a>';
//     //         $output .= "TEST"
//     //         return $output;
//     //     } else {
//     //         return '';
//     //     }
//     // }
// }


class Main_Menu_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = null ) {
        if ($depth === 0) {
            $this->acf_data_displayed = false;

            // Open the outer submenu wrapper for first-level items
            $output .= '<div class="sub-menu wrapper">';
            $output .= '<div class="container inner">';
            $output .= '<div class="banner-wrapper">';
            $output .= '<ul class="items">';
            //$output .= 'ACF DATA DISPLAYED:' . var_dump($this->acf_data_displayed);
        } elseif ($depth === 1) {
            // Open the inner submenu wrapper for second-level items
            $output .= '<ul class="sub-sub-menu container">';
        }
    }

    function end_lvl(&$output, $depth=0, $args=null) {
        if ($depth === 0) {
            // Close the first-level submenu wrapper
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</div></div>';
        } elseif ($depth === 1) {
            // Close the second-level submenu wrapper
            $output .= '</ul>';
        }
    }

    function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
        if ($depth === 0) {
            // Output for first-level menu items
            //$output .= '<li class="menu-item with-sub-menu">';
            $output .= '<li class="menu-item';
            if ($args->walker->has_children) {
                $output .= ' with-sub-menu'; 
            }
            $output .= '">';
            $output .= '<div class="link">';
            $output .= '<a href="' . esc_url($item->url) . '" class="link">' . esc_html($item->title) . '</a>';
        } elseif ($depth === 1) {
            if (!$this->acf_data_displayed) {

                $parent_id = $item->menu_item_parent;

                if ($parent_id > 0) {
                    $link_text = get_field('link_text', $parent_id);
                    $link_url = get_field('link', $parent_id);

                    if ($link_text) {
                        $output .= '<a href="' . esc_url($link_url['url']) . '" class="banner">';
                        $output .= '<h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">' . esc_html($link_url['title']) . '</h2>';
                        $output .= '<span class="banner-link-text">' . esc_html($link_text) . '</span>';
                        $output .= '</a>';
                    }
                }
                $this->acf_data_displayed = true; 
            }

            // Output for second-level menu items
            $output .= '<li class="item';
            if ($args->walker->has_children) {
                $output .= ' with-sub-item'; // Add class for menu items with sub-sub-menu
            }
            $output .= '">';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        } elseif ($depth === 2) {
            // Output for third-level menu items (sub-sub-menu items)
            $output .= '<li class="sub-item">';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        } 
    }

    function end_el(&$output, $item, $depth=0, $args=null) {
        if ($depth === 0) {
            // Close the first-level menu item
            $output .= '</div>';
            $output .= '</li>';
        } elseif ($depth === 1) {
            // Close the second-level menu item
            $output .= '</li>';
        } elseif ($depth === 2) {
            // Close the third-level menu item
            $output .= '</li>';
        }
    }
}