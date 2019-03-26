<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>


    <?php get_template_part( 'modules/filter/tpl/filter-block' ); ?>


    <?php query_posts([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'orderby'     => 'date',
        'order'       => 'DESC',
    ]); ?>

    <div id="load_list" class="row catalog-list-items">
        <?php if( have_posts() ){
            while( have_posts() ){ the_post(); ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <?php get_template_part( 'tpl/path/catalog/catalog-item', get_post_format() ); ?>
                </div>
            <?php }
        } ?>
    </div>

    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <script>
            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
            var action = 'loadmore_filter';
        </script>

        <div class="butncenter" style="text-align: center;margin-bottom: 30px;">
            <div id="filter_loadmore" class="cardk__order-buy"
                 data-text-loaded="<?php _e('Показать еще', 'fleeks_theme') ?>"
                 data-text-loading="<?php _e('Загружаю', 'fleeks_theme') ?>"
            >
                <?php _e('Показать еще', 'fleeks_theme') ?>
            </div>
        </div>

    <?php endif; ?>

    <?php wp_reset_query(); ?>


<?php get_footer(); ?>
