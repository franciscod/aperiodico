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
	</div>
	<div id="fo" class="ow">
	<div class="sombra">
	<footer id="colophon" class="site-footer iw" role="contentinfo">
		<div class="ed-ant">
			<div class="flecha">Ediciones Anteriores</div>
			<span>
				Para conseguir ediciones anteriores puede contactarse con la redacción del Aperiódico<span class="abbr"> Psicoanalítico</span>:
			</span>
			<div class="contact-item"><b>MAIL: </b>etendlar@fibertel.com.ar</div>
			<div class="contact-item"><b>TELÉFONO: </b>(+54 11) 4771 1625</div>

		<small>Envíos en formato digital a cualquier parte del mundo previo depósito bancario.
			Precio<span class="abbr-foot"> de cada edición</span> actualizado al valor de la última edición más costos administrativos.</small>
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

	</footer><!-- #colophon -->
	</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
<div id="backdrop">
	<div class="center">
		<a class="close">X</a>
		<div class="content"></div>
	</div>
</div>

<div class="hidden">
	<div class="buscador">
		<span class="lupa"></span>
		<input class="query" placeholder="Escriba su búsqueda">
		<div class="resultados-busqueda"></div>
	</div>
</div>

<script>
$(function () {
	var openBackdropWith = function openBackdropWith(el) {
		el.clone().appendTo("#backdrop .content");
		$('#backdrop').css('opacity', '0.97');
		$('#backdrop').fadeIn();
		$('body').addClass('showing-backdrop');
	};

	$('.donde-conseguir').click(function() {
		openBackdropWith($('#colophon .ed-ant'));
	});

	$('#backdrop .close').click(function(e) {
		$('#backdrop').fadeOut(400, function() {
			$('#backdrop .content').empty();
			$('body').removeClass('showing-backdrop');
			$('body').removeClass('backdrop-search');
		});
		e.preventDefault();
	});

	$('#buscar').click(function(e) {
		$('body').addClass('backdrop-search');
		openBackdropWith($('.buscador'));
		$('.buscador .query').focus();

		$('.buscador .query').on('keypress', function(e) {
			if (e.which == 13) {
				buscar($(this).val());
			}
		});
		e.preventDefault();
	});
	var buscar = function buscar(q) {

		$("#backdrop .resultados-busqueda").fadeOut(200, function(){
			$("#backdrop .resultados-busqueda").empty();
		});

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action': 'apsi_buscar',
				'q': q
			},
			success: function (response) {

				$("#backdrop .resultados-busqueda").append(response);

				$('#backdrop .resultados-busqueda .sumarios > div > div, .resultados-busqueda span.titulo').each(function(i, e) {
					var orig = $(e).html();
					var term = q;

					term = term.replace('a', '[aá]')
					term = term.replace('e', '[eé]')
					term = term.replace('i', '[ií]')
					term = term.replace('o', '[oó]')
					term = term.replace('u', '[uú]')

					var pattern = new RegExp("("+term+")", "gi");

					marked = orig.replace(pattern, "<mark>$1</mark>");
					$(e).html(marked);
				})

				$("#backdrop .resultados-busqueda").fadeIn();
			}
		});
	};

});
</script>
</body>
</html>
