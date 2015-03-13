<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package aperiodico2015
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="ed-ant">
			<div class="flecha">Ediciones Anteriores</div>
			<span>
				Para conseguir ediciones anteriores puede contactarse con la redacción del Aperiódico Psicoanalítico:
			</span>
			<div class="contact-item"><b>MAIL: </b>etendlar@fibertel.com.ar</div>
			<div class="contact-item"><b>TELÉFONO: </b>(+54 11) 4771 1625</div>

			<small>Envíos a todo el mundo previo depósito bancario. Precio de las ediciones actualizado al valor de la última edición más costos de envío</small>
		</div>

		<div class="contacto">
			<div class="flecha">Contacto</div>
			<div class="contact-item"><b>MAIL: </b>etendlar@fibertel.com.ar</div>
			<div class="contact-item"><b>TELÉFONO: </b>(+54 11) 4771 1625</div>

			<div class="entrecasa">
				<i></i><span>diseño</span>
			</div>
		</div>

		<?php apsi_social(); ?>

		<a href="#" class="back-to-top"></a>
	</footer><!-- #colophon -->
	<script>

	$(function() {
		var offset = 250;
		var duration = 300;
		$(window).scroll(function() {
			var st = $(this).scrollTop();
			var cs = $('#colophon').offset().top - $(window).height();
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

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
