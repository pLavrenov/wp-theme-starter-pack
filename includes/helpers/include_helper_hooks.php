<?php

add_filter('gettext', function ($translation, $text, $domain) {
    if ('contact-form-7' === $domain) {
        $translation = str_ireplace('Contact Form 7', 'Формы', $translation);
    }
    return $translation;
}, 20, 3);

## метка для специальных страниц в таблице page записей
add_filter('display_post_states', function ($post_states, $post) {
    if($post->post_type === 'page' && in_array($post->post_name, get_post_types())){
        $post_states[] = 'Архивная страница';
    }
    return $post_states;
}, 10, 2 );

## Загрузка .svg в библиатеку
add_action('upload_mimes', function ($file_types) {
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
});

## Русские месяцы
add_filter('date_i18n', function ($date, $req_format) {
    if (!preg_match('~[FMlS]~', $req_format)) return $date;
    $replace = array(
        "январь" => "января", "Февраль" => "февраля", "Март" => "марта", "Апрель" => "апреля", "Май" => "мая", "Июнь" => "июня", "Июль" => "июля", "Август" => "августа", "Сентябрь" => "сентября", "Октябрь" => "октября", "Ноябрь" => "ноября", "Декабрь" => "декабря",
        "January" => "января", "February" => "февраля", "March" => "марта", "April" => "апреля", "May" => "мая", "June" => "июня", "July" => "июля", "August" => "августа", "September" => "сентября", "October" => "октября", "November" => "ноября", "December" => "декабря",
        "Jan" => "янв.", "Feb" => "фев.", "Mar" => "март.", "Apr" => "апр.", "May" => "мая", "Jun" => "июня", "Jul" => "июля", "Aug" => "авг.", "Sep" => "сен.", "Oct" => "окт.", "Nov" => "нояб.", "Dec" => "дек.",
        "Sunday" => "воскресенье", "Monday" => "понедельник", "Tuesday" => "вторник", "Wednesday" => "среда", "Thursday" => "четверг", "Friday" => "пятница", "Saturday" => "суббота",
        "Sun" => "вос.", "Mon" => "пон.", "Tue" => "вт.", "Wed" => "ср.", "Thu" => "чет.", "Fri" => "пят.", "Sat" => "суб.", "th" => "", "st" => "", "nd" => "", "rd" => "",
    );
    return strtr($date, $replace);
}, 11, 2);

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива -- get_the_archive_title()
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});

## Добавление стилей для стандартного меню
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if (property_exists($args, 'li_class') && !$item->menu_item_parent) {
        $classes[] = $args->li_class;
    }
    if (property_exists($args, 'li_child_class') && $item->menu_item_parent) {
        $classes[] = $args->li_child_class;
    }
    return $classes;
}, 1, 3);

add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
    if (strpos($atts['href'], home_url()) === false) {
        $atts['target'] = '_blank';
    }
    if (property_exists($args, 'a_class') && !$item->menu_item_parent) {
        $atts['class'] = $args->a_class;
    }
    if (property_exists($args, 'a_child_class') && $item->menu_item_parent) {
        $atts['class'] = $args->a_child_class;
    }
    return $atts;
}, 1, 3);

add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
    if (property_exists($args, 'ul_child_class')) {
        $classes[] = $args->ul_child_class;
    }
    return $classes;
}, 1, 3);