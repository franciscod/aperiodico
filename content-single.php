<?php
/**
 * @package aperiodico2015
 */
// template de entradas de a una
$editorial = get_the_content();
$editorial = !empty($editorial);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="vcontainer">

		<div class="invis but660">
			<header class="entry-header">
				<?php apsi_titulo_sinlink(); ?>
			</header><!-- .entry-header -->
		</div>

		<div class="left">
			<div class="thumb">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<?php apsi_pie_post(); ?>
		</div>

		<div class="right">
			<header class="entry-header invis660">
				<?php apsi_titulo_sinlink(); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<div class="menu secciones">
					<a class="boton seleccionado<?php if (!$editorial) { ?> unico<?php }?>">SUMARIO</a>
					<?php if ($editorial) { ?>
					<a class="boton">EDITORIAL</a>
					<?php } ?>
					<br style="clear: both;" />
				</div>
				<div class="seccion sumario">
					<?php apsi_destacados(); ?>
					<?php apsi_sumario(); ?>
				</div>
				<?php if ($editorial) { ?>
				<div class="seccion editorial oculto">
					<?php the_content(); ?>
				</div>
				<?php } ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'aperiodico2015' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
		<br style="clear: both;" />
	</div>

</article><!-- #post-## -->

<article class="todas">
	<hr>
	<div class="flecha">Todas las ediciones</div>
	<div class="eds">
		<?php
		$ediciones = get_posts(array(
			'posts_per_page' => -1, // all of them
			'category_name' => 'edicion',
		));

		foreach ($ediciones as $edicion) {

			list($o, $num, $tit) = apsi_split_titulo($edicion->post_title);
			$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
			$thumb_url = $thumb_data[0];
			$link = get_permalink($edicion->ID);

			$actualcs = (($edicion->ID == get_the_ID(false)) ? " actual" : "");

			echo "
			<div class='edicion$actualcs'>
				<a href='$link'>
				<img src='$thumb_url'>
				<div class='num'>N°$num</div>
				<div>$tit</div>
				</a>
			</div>";
		}
		?>
		<br style="clear: both;" />
	</div>
</article>
<script>
	var fLeftTop, fLeftHeight, sfImageEndingTop, iHeaderHeight;

	var repositionImage = function (event) {

		var mWindowScroll = $(window).scrollTop() - $('#ho').height() + iHeaderHeight;


		var sb = mWindowScroll > fLeftTop - 10;
		var eb = mWindowScroll > fImageEndingTop - 20;

		if (sb) { $('.vcontainer').addClass('into');} else { $('.vcontainer').removeClass('into'); }
		if (eb) { $('.vcontainer').addClass('past');} else { $('.vcontainer').removeClass('past'); }

	};

	var recalcHeights = function () {
		var fPostBot = $('.right').height() + $('.right').offset().top;
		fImageEndingTop = fPostBot - fLeftHeight;
	};

	var sectionButtonCallback = function (tb, ob, ts, os) {
		return function () {
			if (tb.hasClass('seleccionado')) {
				return;
			}

			window.location = "<?php echo esc_url(get_permalink());?>#" + tb.text().toLowerCase();
			tb.addClass('seleccionado');
			ob.removeClass('seleccionado');
			os.fadeOut(400, function () {
				os.addClass('oculto');
				ts.removeClass('oculto');
				ts.fadeIn(400, recalcHeights);
			})
		};
	};

	$(function () {
		iHeaderHeight = $('#ho').height();
		fLeftTop = $('.left').offset().top;
		fLeftHeight = $('.left').height();

		recalcHeights();
		$(window).scroll(repositionImage);
		$(window).resize(repositionImage);

		var b1 = $('.entry-content .boton').first();
		var b2 = $('.entry-content .boton').last();
		var s1 = $('.entry-content .seccion').first();
		var s2 = $('.entry-content .seccion').last();

		b1.click(sectionButtonCallback(b1, b2, s1, s2));
		b2.click(sectionButtonCallback(b2, b1, s2, s1));

		if (window.location.hash === "#editorial") {
			b2.click();
		}
	});
</script>
