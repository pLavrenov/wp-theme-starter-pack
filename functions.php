<?php

## Добавление кастомных типов постов
require_once( __DIR__ . '/types/post_types.php');

## Хелперы
require_once( __DIR__ . '/helpers/include_helper_func.php');
require_once( __DIR__ . '/helpers/include_helper_hooks.php');
require_once( __DIR__ . '/helpers/include_helper_const.php');

## Modules (Required)
require_once( __DIR__ . '/modules/tmg/init.php');
require_once(__DIR__ . '/modules/acf/init.php');

## Modules
require_once(__DIR__ . '/modules/breadcrumbs/init.php');
require_once( __DIR__ . '/modules/load_more/init.php');
//require_once(__DIR__ . '/modules/pagination/init.php');
//require_once(__DIR__ . '/modules/sidebars/add_sidebars.php');
//require_once(__DIR__ . '/modules/compare/init.php');
//require_once(__DIR__ . '/modules/filter/init.php');

## Hooks
require_once( __DIR__ . '/includes/include_cf7_hooks.php');




add_theme_support('title-tag');

register_nav_menus(array(
	'top' => 'Верхнее',
	'bottom' => 'Внизу'
    // Тут можно добавить еще одну позицию
));

add_theme_support('post-thumbnails');
//set_post_thumbnail_size(250, 150);
//add_image_size('big-thumb', 400, 400, true);

## Подключение скриптов
add_action('wp_footer', 'add_scripts');
if (!function_exists('add_scripts')) {
	function add_scripts() {
	    if(is_admin()) return false;
	    wp_deregister_script('jquery');
	    wp_enqueue_script('main', get_template_directory_uri().'/scripts/main.min.js', false, '0.0.1', true);
        wp_enqueue_script('loadmore',get_template_directory_uri().'/scripts/loadmore.js', ['main'], '0.0.1', true);
	}
}

## Подключение стилей
add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
	function add_styles() {
	    if(is_admin()) return false;
		wp_enqueue_style( 'main', get_template_directory_uri().'/styles/main.css', false, '0.0.1' );
		wp_enqueue_style( 'wp', get_template_directory_uri().'/styles/wp.css', ['main'], '0.0.1' );
	}
}
