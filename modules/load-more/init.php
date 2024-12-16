<?php

define('MY_LOADMORE_PATH', get_stylesheet_directory_uri() . '/modules/load-more');

add_action('wp_footer', function () {
    if(is_admin()) return false;
    //wp_deregister_script('jquery');
    //wp_enqueue_script('jquery');
    if (is_post_type_archive()) {
        wp_enqueue_script('loadmore', MY_LOADMORE_PATH . '/assets/loadmore.js', [], '0.0.1', true);
    }
});

// Ajax загрузка новостей
add_action('wp_ajax_loadmore', 'load_more');
add_action('wp_ajax_nopriv_loadmore', 'load_more');
function load_more(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    query_posts( $args );
    if( have_posts() ) {
        while( have_posts() ): the_post();
            switch ($args['post_type']) {
                case 'shop':
                    get_template_part('views/path/portfolio/portfolio-list-item', get_post_format());
                    break;
                case 'portfolio':
                    get_template_part('views/path/portfolio/portfolio-list-item', get_post_format());
                    break;
                case 'article':
                    get_template_part('views/path/article/article-list-item', get_post_format());
                    break;
                case 'video':
                    get_template_part('views/path/video/video-list-item', get_post_format());
                    break;
            }

        endwhile;
    }
    die();
}
