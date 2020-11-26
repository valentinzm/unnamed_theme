<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  	<?php
		wp_nav_menu( [
			'theme_location'  => 'primary',
			'menu'            => 'main-menu',
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'menu_class'      => 'navbar-nav',
			'fallback_cb' => '__return_empty_string'
			] );
	?>
</nav>