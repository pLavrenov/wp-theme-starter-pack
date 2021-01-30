<?php

/*
function max_meta_value($name){
    global $wpdb;
    $query = "SELECT max(cast(meta_value as unsigned)) FROM ".$wpdb->postmeta." WHERE meta_key='".$name."'";
    $the_max = $wpdb->get_var($query);
    return $the_max;
}

function min_meta_value($name){
    global $wpdb;
    $query = "SELECT min(cast(meta_value as unsigned)) FROM ". $wpdb->postmeta ." WHERE meta_key='".$name."'";
    $the_max = $wpdb->get_var($query);
    return $the_max;
}
*/

function all_meta_values($meta, $post_type) {
    global $wpdb;
    $result = $wpdb->get_col(
        $wpdb->prepare( "
			SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s' 
			AND p.post_status = 'publish'
			AND p.post_type = '%s'
			ORDER BY pm.meta_value",
            $meta,
            $post_type
        )
    );

    return $result;
}

function out_meta_value($meta, $post_type, $out = 'MAX') {
    global $wpdb;
    return $wpdb->get_var(
        $wpdb->prepare("
			SELECT {$out}( cast( meta_value as unsigned) ) FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s'
			AND p.post_status = 'publish'
			AND p.post_type = '%s'",
            $meta,
            $post_type
        )
    );
}


function get_posts_ids($post_type, $count = 10, $meta = []) {
    $args = [
        'posts_per_page' => $count,
        'fields' => 'ids',
        'post_type' => $post_type,
        'post_status' => 'publish',
        'suppress_filters' => false,
    ];

    $query = get_posts(array_merge($args, $meta));

    return $query->posts;
};

function get_posts_name_fields($post_type, $meta = []) {

    $return = [];

    $args = [
        'posts_per_page' => -1,
        'post_type' => $post_type,
        'post_status' => 'publish',
        'suppress_filters' => false,
    ];

    $posts = get_posts(array_merge($args, $meta));

    foreach ($posts as $post) {
        $return[] = [
            'name' => $post->post_title,
            'value' => $post->ID,
        ];
    }
    return $return;
};

