<?php

add_filter( 'add_filter_rules', 'filter_rules', 10, 2 );
function filter_rules($rules, $post){

    $rules['meta_query'] = [];

    $rules['meta_query']['relation'] = 'AND';
    $rules['tax_query']['relation'] = 'AND';

    // Вид
    if (is_array($post['types'])) {
        $rules['meta_query'][] = [
            [
                'key' => 'вид_продукта',
                'value'    => $post['types'],
                'compare'  => 'IN',
            ]
        ];
    }

    // Цена
    if (is_array($post['price'])) {
        $rules['meta_query'][] = [
            [
                'key' => '_new_price',
                'value' => [
                    intval($post['price']['min']),
                    intval($post['price']['max'])
                ],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            ]
        ];
    }

    // Ширина
    if (is_array($post['width'])) {
        $rules['meta_query'][] = [
            [
                'key' => 'ширина',
                'value' => [
                    intval($post['width']['min']),
                    intval($post['width']['max'])
                ],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            ]
        ];
    }

    // Вынос
    if (is_array($post['long'])) {
        $rules['meta_query'][] = [
            [
                'key' => 'вынос',
                'value' => $post['long'],
                'compare'  => 'IN',
            ]
        ];
    }

    // Цвет товара
    if (is_array($post['product_color_scheme'])) {
        $rules['tax_query'][] = [
            [
                'taxonomy' => 'product_color_scheme',
                'field'    => 'slug',
                'operator'  => 'IN',
                'terms'    => $post['product_color_scheme'],
            ]
        ];
    }


    // Ветровая нагрузка
    if ($post['wind']) {
        $rules['meta_query'][] = [
            [
                'key' => 'ветровая_нагрузка',
                'value' => intval($post['wind']),
                'compare' => '<=',
                'type' => 'NUMERIC',
            ]
        ];
    }

    // Электропривод
    if ($post['rotor'] != '') {
        $rules['meta_query'][] = [
            [
                'key' => 'электропривод',
                'value' => $post['rotor'],
                'compare' => '=',
            ]
        ];
    }

    /*
     *
     *  Неиспользуемые
     *
    if (is_array($post['product_types'])) {
        $rules['tax_query'][] = [
            [
                'taxonomy' => 'product_types',
                'field'    => 'slug',
                'operator'  => 'IN',
                'terms'    => $post['product_types'],
            ]
        ];
    }

    if (is_array($post['product_cloth'])) {
        $rules['tax_query'][] = [
            [
                'taxonomy' => 'product_cloth',
                'field'    => 'slug',
                'operator'  => 'IN',
                'terms'    => $post['product_cloth'],
            ]
        ];
    }
    */


    if (is_string($post['sort'])) {

        // meta_value_num meta_value

        switch ($post['sort']) {
            case 'price':
                $rules['meta_key'] = '_new_price';
                $rules['orderby'] = 'meta_value_num';
                break;
            case 'sale':
                $rules['meta_key'] = '_new_discount';
                $rules['orderby'] = 'meta_value_num';
                break;
            case 'popular':
                $rules['meta_key'] = 'цена';
                $rules['orderby'] = 'meta_value_num';
                break;
            default:
                $rules['orderby'] = 'date';
        }

    }

    if ($post['order'] == 'DESC' || $post['order'] == 'ASC') {
        $rules['order'] = $post['order'];
    }

    return $rules;
}

