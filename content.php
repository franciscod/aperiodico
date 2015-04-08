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
//					apsi_botones();

				endif; ?>
			</div><!-- .entry-content -->

		</div>
		<div class="left">
			<a href="<?php echo esc_url( get_permalink()); ?>">
				<div class="thumb">
					<?php if ( !in_category('libro') ) : ?>
					<?php the_post_thumbnail('full'); ?>
					<?php else:
						$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
						$thumb_url = $thumb_data[0];
						?>
						<div class="imgcontainer"><div class="img" style="background-image: url('<?php echo $thumb_url; ?>')"></div></div><?php
					endif; ?>
				</div>
			</a>
		</div>
		<br style="clear: both;" />
		<div class="offset-pie">
			<?php if ( !in_category('libro') ) :
				apsi_pie_post();
			endif; 
			?>
			</div>
	</div>
</article><!-- #post-## -->
