<?php

class DaysWork_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            '',
            'Сроки выполнения',
            [
                'description' => 'Описание виджета'
            ]
        );
    }

    // Вывод виджета
    function widget( $args, $instance ){
        ?>
        <div class="phone-side">
            <div class="count">
                <div class="co"><?php _e('3-5', 'fleeks_theme') ?></div>
                <div><?php _e('дней', 'fleeks_theme') ?></div>
            </div>
            <div class="text-me"><?php _e('Срок выполнения заказа', 'fleeks_theme') ?></div>
        </div>
        <?php
    }
}
