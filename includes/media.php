<?php

class HW_Fancybox {
    function __construct() {
        // edit image link tag
        // insert stylesheet
        // insert scripts

        add_action('wp_enqueue_scripts', array(&$this, 'add_scripts'));
        add_action('wp_print_styles', array(&$this, 'add_stylesheet'));
        add_filter('image_send_to_editor', 
            array(&$this, 'fancybox_image_send_to_editor'), 10, 8);
        

        $this->root = get_bloginfo( 'stylesheet_directory' );
    }


    function add_stylesheet() {
        $src = $this->root . '/js/fancybox/jquery.fancybox-1.3.4.css';
        wp_enqueue_style('fancybox', $src, array(), '1.3.4');
    }

    function add_scripts() {
        $js = array(
            'fancybox' => $this->root . "/js/fancybox/jquery.fancybox-1.3.4.js",
            'config' => $this->root . "/js/fancybox.config.js"
        );

        wp_enqueue_script('fancybox', $js['fancybox'], 
            array('jquery'), '1.3.4');

        wp_enqueue_script('fancybox_config', $js['config'], 
            array('jquery', 'fancybox'), '0.1');
    }
    
    function fancybox_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {
        // we're only interested in images wrapped in links to uploaded images
    	if ( $url ) {
    	    $uploads_dir = wp_upload_dir();
    	    $uploads_dir = $uploads_dir['baseurl'];
    	    if ( strpos($url, $uploads_dir) === 0 ) {
        	    // it's an uploaded file, so fancybox it
        	    $html = get_image_tag($id, $alt, $title, $align, $size);
            	$rel = $rel ? ' rel="post-' . esc_attr($id).'"' : '';
        	    $url = esc_attr($url);
        	    $caption = esc_attr($caption);
        	    $html = "<a class='fancybox' href='{$url}' rel='$rel' title='{$caption}'>$html</a>";
    	    }
    	}

        return $html;
    }
    
}

new HW_Fancybox;
?>