<?php
/**
 * @package aperiodico2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="vcontainer">
		<div class="right">
			<header class="entry-header">
				<?php apsi_titulo(); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">

				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php if ( !in_category('libro') ) : ?>
				<?php apsi_escriben(); ?>
				<?php apsi_destacados(); ?>
				<?php apsi_botones(); ?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'aperiodico2015' ),
						'after'  => '</div>',
					) );
				?>
				<?php else:
					the_content( "Seguir leyendo");

				endif; ?>
			</div><!-- .entry-content -->

		</div>
		<div class="left">
			<a href="<?php echo esc_url( get_permalink()); ?>">
				<div class="thumb">
					<?php the_post_thumbnail('full'); ?>
				</div>
			</a>
		</div>
		<br style="clear: both;" />
		<?php if ( !in_category('libro') ) : ?>
		<div class="offset-pie"><?php apsi_pie_post(); ?></div>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
