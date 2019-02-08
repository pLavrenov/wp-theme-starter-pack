<?php

/*
 * description - Не обязательно. Описание блока.
 * keywords - Не обязательно. Теги блока.
 */

// Добавление блока
acf_register_block([
    'name'				=> 'testimonial',
    'title'				=> __('Testimonial'),
    'render_callback'	=> 'my_acf_block_render_callback',
    'category'			=> 'fleeks',
    'icon'				=> my_acf_block_icon_helper('admin-comments'),
]);
