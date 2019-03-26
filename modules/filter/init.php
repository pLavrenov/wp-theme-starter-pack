<?php

require_once( __DIR__ . '/includes/helper.php');
require_once( __DIR__ . '/filter_rules.php');

add_action('wp_ajax_loadmore_filter', 'loadmore_filter');
add_action('wp_ajax_nopriv_loadmore_filter', 'loadmore_filter');
function loadmore_filter(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $args['meta_query'] = [
        'relation' => 'AND'
    ];

    //$args = apply_filters( 'add_filter_rules', $args, $_POST );

    query_posts( $args );
    if( have_posts() ) {
        while( have_posts() ): the_post(); ?>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <?php get_template_part( 'tpl/path/catalog/catalog-item', get_post_format() ); ?>
            </div>
        <?php endwhile;
    }
    die();
}

add_action('wp_footer', function() {
    wp_enqueue_script('filter', get_template_directory_uri() . '/modules/filter/js/filter.js', ['main'],'',true);
});
