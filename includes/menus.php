<?php

class Hero_Walker extends Walker_Nav_Menu {
    
    function start_el( &$output, $item, $depth, $args ) {
        $post = get_post($item->object_id);
        $output .= '<div class="hero-unit">';
        $output .= '<h1>' . $item->title . '</h1>';
        $output .= apply_filters('the_excerpt', $post->post_excerpt);
        $output .= "<a class=\"btn primary\" href=\"{$item->url}\">More &raquo;</a>";
    }
    
    function end_el( &$output, $item, $depth ) {
        $output .= "</div>";
    }
}

class Sidekick_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth, $args ) {
        $post = get_post($item->object_id);
        $output .= '<div class="span5">';
        $output .= '<h2>' . $item->title . '</h2>';
        if ($post) {
            $output .= apply_filters('the_excerpt', $post->post_excerpt);
        } else {
            $output .= apply_filters('the_excerpt', category_description($item->object_id));
        }
        $output .= "<a class=\"btn\" href=\"{$item->url}\">More &raquo;</a>";
    }
    
    function end_el( &$output, $item, $depth ) {
        $output .= "</div>";
    }
}

class HW_Nav_Menus {
    
    function __construct() {
        add_action( 'init', array(&$this, 'ensure_menus') );
    }
    
    function ensure_menus() {
        // in case we want to create more later
        $menus = array(
            'topbar' => 'Top Bar',
            'hero' => 'Hero',
            'sidekicks' => 'Sidekicks',
        );
        register_nav_menus($menus);

        foreach ( $menus as $location => $label ) {
            // if a location isn't wired up...
            if ( ! has_nav_menu( $location ) ) {

                // get or create the nav menu
                $nav_menu = wp_get_nav_menu_object( $label );
                if ( ! $nav_menu ) {
                    $new_menu_id = wp_create_nav_menu( $label );
                    $nav_menu = wp_get_nav_menu_object( $new_menu_id );
                }

                // wire it up to the location
                $locations = get_theme_mod( 'nav_menu_locations' );
                $locations[ $location ] = $nav_menu->term_id;
                set_theme_mod( 'nav_menu_locations', $locations );
            } 
        }
    }
    
}

new HW_Nav_Menus;
?>