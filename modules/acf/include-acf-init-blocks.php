<?php

/*
 * description - Не обязательно. Описание блока.
 * keywords - Не обязательно. Теги блока.
 */

function dashesToText($string, $replace = '') {
	$str = str_replace(' ', $replace, str_replace('-', ' ', $string));
	$str[0] = ucwords($str[0]);
	return $str;
}

$files = array_slice(scandir(MY_ACF_BLOCKS_PATH), 2);

foreach ($files as $file)
{
    $name = str_replace('.php', '', $file);
    //$title = apply_filters('fleeks_block_title', dashesToText($name, ' '));
    $title = apply_filters('fleeks_block_title', $name);
    acf_register_block_type([
        'name' => $name,
        'title' => __($title, 'fleeks_theme'),
        'render_callback' => 'my_acf_block_render_callback',
        'category' => 'fleeks',
        'icon' => my_acf_block_icon_helper('admin-comments'),
//        "style" => [
//            "file:../../styles/s.css",
//        ],
//        "editorStyle" => "file:./editor.css",
        'mode' => 'edit',
        'supports' => [
            //'mode' => false,
            'jsx' => true,
            'align' => array('center', 'wide', 'full' ),
        ],
    ]);
}