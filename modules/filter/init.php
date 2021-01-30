<?php

require_once( __DIR__ . '/includes/helper.php');
require_once( __DIR__ . '/filter_rules.php');

add_action('wp_ajax_loadmore_filter', 'loadmore_filter');
add_action('wp_ajax_nopriv_loadmore_filter', 'loadmore_filter');
function loadmore_filter(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    parse_str($_POST['filter'], $filter_values);

    $args = apply_filters( 'add_filter_rules', $args, $filter_values);

    $loop = new WP_Query( $args );

    $returned = [];

    $returned['count'] = $loop->found_posts;
    $returned['page'] = $loop->paged;
    $returned['max_page'] = $loop->max_num_pages;
    $returned['posts'] = makePostLists($loop->posts);

    echo json_encode($returned);

    die();
}

function makePostLists($posts) {
    $str = '';
    foreach ($posts as $post) {
        $str .= load_template_part('tpl/path/catalog/catalog-item-with-wrapper', $post);
    }
    return $str;
}

function load_template_part($template_name, $post) {
    ob_start();
    set_query_var( 'loaded_post', $post );
    get_template_part($template_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

add_action('wp_footer', function() {
    wp_enqueue_script('filter', get_template_directory_uri() . '/modules/filter/js/filter.js', ['main'],'',true);
});
