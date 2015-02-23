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
				<a href="#" class="flecha ediciones">Ediciones</a>
				<a href="#" class="flecha acerca">Acerca</a>
				<a href="#" class="flecha contacto">Contacto</a>
			</span>
		</nav><!-- #site-navigation -->

		<div class="seccion ediciones">
		<?php
		$ultima = get_posts(array(
			'posts_per_page' => 1,
			'category' => 'ediciones',
		));
		$edicion = $ultima[0];
		$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID, 'full'));
		$thumb_url = $thumb_data[0];
		?>
			<div class="miniatura" style="background-image: url('<?php echo $thumb_url; ?>')"></div>
			<div class="columnas">
		<?php
			$ediciones = get_posts(array(
				'posts_per_page' => -1, // all of them
				'category' => 'ediciones',
			));

			foreach ($ediciones as $edicion) {
				list($o, $num, $tit) = apsi_split_titulo($edicion->post_title);
				$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID, 'full'));
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

		<div class="seccion acerca">
			<img class="edit" src=" <?php echo get_template_directory_uri(); ?>/img/edit_tendlarz.jpg">
			<div class="texto">
				El Aperiódico Psicoanalítico ha nacido hace 12 años causado por llevar el psicoanálisis de la orientación lacaniana a la comunidad. Especialmente a la comunidad no analítica. Hoy debo decir que esto es un hecho. No sólo que lo hemos logrado, sino que además numerosos analistas, coleccionan cada uno de estos números usándolos como referencias para su elaboración clínica. Estos efectos son el resultado, por un lado, la elección de temas monográficos y por otro, la calidad de los que han intervenido con sus artículos. La clínica contemporánea nos interesa y nos interroga constantemente. A ella debemos responder. Los invito a que no se detengan donde la lectura tiene sus consecuencias.
				<br><br>
				Edit TENDLARZ<br>
				Directora
			</div>
		</div>

		<div class="seccion contacto">
			contacto
		</div>



		<script>
			$('.columnas .edicion').on('mouseover', function (e) {
				$('.miniatura').css('background-image', 'url("'+ $(this).data('thumb-url') +'")')
			});

			{ // header

				var _h = null;

				function openHeader(cb) {
					if (_h === null) {
						if ($('body').hasClass('home')) {
							$('body').animate({'margin-top': '372px'}, 400, 'ease');
						}
						$('.site-header').animate({'height': '372px'}, 400, 'ease', cb);
					} else {
						cb();
					}
				}

				function closeHeader(cb) {
					if ($('body').hasClass('home')) {
						$('body').animate({'margin-top': '90px'}, 400, 'ease');
					}
					$('.site-header').animate({'height': '90px'}, 400, 'ease', function() {
						_h = null;
						cb();
					});
				}

				function fadeOutCurrent(cb){
					if (_h !== null) {
						var sec = $('.seccion').get(_h);
						$(sec).fadeOut(400, cb);
					} else {
						cb();
					}
				}

				function fadeIn(i, cb) {
					var sec = $('.seccion').get(i);
					$(sec).fadeIn(400, cb);
					_h = i;
				}

				$('.menu a').click(function() {
					var i = $(this).index();
					if (i == _h) {
						fadeOutCurrent(function() {
							closeHeader();
						});
					} else {
						openHeader(function() {
							fadeOutCurrent(function() {
								fadeIn(i);
							});
						})
					}
				})

		}
		</script>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
