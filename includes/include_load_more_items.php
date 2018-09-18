<?php
// Ajax загрузка новостей
function load_more(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    query_posts( $args );
    if( have_posts() ) {
        while( have_posts() ): the_post();
            switch ($args['post_type']) {
                case 'news':
                    get_template_part( 'tpl/path/news/news-list-item', get_post_format() );
                    break;
            }

        endwhile;
    }
    die();
}
add_action('wp_ajax_loadmore', 'load_more');
add_action('wp_ajax_nopriv_loadmore', 'load_more');