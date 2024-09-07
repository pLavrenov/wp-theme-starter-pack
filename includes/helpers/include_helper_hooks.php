<?php

remove_theme_support('core-block-patterns');

## Загрузка .svg в библиатеку
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}

## Русские месяцы
add_filter('date_i18n', 'drussify_months', 11, 2);
function drussify_months( $date, $req_format ){
    if( ! preg_match('~[FMlS]~', $req_format ) ) return $date;
    $replace = array (
        "январь" => "января", "Февраль" => "февраля", "Март" => "марта", "Апрель" => "апреля", "Май" => "мая", "Июнь" => "июня", "Июль" => "июля", "Август" => "августа", "Сентябрь" => "сентября", "Октябрь" => "октября", "Ноябрь" => "ноября", "Декабрь" => "декабря",
        "January" => "января", "February" => "февраля", "March" => "марта", "April" => "апреля", "May" => "мая", "June" => "июня", "July" => "июля", "August" => "августа", "September" => "сентября", "October" => "октября", "November" => "ноября", "December" => "декабря",
        "Jan" => "янв.", "Feb" => "фев.", "Mar" => "март.", "Apr" => "апр.", "May" => "мая", "Jun" => "июня", "Jul" => "июля", "Aug" => "авг.", "Sep" => "сен.", "Oct" => "окт.", "Nov" => "нояб.", "Dec" => "дек.",
        "Sunday" => "воскресенье", "Monday" => "понедельник", "Tuesday" => "вторник", "Wednesday" => "среда", "Thursday" => "четверг", "Friday" => "пятница", "Saturday" => "суббота",
        "Sun" => "вос.", "Mon" => "пон.", "Tue" => "вт.", "Wed" => "ср.", "Thu" => "чет.", "Fri" => "пят.", "Sat" => "суб.", "th" => "", "st" => "", "nd" => "", "rd" => "",
    );
    return strtr( $date, $replace );
}

## Отключаем Emojii
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива -- get_the_archive_title()
add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});


## Добавление стилей для стандартного меню
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);
function add_menu_list_item_class($classes, $item, $args) {
    if (property_exists($args, 'li_class') && !$item->menu_item_parent) {
        $classes[] = $args->li_class;
    }
    if (property_exists($args, 'li_child_class') && $item->menu_item_parent) {
        $classes[] = $args->li_child_class;
    }
    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );
function add_menu_link_class( $atts, $item, $args ) {
    if ( strpos( $atts['href'], home_url() ) === false ) {
        $atts['target'] = '_blank';
    }
    if (property_exists($args, 'a_class') && !$item->menu_item_parent) {
        $atts['class'] = $args->a_class;
    }
    if (property_exists($args, 'a_child_class') && $item->menu_item_parent) {
        $atts['class'] = $args->a_child_class;
    }
    return $atts;
}

add_filter( 'nav_menu_submenu_css_class', 'my_nav_menu_submenu_css_class', 1, 3);
function my_nav_menu_submenu_css_class($classes, $args, $depth) {
    if (property_exists($args, 'ul_child_class')) {
        $classes[] = $args->ul_child_class;
    }
    return $classes;
}
