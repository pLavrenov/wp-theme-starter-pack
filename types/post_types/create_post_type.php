<?php

// Для работы Gutenberg должен быть включен supports => editor и show_in_rest => true

add_action( 'init', 'custom_post_type', 0 );
function custom_post_type() {

    register_post_type( 'news', [
        'label'               => __( 'Новости', 'fleeks_admin_theme' ),
        'description'         => __( 'Новости компании', 'fleeks_admin_theme' ),
        'labels'              => [
            'name'                => _x( 'Новости', 'Множественное название', 'fleeks_admin_theme' ),
            'singular_name'       => _x( 'Новость', 'Еденичное название', 'fleeks_admin_theme' ),
        ],
        // Features this CPT supports in Post Editor
        'supports'            => ['title', 'editor', 'revisions'],
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => [],
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    ]);

}

