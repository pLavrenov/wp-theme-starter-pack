<?php

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/modules/acf/plugin/' );
define( 'MY_ACF_BLOCKS_PATH', get_stylesheet_directory() . '/views/blocks/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/modules/acf/plugin/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return FLEEKS_DEV;
}

add_action('acf/init', 'my_acf_init');
function my_acf_init() {

    // Добавление страниц глобальных обций
    if( function_exists('acf_add_options_page') ) {

        // Список блоков
        require_once(__DIR__ . '/include-acf-init-options.php');

    }

    // Добавление блоков Gutenberg
    if( function_exists('acf_register_block') ) {

        // Список блоков
        require_once(__DIR__ . '/include-acf-init-blocks.php');

    }

    // Добавление полей через код
    if( function_exists('acf_add_local_field_group') && !FLEEKS_DEV ) {

        // Список полей
        require_once(__DIR__ . '/include-acf-option-fields.php');

    }

}

add_filter( 'block_categories', 'acf_add_category_blocks', 10, 2 );
function acf_add_category_blocks( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug' => 'fleeks',
                'title' => __( 'Fleeks.Блоки', 'fleeks_admin' ),
                'icon'  => 'wordpress',
            ]
        ]
    );
}

function my_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( MY_ACF_BLOCKS_PATH . "{$slug}.php") )
    {
        require(MY_ACF_BLOCKS_PATH . "{$slug}.php");
    }

}

function my_acf_block_icon_helper( $icon ) {
    return [
        // Укажите цвет фона
        'background' => '#7e70af',

        // Цвет иконки
        'foreground' => '#fff',

        // Название иконки (стандартные wp)
        'src' => $icon ? $icon : 'book-alt',
    ];
}
