<?php
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


function my_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( __DIR__ . "/blocks/block-{$slug}.php") ) {

        require_once( __DIR__ . "/blocks/block-{$slug}.php" );

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
