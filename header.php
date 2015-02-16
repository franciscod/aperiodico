<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aperiodico2015
 */

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

	<header id="masthead" class="site-header desplegado" role="banner">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<div class="logo">&nbsp;</div>
			</a>
		</h1>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php /* wp_nav_menu( array( 'theme_location' => 'primary' ) ); */ ?>
			<span class="menu">
				<span class="flecha ediciones">Ediciones</span>
				<span class="flecha acerca">Acerca</span>
				<span class="flecha contacto">Contacto</span>
			</span>
		</nav><!-- #site-navigation -->
		<div class="ediciones">
			<div class="miniatura"></div>
			<div class="columnas">
		<?php
			$ediciones = get_posts(array(
				'posts_per_page' => -1, // all of them
				'category' => 'ediciones',
			));

			foreach ($ediciones as $edicion) {
				list($o, $num, $tit) = apsi_split_titulo($edicion->post_title);
				$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
				$thumb_url = $thumb_data[0];
				$link = get_permalink($edicion->ID);

				echo "
				<div class='edicion' data-thumb-url='$thumb_url'>
					<a href='$link'>
						<span class='num'>N°$num </span>
						$tit
					</a>
				</div>";
			}
		?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
