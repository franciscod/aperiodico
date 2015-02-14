<?php
add_theme_support( 'post-thumbnails' );

add_filter('show_admin_bar', '__return_false');

function split2lines($string) {
	return $lines = preg_split( '/\r\n\r\n|\r\r|\n\n/', $string );
}

function splitlines($string) {
	return $lines = preg_split( '/\r\n|\r|\n/', $string );
}

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
				</a><br/>
				<a href="%s" rel="bookmark">
					<span class="titulo">%s</span>
				</a>
			</h1>', $link, $numero, $link, $titulo );
}

function apsi_escriben() {
	$custom = get_post_custom();
	$ces = $custom['escriben'];
	$escriben = array();
	$escriben = splitlines($ces[0]);
	echo '<div class="flecha escriben">Escriben:</div>';
	$primero = true;

	foreach ($escriben as $autor) {

		$aut = trim($autor);
		if (!$aut) continue;

		echo (!$primero ? ' • ' : '').'<span class="autor">'.$aut.'</span>';

		if ($primero) {
			$primero = false;
		}
	}
}

function apsi_destacados() {
	$custom = get_post_custom();
	$cds = $custom['destacados'];
	if (!trim($cds[0])) return;
	$destacados = array();
	$destacados = split2lines($cds[0]);
	echo '<div class="destacados">';
	echo '<hr>';
	foreach ($destacados as $d) {
		$l = splitlines($d);
		if (!$l[0]) continue;
		?>
		<div class="destacado">
			<div class="titulo"><?php echo $l[0];?></div>
			<div class="autor"><?php echo $l[1];?></div>
		</div>
		<hr>
		<?php
	}

	echo '</div>';
}

function apsi_sumario() {
	$custom = get_post_custom();
	$csm = $custom['sumario'];
	$sumario = array();
	$sumario = split2lines($csm[0]);
	echo '<div class="sumario">';
	foreach ($sumario as $s) {
		$l = splitlines($s);
		if (!$l[0]) continue;
		?>
		<div class="art">
			<div class="titulo flecha"><?php echo $l[0];?></div>
			<div class="autor"><?php echo $l[1];?></div>
		</div>
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
