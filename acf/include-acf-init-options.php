<?php

// Добавление страницы опций
acf_add_options_page([
    'page_title' 	=> 'Общие настройки',
    'menu_title' 	=> 'Общие настройки',
    'menu_slug' 	=> 'all-settings',
    'capability' 	=> 'edit_posts',
    'redirect' 	=> false
]);
