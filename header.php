<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aperiodico2015
 */

require get_template_directory() . '/inc/aperiodico-data.php';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Montserrat:700,400' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'aperiodico2015' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.svg">
			</a>
		</h1>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php /* wp_nav_menu( array( 'theme_location' => 'primary' ) ); */ ?>
			<span class="menu">
				<?php foreach (array_keys($apsi_menu) as $m) {
					?><span class="flecha <?php echo $m; ?>"><?php echo $apsi_menu[$m]; ?></span><?php
				} ?>
			</span>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
