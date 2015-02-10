<?php
/**
 * @package aperiodico2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php apsi_titulo(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php apsi_sumario(); ?>
		<div class="editorial">
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
</article><!-- #post-## -->
