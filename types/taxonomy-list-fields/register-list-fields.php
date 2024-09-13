<?php

$fields_array = [
    [
        'name' => 'Цвет',
        'name_slug' => 'color',
        'taxonomy_name' => 'product_color_scheme',
        'content' => "<div style='height: 40px;width:40px;background-color: {цвет};'></div>",
    ],
];

add_taxonomy_list_field($fields_array);

function add_taxonomy_list_field($fields_array) {
    foreach ($fields_array as $field) {

        add_filter('manage_edit-'. $field['taxonomy_name'] .'_columns', function( $columns ) use ( $field ) {
            $columns[$field['name_slug']] = $field['name'];
            return $columns;
        });

        add_filter('manage_'. $field['taxonomy_name'] .'_custom_column', function ($out, $column_name, $term_id) use ( $field ) {
            if ($column_name == $field['name_slug']) {

                $term_name = $field['taxonomy_name']. '_' .$term_id;

                $out .=  preg_replace_callback('/{(.*?)}/', function($matches) use ($term_name) {
                    return get_field($matches[1], $term_name);
                }, $field['content']);

            }
            return $out;
        }, 10, 3);

    }
}


