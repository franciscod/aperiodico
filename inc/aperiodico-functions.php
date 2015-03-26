<?php
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(240, 366);

remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;
add_filter( 'pre_comment_content', 'esc_html' );
add_filter('show_admin_bar', '__return_false');

function split2lines($string) {
	return $lines = preg_split( '/\r\n\r\n|\r\r|\n\n/', $string );
}

function splitlines($string) {
	return $lines = preg_split( '/\r\n|\r|\n/', $string );
}

function apsi_split_titulo($title) {
	$re = "/(\d+): (.*)/";
	$matches = array();
	preg_match($re, $title, $matches);
	return $matches;
}
function apsi_titulo() {
	list($orig, $numero, $titulo) = apsi_split_titulo(the_title_attribute(array('echo' => false)));

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

	$editorial = get_the_content();
	$editorial = !empty($editorial);
?>
<div class="botones">
<a href="<?php echo esc_url(get_permalink());?>#sumario"><div class="boton">SUMARIO</div></a>
<?php if ($editorial) { ?>
<a href="<?php echo esc_url(get_permalink());?>#editorial"><div class="boton">EDITORIAL</div></a>
<?php } ?>
</div>
<?php return ;
}


add_action( 'wp_ajax_apsi_buscar', 'apsi_buscar' );
add_action( 'wp_ajax_nopriv_apsi_buscar', 'apsi_buscar' );

function apsi_buscar() {
	global $wpdb;

	$q = strtoupper(remove_accents($_POST['q']));
	$r = array();
	$c = 0;
	$ediciones = get_posts(array(
		'posts_per_page' => -1, // all of them
		'category' => 'ediciones',
	));

	foreach ($ediciones as $edicion) {
		$postmatch = array();
		$innermatch = array();
		$m = 0;

		list($o, $num, $tit) = apsi_split_titulo($edicion->post_title);
		$link = get_permalink($edicion->ID);
		$thumb_data = wp_get_attachment_image_src(get_post_thumbnail_id($edicion->ID));
		$thumb_url = $thumb_data[0];

		$s = strtoupper(remove_accents("$num $tit"));
		$pos = strpos($s, $q);

		if ($pos === false) {
		} else {
			$c++;
			$m = 1;
		}

		$custom = get_post_custom($edicion->ID);

		$cds = $custom['destacados'];
		$destacados = array();
		if (trim($cds[0])){
			$destacados = split2lines($cds[0]);
		};

		$csm = $custom['sumario'];
		$sumario = array();
		if (trim($csm[0])) {
			$sumario = split2lines($csm[0]);
		};


		//$res = $destacados + $sumario;
		$res = $sumario; // los destacados ya estan en sumario

		foreach ($res as $d) {
			$l = splitlines($d);
			if (!$l[0]) continue;
			$s = strtoupper(remove_accents("$l[0] $l[1]"));
			$pos = strpos($s, $q);
			if ($pos === false) {
			} else {
				$innermatch[] = "<div class='titulo'>$l[0]</div><div class='autor'>$l[1]</div>";
				$c++;
				$m = 1;
			}
		}
		if ($m) {
			$postmatch['img'] = $thumb_url;
			$postmatch['num'] = $num;
			$postmatch['tit'] = $tit;
			$postmatch['in'] = $innermatch;
			$postmatch['link'] = $link;
			$r[] = $postmatch;
		}
	}

	if ($c == 0) { ?>
		<div>No se encontraron resultados para su búsqueda.</div>
	<?php } else { ?>
		<div>Encontramos <?php echo $c; ?> resultados para su búsqueda:</div>
		<div class="ediciones">
		<?php foreach ($r as $match) {?>
		<div class="edicion">
			<a href="<?php echo $match['link']; ?>">
				<img src="<?php echo $match['img']; ?>">
				<div>
						<span class="numero">N°<?php echo $match['num']; ?></span><br/>
						<span class="titulo"><?php echo $match['tit']; ?></span>
					<div class="sumarios">
					<?php foreach ($match['in'] as $i) {?>
						<div class="resultado">
							<?php echo $i; ?>
						</div>
					<?php } ?>
					</div>
				</div>
			</a>
		</div>
		<?php
		}?>
		</div>
		<?php
	}

	wp_die(); // this is required to terminate immediately and return a proper response
}
?>
