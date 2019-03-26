<?php

add_filter( 'add_filter_rules', 'filter_rules' );
function filter_rules($rules, $post){

    /*
        if (isset($_POST['filter']['projects_square']) && $_POST['filter']['projects_square'] != '') {
            $args['tax_query'][] = [
                [
                    'taxonomy' => 'projects_square',
                    'field'    => 'term_id',
                    'terms'    => $_POST['filter']['projects_square'],
                ]
            ];
        }

        if (isset($_POST['filter']['floor_count']) && $_POST['filter']['floor_count'] != '') {
            $args['tax_query'][] = [
                [
                    'taxonomy' => 'projects_floor',
                    'field'    => 'term_id',
                    'terms'    => $_POST['filter']['floor_count'],
                ]
            ];
        }

        if (isset($_POST['filter']['rooms_count']) && $_POST['filter']['rooms_count'] != '') {
            $args['meta_query'][] = [
                [
                    'key' => 'количество_спален',
                    'value' => $_POST['filter']['rooms_count'],
                    'compare' => '=',
                    'type' => 'NUMERIC',
                ]
            ];
        }

        if (isset($_POST['filter']['price']['min']) && isset($_POST['filter']['price']['max'])) {
            $args['meta_query'][] = [
                [
                    'key' => 'цена_проекта',
                    'value' => [$_POST['filter']['price']['min'], $_POST['filter']['price']['max']],
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC',
                ]
            ];
        }

            if (isset($_POST['filter']['price']['min']) && isset($_POST['filter']['price']['max'])) {
                $args['meta_query'][] = [
                    [
                        'key' => 'стоимость',
                        'value' => [$_POST['filter']['price']['min'], $_POST['filter']['price']['max']],
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC',
                    ]
                ];
            }

            if (isset($_POST['filter']['area']['min']) && isset($_POST['filter']['area']['max'])) {
                $args['meta_query'][] = [
                    [
                        'key' => 'общая_площадь',
                        'value' => [$_POST['filter']['area']['min'], $_POST['filter']['area']['max']],
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC',
                    ]
                ];
            }

            if (isset($_POST['filter']['terrace']['min']) && isset($_POST['filter']['terrace']['max'])) {
                $args['meta_query'][] = [
                    [
                        'key' => 'площадь_терасс',
                        'value' => [$_POST['filter']['terrace']['min'], $_POST['filter']['terrace']['max']],
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC',
                    ]
                ];
            }

            if (isset($_POST['filter']['floor']) && $_POST['filter']['floor'] != '') {
                $args['meta_query'][] = [
                    [
                        'key' => 'этажность',
                        'value' => $_POST['filter']['floor'],
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    ]
                ];
            }

            if (isset($_POST['filter']['bedroom']) && $_POST['filter']['bedroom'] != '') {
                $args['meta_query'][] = [
                    [
                        'key' => 'количество_спален',
                        'value' => $_POST['filter']['bedroom'],
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    ]
                ];
            }


        */

    /*
    if ($_POST['filter']['sort_by'] != 'date') {
        $args['meta_key'] = $_POST['filter']['sort_by'];
        $args['orderby'] = 'meta_value_num';
    }

    if ($_POST['filter']['order_by'] == 'DESC' || $_POST['filter']['order_by'] == 'ASC') {
        $args['order'] = $_POST['filter']['order_by'];
    }
    */

    return $rules;
}

