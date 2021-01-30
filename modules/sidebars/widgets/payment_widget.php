<?php

class Payment_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            '',
            'Способы оплаты',
            [
                'description' => 'Описание виджета'
            ]
        );
    }

    // Вывод виджета
    function widget( $args, $instance ){
        ?>
        <div class="phone-side">
            <div class="img">
                <img src="<?php echo get_template_directory_uri() ?>/images/side-coin.png" alt="">
            </div>
            <div class="text-me"><?php _e('К оплате принимаются банковские карты', 'fleeks_theme') ?></div>
        </div>
        <?php
    }
}
