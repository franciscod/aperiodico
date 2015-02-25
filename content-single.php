<?php
/**
 * @package aperiodico2015
 */
// template de entradas de a una
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="vcontainer">
		<div class="left">
			<div class="thumb">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<?php apsi_pie_post(); ?>
		</div>

		<div class="right">
			<header class="entry-header">
				<?php apsi_titulo(); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<div class="menu secciones">
					<a class="boton seleccionado">SUMARIO</a>
					<a class="boton">EDITORIAL</a>
					<br style="clear: left;" />
				</div>
				<div class="sumario">
					<?php apsi_destacados(); ?>
					<?php apsi_sumario(); ?>
				</div>
				<div class="editorial oculto">
					<?php the_content(); ?>
				</div>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'aperiodico2015' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
		<br style="clear: left;" />
	</div>

</article><!-- #post-## -->

<article class="todas">
	<hr>
	<div class="flecha">Todas las ediciones</div>
	<div class="eds">
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
		<br style="clear: left;" />
	</div>
</article>
<script>
	var fLeftTop, fImageEndingTop;

	var reposition_image = function (event) {

		var mWindowScroll = $(window).scrollTop();

		var sb = mWindowScroll > fLeftTop;
		var eb = mWindowScroll > fImageEndingTop;

		if (sb) { $('.vcontainer').addClass('into');} else { $('.vcontainer').removeClass('into'); }
		if (eb) { $('.vcontainer').addClass('past');} else { $('.vcontainer').removeClass('past'); }

	};


	$(function () {
		fLeftTop = $('.left').offset().top;

		fPostBot = $('.right').height() + $('.right').offset().top;
		fLeftHeight = $('.left').height();
		fImageEndingTop = fPostBot - fLeftHeight;

		$(window).scroll(reposition_image);
		$(window).resize(reposition_image);
	});
</script>
