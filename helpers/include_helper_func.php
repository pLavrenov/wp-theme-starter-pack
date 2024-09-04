<?php


/**
 * Retrieves the URL of an image attachment for a given post ID.
 *
 * @param int $id The post ID to retrieve the image attachment for.
 * @param string $size The size of the image to retrieve. Defaults to 'thumbnail'.
 * @return string The URL of the image attachment.
 */
function get_images($id, $size = 'thumbnail') {
    $id = get_post_thumbnail_id($id);
    return wp_get_attachment_image_src( $id , $size)[0];
}

/**
 * Formats a given number of bytes into a human-readable format.
 *
 * @param int   $bytes     The number of bytes to format.
 * @param int   $precision The number of decimal places to round to. Defaults to 2.
 * @param string $delimiter The delimiter to use between the number and the unit. Defaults to ' '.
 *
 * @return string The formatted bytes.
 */
function format_bytes ($bytes, $precision = 2, $delimiter = ' ') {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    $bytes = max($bytes, 0);
    $pow   = floor(( $bytes ? log( $bytes ) : 0 ) / log( 1024 ));
    $pow   = min($pow, count( $units ) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . $delimiter . $units[$pow];
}

/**
 * Retrieves a post by its slug from the specified post type.
 *
 * @param string $slug The slug of the post.
 * @param string $post_type The post type to search in. Defaults to 'post'.
 * @return WP_Post|null The post object if found, null otherwise.
 */
function get_post_by_slug($slug, $post_type = 'post') {
    if($my_posts = get_posts([
        'name' => $slug,
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => 1
    ])) return $my_posts[0];
    return null;
}

/**
 * Builds a tree structure from a given array of elements.
 *
 * @param array &$elements The array of elements to build the tree from.
 * @param int $parentId The ID of the parent element. Defaults to 0.
 * @return array The built tree structure.
 */
function build_tree( array &$elements, $parentId = 0 )
{
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->childrens = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
}