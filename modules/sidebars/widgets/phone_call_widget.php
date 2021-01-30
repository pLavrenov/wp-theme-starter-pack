<?php

class PhoneCall_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            '',
            'Телефон для заказа',
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
                <img src="<?php echo get_template_directory_uri() ?>/images/side-phone.png" alt="">
                <span class="minitext"><?php _e('многоканальный', 'fleeks_theme') ?></span>
            </div>
            <div class="phone"><a href="tel:+74959843848">+7 (495) 984-38-48</a></div>
            <div class="text-me"><?php _e('Вызов консультанта бесплатный', 'fleeks_theme') ?></div>
        </div>
        <?php
    }
}
