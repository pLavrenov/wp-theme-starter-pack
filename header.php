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

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
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