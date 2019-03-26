<?php
/**
 * Template Name: Сравнение товаров
 */
get_header(); ?>

    <ul id="load_list" class="compare-product-columns"></ul>

    <script>
        jQuery(function($){
            $(document).ready(function($) {
                compare_get_posts({
                    url: '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                    action: 'get_compare_posts',
                    element: '#load_list'
                });
            });
        });
    </script>

<?php get_footer(); ?>
