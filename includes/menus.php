<?php

class HW_Walker extends Walker_Nav_Menu {
    
    function start_el( &$output, $item, $depth, $args ) {
    }
    
    function end_el( &$output, $item, $depth ) {
    }
}

class HW_Nav_Menus {
    
    function __construct() {
        add_action( 'after_setup_theme', array(&$this, 'ensure_menus') );
    }
    
    function ensure_menus() {
        // in case we want to create more later
        $menus = array(
            'main' => 'Main Navigation',
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