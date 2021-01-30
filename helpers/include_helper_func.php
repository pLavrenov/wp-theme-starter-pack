<?php


function get_images($id, $size = 'thumbnail') {
    $id = get_post_thumbnail_id($id);
    return wp_get_attachment_image_src( $id , $size)[0];
}