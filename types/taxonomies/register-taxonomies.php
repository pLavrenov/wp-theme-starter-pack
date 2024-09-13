<?php
//hook into the init action and call create_book_taxonomies when it fires
function create_topics_hierarchical_taxonomy() {

    register_taxonomy('news_types', ['news'], [
        'hierarchical' => true,
        'labels' => [
            'name' => _x( 'Категория', 'Название единственного числа' ),
            'singular_name' => _x( 'Категория', 'Название множественного числа' ),
            /*
            'search_items' =>  __( 'Search Topics' ),
            'all_items' => __( 'All Topics' ),
            'parent_item' => __( 'Parent Topic' ),
            'parent_item_colon' => __( 'Parent Topic:' ),
            'edit_item' => __( 'Edit Topic' ),
            'update_item' => __( 'Update Topic' ),
            'add_new_item' => __( 'Add New Topic' ),
            'new_item_name' => __( 'New Topic Name' ),
            'menu_name' => __( 'Topics' ),
            */
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'has_archive' => true,
        'rewrite' =>  [
            'slug' => 'news',
        ],
    ]);

}
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );