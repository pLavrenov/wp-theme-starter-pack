<?php

## Добавление кастомных типов постов
require_once( __DIR__ . '/types/post_types.php');

## Хелперы
require_once( __DIR__ . '/includes/helpers/include_helper_func.php');
require_once( __DIR__ . '/includes/helpers/include_helper_hooks.php');
require_once( __DIR__ . '/includes/helpers/include_helper_const.php');
require_once( __DIR__ . '/includes/helpers/include_default_hooks.php');

## Hooks
require_once(__DIR__ . '/includes/hooks/include_cf7_hooks.php');

## Modules (Required)
require_once( __DIR__ . '/modules/tmg/init.php');
require_once(__DIR__ . '/modules/acf/init.php');
require_once(__DIR__ . '/modules/acf-menu/init.php');

## Modules
//require_once(__DIR__ . '/modules/breadcrumbs/init.php');
//require_once( __DIR__ . '/modules/load_more/init.php');
//require_once(__DIR__ . '/modules/pagination/init.php');
//require_once(__DIR__ . '/modules/sidebars/add_sidebars.php');
//require_once(__DIR__ . '/modules/compare/init.php');
//require_once(__DIR__ . '/modules/filter/init.php');



add_theme_support('title-tag');

register_nav_menus(array(
	'top' => 'Верхнее',
	'bottom' => 'Внизу'
    // Тут можно добавить еще одну позицию
));

add_theme_support('post-thumbnails');
//set_post_thumbnail_size(250, 150);
//add_image_size('big-thumb', 400, 400, true);

//add_editor_style('assets/styles/c.css');

/**
 * Название блоков в админке
 */
add_filter('fleeks_block_title', function ($block_name) {
    return match ($block_name) {
        'title' => 'Название блока',
        default => $block_name,
    };
});

## Подключение скриптов
add_action('wp_footer', 'add_scripts');
if (!function_exists('add_scripts')) {
	function add_scripts() {
	    if(is_admin()) return false;
	    wp_deregister_script('jquery');
	    wp_enqueue_script('main', FOLDER . '/assets/scripts/main.min.js', false, FLEEKS_VERSION, true);
        wp_enqueue_script('loadmore', FOLDER . '/assets/scripts/loadmore.js', ['main'], FLEEKS_VERSION, true);
	}
}

## Подключение стилей
add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
	function add_styles() {
	    if(is_admin()) return false;
		wp_enqueue_style( 'main', FOLDER . '/assets/styles/main.css', false, FLEEKS_VERSION );
		wp_enqueue_style( 'wp', FOLDER . '/assets/styles/wp.css', ['main'], FLEEKS_VERSION );
	}
}
