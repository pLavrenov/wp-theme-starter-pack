<?php

add_theme_support('wp-block-styles');
add_theme_support('editor-styles');
add_theme_support('title-tag');
add_theme_support('align-wide');

add_filter( 'admin_email_check_interval', '__return_false' );

add_action('admin_menu', function () {

    remove_menu_page('users.php'); // Пользователи
    remove_menu_page('edit.php'); // Записи
    remove_menu_page('edit-comments.php'); // Комментарии
    remove_menu_page('link-manager.php'); // Ссылки

    remove_submenu_page('options-general.php', 'options-writing.php'); // Настройки
    remove_submenu_page('options-general.php', 'options-discussion.php'); // Настройки
    remove_submenu_page('options-general.php', 'options-media.php'); // Настройки
    remove_submenu_page('options-general.php', 'options-privacy.php'); // Настройки
    remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode($_SERVER['SCRIPT_NAME']));

    if (!FLEEKS_DEV) {
        remove_menu_page('tools.php'); // Инструменты
        remove_menu_page('plugins.php'); // Плагины
        remove_menu_page('themes.php'); // Внешний вид
        remove_menu_page('edit.php?post_type=acf-field-group'); // ACF
        //remove_menu_page('index.php'); // Консоль
    }
    //remove_menu_page('upload.php'); // Медиафайлы
    //remove_menu_page('edit.php?post_type=page'); // Страницы
    //remove_menu_page('wpcf7'); // Contact form 7
}, 999);

add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if (!FLEEKS_DEV) {
        // Plugin related admin-bar items
        // $wp_admin_bar->remove_node('blocksy_preview_hooks');
        // WordPress Core Items
        $wp_admin_bar->remove_node('updates');
        $wp_admin_bar->remove_node('comments');
        // $wp_admin_bar->remove_node('new-content');
        $wp_admin_bar->remove_node('wp-logo');
        //$wp_admin_bar->remove_node('site-name');
        //$wp_admin_bar->remove_node('my-account');
        //$wp_admin_bar->remove_node('search');
        $wp_admin_bar->remove_node('customize');
    }
});

add_filter('intermediate_image_sizes', function ($sizes) {
    $targets = ['thumbnail', 'medium', 'medium_large', 'large', '1536x1536', '2048x2048'];
    foreach ($sizes as $size_index => $size) {
        if (in_array($size, $targets)) {
            unset($sizes[$size_index]);
        }
    }
    return $sizes;
}, 10, 1);

add_action('init', function () {

    remove_theme_support('core-block-patterns');

    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action('wp_head', 'wp_generator');

    /**
     * Отключение emoji
     */
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}, 100);

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library'); // Wordpress core
    wp_dequeue_style('wp-block-library-theme'); // Wordpress core
    wp_dequeue_style('wc-block-style'); // WooCommerce
    wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}, 100);

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
}, 20);