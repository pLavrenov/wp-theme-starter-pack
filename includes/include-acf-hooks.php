<?php

if( function_exists('acf_add_options_page') ) {

    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'Общие настройки',
        'menu_title' 	=> 'Общие настройки',
        'menu_slug' 	=> 'all-settings',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));

}