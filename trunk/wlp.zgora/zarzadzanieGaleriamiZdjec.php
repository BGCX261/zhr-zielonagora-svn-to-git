<?
ini_set("display_errors", 1);
set_include_path("./phplib");

include_once("GaleriaZdjec/GaleriaZdjec.class.php");
include_once("GaleriaZdjec/ZarzadcaGaleriiZdjec.class.php");
include_once("GaleriaZdjec/UstawieniaGaleriiZdjec.class.php");
include_once("PEAR/Net_URL.class.php");

$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();

$url = new Net_URL($_SERVER['REQUEST_URI'], false);
?>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2" />
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="edycja.css" />
	<title>Zarz�dzanie galeriami zdj��</title>
</head>
<body>
<h1>Zarz�dzanie galeriami zdj��</h1>
<?
if (isset($_REQUEST['dodaj'])) {
	$url->removeQueryString("dodaj");

	echo '<form action="' . $url->getURL() . '" method="post">' . "\n";
	echo '<input type="hidden" name="zapiszNowa" value="1" />' . "\n";
	echo '<table>' . "\n";
	echo '<tr><td>Katalog:</td><td><input name="katalog" size="100" value="images/galerie/" /></td></tr>' . "\n";
	echo '<tr><td>Tytu�:</td><td><input name="tytulGalerii" size="50" value="" /></td></tr>' . "\n";
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecOpis) {
		echo '<tr><td>Opis:</td><td><input name="opisGalerii" size="100" value="" /></td></tr>' . "\n";
	}
	echo '<tr><td>Data:</td><td><input name="data" size="10" value="" /></td></tr>' . "\n";
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecNowa) {
		echo '<tr><td>Nowa:</td><td><input name="nowa" type="checkbox" /></td></tr>' . "\n";
	}
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecPrawieNowa) {
		echo '<tr><td>Prawie nowa:</td><td><input name="prawieNowa" type="checkbox" /></td></tr>' . "\n";
	}
	echo '<tr><td colspan="2"><input type="submit" value="Zapisz" /> <input type="button" value="Anuluj" onclick="document.location=\'' . $url->getURL() . '\'" /></td></tr>' . "\n";
	echo '</table>' . "\n";
	echo '</form>' . "\n";
} else if (isset($_REQUEST['zapiszNowa'])) {
	$galeriaZdjec = new GaleriaZdjec();

	// TODO: Walidacja p�l obiektu $galeriaZdjec.
	$galeriaZdjec->katalog = $_REQUEST['katalog'];
	$galeriaZdjec->tytulGalerii = $_REQUEST['tytulGalerii'];
	$galeriaZdjec->opisGalerii = $_REQUEST['opisGalerii'];
	$galeriaZdjec->data = $_REQUEST['data'];
	$galeriaZdjec->nowa = (isset($_REQUEST['nowa']) ? 1 : 0);
	$galeriaZdjec->prawieNowa = (isset($_REQUEST['prawieNowa']) ? 1 : 0);

	$sukces = ZarzadcaGaleriiZdjec::dodajGalerie($galeriaZdjec);

	if ($sukces) {
		echo 'OK, zmiany zosta�y zapisane. <a href="' . $_SERVER['REQUEST_URI'] . '">Dalej</a>';
	} else {
		echo 'Niestety, nie uda�o si� zapisa� zmian. <a href="' . $_SERVER['REQUEST_URI'] . '">Dalej</a>';
	}
} else if (isset($_REQUEST['edytuj'])) {
	$katalog = $_REQUEST['edytuj'];

	$url->removeQueryString("edytuj");

	$galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($katalog);

	echo '<form action="' . $url->getURL() . '" method="post">' . "\n";
	echo '<input type="hidden" name="zapisz" value="' . $galeriaZdjec->katalog . '" />' . "\n";
	echo '<table>' . "\n";
	echo '<tr><td>Katalog:</td><td><input name="katalog" size="100" value="' . $galeriaZdjec->katalog . '" /></td></tr>' . "\n";
	echo '<tr><td>Tytu�:</td><td><input name="tytulGalerii" size="50" value="' . $galeriaZdjec->tytulGalerii . '" /></td></tr>' . "\n";
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecOpis) {
		echo '<tr><td>Opis:</td><td><input name="opisGalerii" size="100" value="' . $galeriaZdjec->opisGalerii . '" /></td></tr>' . "\n";
	}
	echo '<tr><td>Data:</td><td><input name="data" size="10" value="' . $galeriaZdjec->data . '" /></td></tr>' . "\n";
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecNowa) {
		echo '<tr><td>Nowa:</td><td><input name="nowa" type="checkbox" ' . ($galeriaZdjec->nowa ? "checked " : "") . ' /></td></tr>' . "\n";
	}
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecPrawieNowa) {
		echo '<tr><td>Prawie nowa:</td><td><input name="prawieNowa" type="checkbox" ' . ($galeriaZdjec->prawieNowa ? "checked " : "") . ' /></td></tr>' . "\n";
	}
	echo '<tr><td colspan="2"><input type="submit" value="Zapisz" /> <input type="reset" value="Cofnij zmiany" /> <input type="button" value="Anuluj" onclick="document.location=\'' . $url->getURL() . '\'" /></td></tr>' . "\n";
	echo '</table>' . "\n";
	echo '</form>' . "\n";
} else if (isset($_REQUEST['zapisz'])) {
	$katalogEdytowanejGalerii = $_REQUEST['zapisz'];

	$galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($katalogEdytowanejGalerii);

	// TODO: Walidacja p�l obiektu $galeriaZdjec.
	$galeriaZdjec->katalog = $_REQUEST['katalog'];
	$galeriaZdjec->tytulGalerii = $_REQUEST['tytulGalerii'];
	$galeriaZdjec->opisGalerii = $_REQUEST['opisGalerii'];
	$galeriaZdjec->data = $_REQUEST['data'];
	$galeriaZdjec->nowa = (isset($_REQUEST['nowa']) ? 1 : 0);
	$galeriaZdjec->prawieNowa = (isset($_REQUEST['prawieNowa']) ? 1 : 0);

	$sukces = ZarzadcaGaleriiZdjec::aktualizujGalerie($katalogEdytowanejGalerii, $galeriaZdjec);

	if ($sukces) {
		echo 'OK, zmiany zosta�y zapisane. <a href="' . $_SERVER['REQUEST_URI'] . '">Dalej</a>';
	} else {
		echo 'Niestety, nie uda�o si� zapisa� zmian. <a href="' . $_SERVER['REQUEST_URI'] . '">Dalej</a>';
	}
} else if (isset($_REQUEST['usun'])) {
	$katalog = $_REQUEST['usun'];

	$url->removeQueryString("usun");

	$sukces = ZarzadcaGaleriiZdjec::usunGalerie($katalog);

	if ($sukces) {
		echo 'OK, galeria zosta�a usuni�ta. <a href="' . $url->getURL() . '">Dalej</a>';
	} else {
		echo 'Niestety, nie uda�o si� usun�� galerii. <a href="' . $url->getURL() . '">Dalej</a>';
	}
} else {
	$galerie = ZarzadcaGaleriiZdjec::pobierzWszystkieGalerie();

	echo "<a href=\"../index.php?page=galeria\">Powr�t</a>";

	echo "<table border=\"1\">\n";

	echo "<tr>";
	echo "<th>Katalog</th>";
	echo "<th>Data</th>";
	echo "<th>Tytu�</th>";
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecOpis) {
		echo "<th>Opis</th>";
	}
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecNowa) {
		echo "<th>Nowa</th>";
	}
	if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecPrawieNowa) {
		echo "<th>Prawie nowa</th>";
	}
	echo "<th>Akcja</th>";
	echo "<tr>\n";

	$edytujUrl = new Net_URL($_SERVER['REQUEST_URI'], false);
	$usunUrl = new Net_URL($_SERVER['REQUEST_URI'], false);
	$dodajUrl = new Net_URL($_SERVER['REQUEST_URI'], false);

	$dodajUrl->addQueryString("dodaj", "1");
	$dodajLink = $dodajUrl->getURL();

	foreach ($galerie as $galeriaZdjec) {
		$edytujUrl->addQueryString("edytuj", $galeriaZdjec->katalog);
		$edytujLink = $edytujUrl->getURL();

		$usunUrl->addQueryString("usun", $galeriaZdjec->katalog);
		$usunLink = $usunUrl->getURL();

		echo "<tr>";
		echo "<td>" . $galeriaZdjec->katalog . "</td>";
		echo "<td>" . $galeriaZdjec->data . "</td>";
		echo "<td>" . $galeriaZdjec->tytulGalerii . "</td>";
		if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecOpis) {
			echo "<td>" . $galeriaZdjec->opisGalerii . "</td>";
		}
		if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecNowa) {
			echo "<td><input disabled type='checkbox'" . ($galeriaZdjec->nowa ? " checked" : "") . "></td>";
		}
		if ($ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecPrawieNowa) {
			echo "<td><input disabled type='checkbox'" . ($galeriaZdjec->prawieNowa ? " checked" : "") . "></td>";
		}
		echo "<td><a href='$edytujLink'>Edytuj</a> <a href='$usunLink' onclick=\"javascript: return confirm('Czy na pewno chcesz usun�� galeri� \\'" . addslashes($galeriaZdjec->tytulGalerii) . "\\'?')\">Usu�</a></td>";
		echo "<tr>\n";
	}

	echo "</table>\n";
	echo "<a href=\"$dodajLink\" accesskey=\"n\">Dodaj <u><b><i>n</i></b></u>ow� galeri�</a>";
}
?>
</body>
</html>
