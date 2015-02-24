<?php
/**
 * @package aperiodico2015
 */
// template de entradas de a una
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="thumb">
		<?php the_post_thumbnail('full'); ?>
		<hr>
		<span>Donde conseguir el numero?</span>
		<hr>
		<span>Compartir FB TW</span>
	</div>

	<div class="right">
		<header class="entry-header">
			<?php apsi_titulo(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<div class="menu secciones">
				<a class="boton seleccionado">SUMARIO</a>
				<a class="boton">EDITORIAL</a>
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
		<footer class="entry-footer">
			<?php aperiodico2015_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
	<br style="clear: left;" />
</article><!-- #post-## -->

<article class="todas">
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
