<?php

/*
 *   data-compare-add="<?php echo $post->ID ?>"      - Добавление в сравнение
 *
 *
 *
 *
 */


add_action('wp_ajax_get_compare_posts', 'get_compare_posts');
add_action('wp_ajax_nopriv_get_compare_posts', 'get_compare_posts');
function get_compare_posts(){
    $posts = get_posts([
        'numberposts' => -1,
        'include' => $_POST['items'],
        'post_type' => 'product',
        'suppress_filters' => true,
    ]);
    foreach($posts as $post){ setup_postdata($post);
        //get_template_part( '', get_post_format() );
        ?>

        <li compare-post-id="<?php echo $post->ID ?>">
            <a href="<?php the_permalink($post) ?>" class="top-info">
                <h4><?php echo $post->post_title ?></h4>
                <div class="top-info__subtitle">Артикул  F3-2.5</div>
            </a>
            <ul class="list">
                <li><?php the_field('размер', $post) ?></li>
                <li><?php the_field( 'вынос', $post ); ?></li>
                <li><?php the_field( 'диаметр_барабана', $post ); ?></li>
                <li><?php the_field( 'фронтальная_балка', $post ); ?></li>
                <li><?php the_field( 'задняя_несущая_балка', $post ); ?></li>
                <li><?php the_field( 'локоть', $post ); ?></li>
                <li><?php the_field( 'скидка', $post ); ?></li>
            </ul>
            <a class="delete" onclick="compare_delete_post(<?php echo $post->ID ?>)"><?php _e('Удалить', 'fleeks_theme') ?></a>
        </li>

        <?php //echo get_field('', $post) ?>

    <?php } wp_reset_postdata();
    die();
}


add_action('wp_footer', function() {
    wp_enqueue_script('compare', get_template_directory_uri() . '/modules/compare/js/compare.js', ['main'],'',true);
});
