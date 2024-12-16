<?php

// Define path and URL to the ACF plugin.
define('MY_ACF_PATH', get_stylesheet_directory() . '/modules/acf/plugin/');
define('MY_ACF_BLOCKS_PATH', get_stylesheet_directory() . '/views/blocks/');
define('MY_ACF_URL', get_stylesheet_directory_uri() . '/modules/acf/plugin/');

// Include the ACF plugin.
include_once(MY_ACF_PATH . 'acf.php');

add_editor_style(FOLDER . '/modules/acf/editor-style.css');

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', function ($url) {
    return MY_ACF_URL;
});

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', function ($show_admin) {
    return FLEEKS_DEV;
});

add_action('acf/init', function () {
    // Добавление страниц глобальных обций
    if (function_exists('acf_add_options_page')) {
        // Список блоков
        require_once(__DIR__ . '/include-acf-init-options.php');
    }
    // Добавление полей через код
    if (function_exists('acf_add_local_field_group') && !FLEEKS_DEV) {
        // Список полей
        require_once(__DIR__ . '/include-acf-option-fields.php');
    }
});

add_action('acf/init', function () {
    // Добавление блоков Gutenberg
    if (function_exists('acf_register_block_type')) {
        $files = array_slice(scandir(MY_ACF_BLOCKS_PATH), 2);
        foreach ($files as $file) {
            $name = str_replace('.php', '', $file);
            //$title = apply_filters('fleeks_block_title', dashesToText($name, ' '));
            $title = apply_filters('fleeks_block_title', $name);
            $icon = apply_filters('fleeks_block_icon', 'admin-comments');
            acf_register_block_type([
                'name' => $name,
                'title' => __($title, 'fleeks_theme'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'fleeks',
                'icon' => my_acf_block_icon_helper($icon),
                //        "style" => [
                //            "file:../../styles/s.css",
                //        ],
                //        "editorStyle" => "file:./editor.css",
                'mode' => 'edit',
                'supports' => [
                    //'mode' => false,
                    'jsx' => true,
                    'align' => array('center', 'wide', 'full' ),
                ],
            ]);
        }
    }
});

add_filter('block_categories', function ($categories, $post) {
    return array_merge(
        $categories,
        [
            [
                'slug' => 'fleeks',
                'title' => __('Fleeks.Блоки', 'fleeks_admin'),
                'icon' => 'wordpress',
            ]
        ]
    );
}, 10, 2);

function my_acf_block_render_callback($block)
{
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from within the "template-parts/block" folder
    if (file_exists(MY_ACF_BLOCKS_PATH . "{$slug}.php")) {
        require(MY_ACF_BLOCKS_PATH . "{$slug}.php");
    }
}

function my_acf_block_icon_helper($icon)
{
    return [
        // Укажите цвет фона
        'background' => '#7e70af',

        // Цвет иконки
        'foreground' => '#fff',

        // Название иконки (стандартные wp)
        'src' => $icon ? $icon : 'book-alt',
    ];
}

//function dashesToText($string, $replace = '') {
//    $str = str_replace(' ', $replace, str_replace('-', ' ', $string));
//    $str[0] = ucwords($str[0]);
//    return $str;
//}