<?php

function apsi_social() { ?>
	<div class="social">
		<a target="_blank" class="fb" href="https://www.facebook.com/Aperiodico.inconscient">Facebook<span class="abbr">/Aperiodico.inconscient</span></a>
		<a target="_blank" class="tw" href="https://twitter.com/aperiodicopsi">Twitter<span class="abbr">/aperiodicopsi</span></a>
	</div>
<?php }

function apsi_pie_post() { ?>
	<footer class="entry-footer">
		<div class="bottom_aligner"></div>
		<div class="line social share">Compartir
			<a target="_blank" class="fb entry<?php echo get_the_ID(false); ?>" href="#">F<span class="abbr66">ace</span>b<span class="abbr66">ook</span></a>
			<a target="_blank" class="tw entry<?php echo get_the_ID(false); ?>" href="#">Tw<span class="abbr66">itter</span></a>
		</div>
		<div class="line donde-conseguir">¿Dónde conseguir el número?</div>

		<script>
		$(function () {
			$('.social.share .fb.entry<?php echo get_the_ID(false); ?>').on("click",function(){
				var fbpopup = window.open(
					'https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>',
					'pop',
					'width=600, height=400, scrollbars=no');
				return false;
			});

			$('.social.share .tw.entry<?php echo get_the_ID(false); ?>').on("click",function(){
				var twpopup = window.open(
					'https://twitter.com/intent/tweet?via=aperiodicopsi&text=Aperiodico Psicoanalítico - <?php
					list($orig, $num, $tit) = apsi_split_titulo(the_title_attribute(array('echo' => false)));

					if (!in_category("libro")) {
						$num = "N°".$num;
					}
					
					echo "$num: $tit -&url=". esc_url(get_permalink());

					?>',
					'pop',
					'width=600, height=400, scrollbars=no');
					return false;
				});

		});

		</script>
	</footer>
<?php }

?>
