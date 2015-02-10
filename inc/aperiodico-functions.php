<?php
add_theme_support( 'post-thumbnails' );

function apsi_titulo() {
	$re = "/(\d+): (.*)/";
	$title = the_title_attribute(array('echo' => false));
	$matches = array();
	preg_match($re, $title, $matches);
	list($orig, $numero, $titulo) = $matches;
	$link = esc_url( get_permalink());
	printf('<h1 class="entry-title">
				<a href="%s" rel="bookmark">
					<span class="numero">N°%s</span>
				</a>
				<a href="%s" rel="bookmark">
					<span class="titulo">%s</span>
				</a>
			</h1>', $link, $numero, $link, $titulo );
}

function apsi_escriben() {
	$custom = get_post_custom();
	$ces = $custom['escriben'];
	$escriben = array();
	$escriben = explode("\n", $ces[0]);
	echo '<div class="flecha">Escriben:</div>';
	$primero = true;

	foreach ($escriben as $autor) {

		$aut = trim($autor);
		if (!$aut) continue;

		echo (!$primero ? ' - ' : '').'<span class="autor">'.$aut.'</span>';

		if ($primero) {
			$primero = false;
		}
	}
}

function apsi_destacados() {
	$custom = get_post_custom();
	$cds = $custom['destacados'];
	$destacados = array();
	$destacados = explode("\r\n\r\n", $cds[0]);
	echo '<div class="destacados">';
	echo '<hr>';
	foreach ($destacados as $d) {
		$d = explode("\r\n", $d);
		if (!$d[0]) continue;
		?>
		<div class="destacado">
			<div class="titulo"><?php echo $d[0];?></div>
			<div class="autor"><?php echo $d[1];?></div>
		</div>
		<hr>
		<?php
	}

	echo '</div>';
}

function apsi_botones() {
?>
<div class="boton">SUMARIO</div>
<div class="boton">EDITORIAL</div>
<?php
return ;
}

?>
