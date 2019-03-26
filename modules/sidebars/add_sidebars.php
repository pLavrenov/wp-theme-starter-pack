<?php

require_once( __DIR__ . '/widgets/phone_call_widget.php');
require_once( __DIR__ . '/widgets/days_work_widget.php');
require_once( __DIR__ . '/widgets/payment_widget.php');

// Регистрация класса виджета
add_action( 'widgets_init', 'my_register_widgets' );
function my_register_widgets() {
    register_widget( 'PhoneCall_Widget' );
    register_widget( 'DaysWork_Widget' );
    register_widget( 'Payment_Widget' );
}

add_action( 'widgets_init', 'true_register_wp_sidebars' );
function true_register_wp_sidebars() {

    register_sidebar(
        array(
            'id' => 'how-order',
            'name' => 'Боковая колонка "Как заказать"',
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.',
            'before_widget' => '<div id="%1$s" class="side widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );

    register_sidebar(
        array(
            'id' => 'page-sidebar',
            'name' => 'Боковая колонка простых страниц',
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.',
            'before_widget' => '<div id="%1$s" class="side widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );

}

add_action( 'widgets_init', 'true_remove_default_widget', 20 );
function true_remove_default_widget() {
    unregister_widget('WP_Widget_Archives'); // Архивы
    unregister_widget('WP_Widget_Calendar'); // Календарь
    unregister_widget('WP_Widget_Categories'); // Рубрики
    unregister_widget('WP_Widget_Meta'); // Мета
    unregister_widget('WP_Widget_Pages'); // Страницы
    unregister_widget('WP_Widget_Recent_Comments'); // Свежие комментарии
    unregister_widget('WP_Widget_Recent_Posts'); // Свежие записи
    unregister_widget('WP_Widget_RSS'); // RSS
    unregister_widget('WP_Widget_Search'); // Поиск
    unregister_widget('WP_Widget_Tag_Cloud'); // Облако меток
    unregister_widget('WP_Widget_Text'); // Текст
    unregister_widget('WP_Nav_Menu_Widget'); // Произвольное меню
}
