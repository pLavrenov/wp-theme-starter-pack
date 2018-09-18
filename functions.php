<?php

require_once( __DIR__ . '/types/post_types.php');

require_once( __DIR__ . '/includes/include_define_const.php');
require_once( __DIR__ . '/includes/include_load_more_items.php');
require_once( __DIR__ . '/includes/include-cf7-hooks.php');
require_once( __DIR__ . '/includes/include_helper_func.php');
require_once( __DIR__ . '/includes/include_helper_hooks.php');
require_once( __DIR__ . '/includes/include-tmg-plugins.php');



add_theme_support('title-tag');

register_nav_menus(array(
	'top' => 'Верхнее',
	'bottom' => 'Внизу'
    // Тут можно добавить еще одну позицию
));

add_theme_support('post-thumbnails');
//set_post_thumbnail_size(250, 150);
//add_image_size('big-thumb', 400, 400, true);

add_action('wp_footer', 'add_scripts');
if (!function_exists('add_scripts')) {
	function add_scripts() {
	    if(is_admin()) return false;
	    wp_deregister_script('jquery');
	    wp_enqueue_script('main', get_template_directory_uri().'/scripts/main.min.js','','',true);
        wp_enqueue_script('loadmore',get_template_directory_uri().'/scripts/loadmore.js','','',true);
	}
}

add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
	function add_styles() {
	    if(is_admin()) return false;
		wp_enqueue_style( 'main', get_template_directory_uri().'/styles/main.css', false, '0.0.1' );
		wp_enqueue_style( 'wp', get_template_directory_uri().'/styles/wp.css', ['main'], '0.0.1' );
	}
}


