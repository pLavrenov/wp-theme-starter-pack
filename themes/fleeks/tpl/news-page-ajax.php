<?php
/**
 * Template Name: Страница новостей
 */
get_header(); ?>

    <?php query_posts([
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'orderby'     => 'date',
        'order'       => 'DESC',
    ]); ?>

    <div id="load_list">
        <?php if( have_posts() ){
            while( have_posts() ){ the_post();
                get_template_part( 'tpl/path/news/news-list-item', get_post_format() );
            }
        } ?>
    </div>

    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <script>
            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
            var action = 'loadmore';
        </script>
        <div id="true_loadmore">Показать еще</div>
    <?php endif; ?>

    <?php wp_reset_query(); ?>


<?php get_footer(); ?>