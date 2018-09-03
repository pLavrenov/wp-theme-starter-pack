<?php

require_once( __DIR__ . '/types/post_types.php');

require_once( __DIR__ . '/includes/include_define_const.php');
require_once( __DIR__ . '/includes/include_load_more_items.php');
require_once( __DIR__ . '/includes/include-cf7-hooks.php');
require_once( __DIR__ . '/includes/include_helper_func.php');

add_filter('wpcf7_autop_or_not', '__return_false');

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


// Загрузка .svg в библиатеку
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function drussify_months( $date, $req_format ){
    // в формате есть "строковые" неделя или месяц
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
add_filter('date_i18n', 'drussify_months', 11, 2);

function starter_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );

    wp_enqueue_style( 'starter-style', get_stylesheet_uri() );
    wp_enqueue_script( 'includes', get_template_directory_uri() . '/js/min/includes.min.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'starter_scripts' );
