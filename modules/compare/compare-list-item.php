<li compare-post-id="<?php echo $post->ID ?>">
    <a href="<?php the_permalink($post) ?>" class="top-info">
        <h4><?php echo $post->post_title ?></h4>
        <div class="top-info__subtitle"><?php _e('Артикул', 'fleeks_theme') ?> <?php the_field('артикул') ?></div>
    </a>
    <ul class="list">
        <li><?php the_field('размер') ?></li>
        <li><?php the_field( 'вынос' ); ?></li>
        <li><?php the_field( 'диаметр_барабана' ); ?></li>
        <li><?php the_field( 'фронтальная_балка' ); ?></li>
        <li><?php the_field( 'задняя_несущая_балка' ); ?></li>
        <li><?php the_field( 'локоть' ); ?></li>
        <li><?php the_field( 'скидка' ); ?></li>
    </ul>
    <a class="delete" onclick="compare_delete_post(<?php echo $post->ID ?>)"><?php _e('Удалить', 'fleeks_theme') ?></a>
</li>
