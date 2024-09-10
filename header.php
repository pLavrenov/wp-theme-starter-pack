<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    if (!$meta_title = get_field('meta_title')) $meta_title = get_field('meta_title', 'option');
    if ($meta_title) { ?>
        <title><?php echo $meta_title ?></title>
        <meta property="og:title" content="<?php echo $meta_title ?>">
        <meta name="twitter:title" content="<?php echo $meta_title ?>">
    <?php } ?>

    <?php
    if (!$meta_description = get_field('meta_description')) $meta_description = get_field('meta_description', 'option');
    if ($meta_description) { ?>
        <meta name="description" content="<?php echo $meta_description ?>">
        <meta property="og:description" content="<?php echo $meta_description ?>">
        <meta name="twitter:description" content="<?php echo $meta_description ?>">
    <?php } ?>

    <?php
    if (!$meta_image = get_field('meta_image')) $meta_image = get_field('meta_image', 'option');
    if ($meta_image) { ?>
        <meta property="og:image" content="<?php echo $meta_image ?>">
        <meta name="twitter:image" content="<?php echo $meta_image ?>">
    <?php } ?>

    <meta property="og:url" content="<?php echo home_url($wp->request) ?>">
    <meta property="twitter:url" content="<?php echo home_url($wp->request) ?>">
    <meta property="twitter:domain" content="fleeks.ru">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
        <?php $args = array(
            'theme_location' => 'top',
            'container'=> false,
            'menu_id' => 'top-nav-ul',
            'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
            'menu_class' => 'top-menu'
        );
        wp_nav_menu($args);
        ?>
	</header>