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
	<div id="ho" class="ow">
	<div class="sombra">
	<header id="masthead" class="site-header desplegado iw" role="banner">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<div class="logo">&nbsp;</div>
			</a>
		</h1>
		<div class="navtoggle">
			<div></div>
			<div></div>
			<div></div>
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a id="buscar" class="lupa" href="#">
			</a>
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
		$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
		$thumb_url = $thumb_data[0];
		?>
			<div class="miniatura" style="background-image: url('<?php echo $thumb_url; ?>')"></div>
			<div class="columnas">
		<?php
			$ediciones = get_posts(array(
				'posts_per_page' => -1, // all of them
				'category' => 'ediciones',
			));

			$thumb_urls = array();

			foreach ($ediciones as $edicion) {
				list($o, $num, $tit) = apsi_split_titulo($edicion->post_title);
				$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
				$thumb_url = $thumb_data[0];
				$link = get_permalink($edicion->ID);
				$thumb_urls[] = $thumb_url;

				echo "
				<div class='edicion' data-thumb-url='$thumb_url'>
					<a href='$link'>
						<span class='num'>N°$num </span>
						$tit
					</a>
				</div>";
			}
		?>
			<script><?php $i=0; foreach ($thumb_urls as $thumb_url) { ?>
				var imgPreloader<?php echo $i; ?> = new Image();
				imgPreloader<?php echo $i++; ?>.src = '<?php echo $thumb_url; ?>';
				<?php } ?></script>
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

		<div class="seccion contact">
			<div class="hcleft">
				<div class="contacto">
					<div class="contact-item"><b>MAIL: </b>etendlar@fibertel.com.ar</div>
					<div class="contact-item"><b>TELÉFONO: </b>(+54 11) 4771 1625</div>

				</div>
				<?php apsi_social(); ?>
			</div>

			<div class="ed-ant">
				<div class="upperbold">Ediciones Anteriores</div>
				<span>
					Para conseguir ediciones anteriores puede contactarse con la redacción del Aperiódico Psicoanalítico:
				</span>
				<div class="contact-item"><b>MAIL: </b>etendlar@fibertel.com.ar</div>
				<div class="contact-item"><b>TELÉFONO: </b>(+54 11) 4771 1625</div>

				<small>Envíos en formato digital a cualquier parte del mundo previo depósito bancario. Precio actualizado al valor de la última edición más costos administrativos.</small>
			</div>

		</div>



		<script>

			 // header
			$(function() {
				$('header .columnas .edicion').on('mouseover', function (e) {
					$('.miniatura').css('background-image', 'url("'+ $(this).data('thumb-url') +'")')
				});

				var _h = null;
				var _l = false;
				var _n = false;

				function grabLockOrStop(cb) {
					if (_l) return;
					_l = true;
					if (cb) cb();
				}

				function releaseLock(cb) {
					_l = false;
					if (cb) cb();
				}

				function openHeader(cb) {
					if (_h === null) {
						var __d = _n ? 2 : 3;
						var __e = _n ? 254 : 204;
						var hh = '' + (Math.floor($('.columnas').children().length / __d) * 26 + __e) + 'px';

						$('body').animate({'margin-top': hh}, 400, 'ease');
						$('.site-header').animate({'height': hh}, 400, 'ease', cb);
					} else {
						if (cb) cb();
					}
				}


				function midHeader(cb) {
					$('body').animate({'margin-top': '180px'}, 400, 'ease');
					$('.site-header').animate({'height': '180px'}, 400, 'ease', function() {
						_h = null;
						if (cb) cb();
					});
				}

				function closeHeader(cb) {
					var hh = _n ? '180px' : '96px';
					$('body').animate({'margin-top': hh}, 400, 'ease');
					$('.site-header').animate({'height': hh}, 400, 'ease', function() {
						_h = null;
						if (cb) cb();
					});
				}

				function fadeOutCurrent(cb){
					if (_h !== null) {
						var sec = $('.seccion').get(_h);
						$(sec).fadeOut(400, cb);
						$($('.menu a').get(_h)).removeClass('selected');
					} else {
						if (cb) cb();
					}
				}

				function fadeIn(i, cb) {
					var sec = $('.seccion').get(i);
					_h = i;
					$($('.menu a').get(_h)).addClass('selected');
					$(sec).fadeIn(400, cb);
				}

				function foldHeader() {
					if (_h !== null) {
						grabLockOrStop(function() {
							fadeOutCurrent(function() {
								closeHeader(function() {
									releaseLock();
								});
							});
						});
					}
				}

				$('#content').click(foldHeader);
				$('#colophon').click(foldHeader);

				$('header .menu a').click(function() {
					var i = $(this).index();
					if (i == _h) {
						foldHeader();
					} else {
						grabLockOrStop(function() {
							openHeader(function() {
								fadeOutCurrent(function() {
									fadeIn(i, function() {
										releaseLock()
									});
								});
							});
						});
					}
				})


				$('.navtoggle').click(function() {
					_n = !_n;
					if (_n) {
						grabLockOrStop(function() {
							closeHeader(function() {
								$('nav#site-navigation').fadeIn(400, function () {
									releaseLock();
								});
							});
						});
					} else {
						grabLockOrStop(function() {
							fadeOutCurrent(function() {
								$('nav#site-navigation').fadeOut(400, function() {
									closeHeader(function() {
										releaseLock();
									});
								});
							});
						});
					}
				})
		});

		</script>
	</header><!-- #masthead -->
	</div>
	</div>
	<a href="#" class="back-to-top"></a>
	<script>

	$(function() {
		var offset = 250;
		var duration = 300;
		$(window).scroll(function() {
			var st = $(this).scrollTop();
			var cs = 1000000;
			if ($('#colophon').css('display') !== 'none') {
				cs = $('#colophon').offset().top - $(window).height();
			}
			if (st > offset) {
				$('.back-to-top').animate({opacity: 1}, duration);
			} else {
				$('.back-to-top').animate({opacity: 0}, duration);
			}

			if (st - cs > 100) {
				$('.back-to-top').addClass('abs');
			} else {
				$('.back-to-top').removeClass('abs');
			}
		});

		$('.back-to-top').click(function(event) {
			event.preventDefault();
			$.scrollTo({ endY: 0, duration: duration});
			return false;
		})
	});
	</script>
	<div id="co" class="ow">
	<div id="content" class="site-content iw">
