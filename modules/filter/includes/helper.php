<?php

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

function all_meta_values($key) {
    global $wpdb;
    $result = $wpdb->get_col(
        $wpdb->prepare( "
			SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s' 
			AND p.post_status = 'publish'
			ORDER BY pm.meta_value",
            $key
        )
    );

    return $result;
}
