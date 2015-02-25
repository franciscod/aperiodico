<?php
/**
 * @package aperiodico2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="vcontainer">
		<div class="left">
			<div class="thumb">
				<?php the_post_thumbnail('full'); ?>
			</div>
		</div>
		<div class="right">
			<header class="entry-header">
				<?php apsi_titulo(); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">

				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php apsi_escriben(); ?>
				<?php apsi_destacados(); ?>
				<?php apsi_botones(); ?>

				<?php
					/* translators: %s: Name of current post */
					/*
					the_content( sprintf(
						__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'aperiodico2015' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
					*/
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'aperiodico2015' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

		</div>
		<br style="clear: left;" />
		<div class="offset-pie"><?php apsi_pie_post(); ?></div>
	</div>
</article><!-- #post-## -->
