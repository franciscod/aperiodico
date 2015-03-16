<?php

function apsi_social() { ?>
	<div class="social">
		<a target="_blank" class="fb" href="https://www.facebook.com/Aperiodico.inconscient">Facebook<span class="abbr">/Aperiódico.Psicoanalítico</span></a>
		<a target="_blank" class="tw">Twitter<span class="abbr">/Aperiódico.Psicoanalítico</span></a>
	</div>
<?php }

function apsi_pie_post() { ?>
	<footer class="entry-footer">
		<div class="bottom_aligner"></div>
		<div class="line social share">Compartir
			<a target="_blank" class="fb" href="#">Facebook</a>
			<a target="_blank" class="tw" href="#">Twitter</a>
		</div>
		<div class="line donde-conseguir">¿Dónde conseguir el número?</div>
	</footer>
	<script>
	$(".social.share .fb").on("click",function(){
		var fbpopup = window.open(
			'https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>',
			'pop',
			'width=600, height=400, scrollbars=no');
		return false;
	});

	$(".social.share .tw").on("click",function(){
		var fbpopup = window.open(
			'https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>',
			'pop',
			'width=600, height=400, scrollbars=no');
			return false;
		});

	</script>
<?php }

?>
