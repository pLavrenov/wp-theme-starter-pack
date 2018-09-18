<?php

// Загрузка .svg в библиатеку
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}


add_filter('date_i18n', 'drussify_months', 11, 2);
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