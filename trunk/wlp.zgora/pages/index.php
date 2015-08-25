<div style="font-size: small; text-align: center;">
    <span style="font-weight: bold;">Zielonogórski Obwód ZHR</span><br/>
    ul. Lisowskiego 3<br/>
    65-072 Zielona Góra<br/>
    kom: 602 712 734<br/>
    email: <a href="mailto:zielonagora%40zhr.pl">zielonagora@zhr.pl</a>
</div>
<!-- Okienko o Chlipaku -->
<!--
<div style="background-color: lightgreen; border: solid 1px red;">
<div style="color: red; font-weight: bolder; text-align: center;"><blink>
R&nbsp;A&nbsp;J&nbsp;D&nbsp;&nbsp;&nbsp;O&nbsp;B&nbsp;W&nbsp;O&nbsp;D&nbsp;U&nbsp;!&nbsp;!&nbsp;!</blink>
</div>
<table>
<tr><td>Termin:<td>22-25 maja
<tr><td valign="top">Zg³oszenia:<td>do <b>25 kwietnia</b><br>
W sprawie zg³oszeñ, wp³at oraz zgód rodziców na wyjazd nale¿y zg³aszaæ siê do dh. Enii, tel. 887 362 570, e-mail <a href="mailto:enia30@o2.pl">enia30@o2.pl</a>
<tr><td>Cena:<td>35 z³
<tr><td>Trasa:<td>Cibórz - £±kie - Gronów - £agów
</table>
</div>
-->
<!-- Okienko o Chlipaku -->

<?
// ####################################################################################################
// wypisujemy ostatni± wpisan± do bazy aktualno¶æ
echo "<br/>\n<br/>\n<div style='font-weight:bold;'><a href='./?page=aktualnosci'>Aktualno¶ci:</a></div>";

$zapytanie = "SELECT * from `aktualnosci` where wyswietlany='tak' order by nr_wpisu desc limit 5";
$odpowiedz = mysql_query($zapytanie) or die("Brak danych w bazie!");

while ($wiersz = mysql_fetch_assoc($odpowiedz)) {

    $data = $wiersz['data'];
    $tytul = stripslashes($wiersz['tytul_ogloszenia']);
    $tresc = stripslashes($wiersz['tresc_ogloszenia']);
    $autor = stripslashes($wiersz['autor']);

    // zamieñ \n na <br/>
    $tresc = implode("<br/>\n", explode("\n", $tresc));
        
    $aktualnosc = <<<KONIEC
	<br />
	<b>$data: <i>$tytul</i></b><br/>
	<div style="text-align: justify;">$tresc</div>
	<div style="text-align: right; font-style: italic;">og³osi³(a): $autor</div><br/>
	<hr />
KONIEC;

    echo $aktualnosc;
}

// ####################################################################################################
// wypisujemy ostatnie wpisane do bazy wydarzenie (z kalendarium)
//  echo "<br/>\n<br/>\n<div style='font-weight:bold;'><a href='./?page=kalendarium'>Ostatnio wydarzy³o siê:</a></div>";
//
//  $zapytanie = "SELECT * from `kalendarium` where wyswietlany='tak' order by nr_wpisu desc limit 1";
//  $odpowiedz = mysql_query($zapytanie) or die("Brak danych w bazie!");
//
//  while ( $wiersz = mysql_fetch_assoc($odpowiedz) ) {
//
//	$data = $wiersz['data'];
//	$tytul = stripslashes($wiersz['tytul_ogloszenia']);
//	$tresc = stripslashes($wiersz['tresc_ogloszenia']);
//	//$autor = stripslashes($wiersz['autor']);
//
//$kalendarium = <<<KONIEC
//	<div align="left">$data: <i>$tytul</i></div>
//	<div align="justify">$tresc</div>
//KONIEC;
//
//	echo $kalendarium;
//
//}
?>
<div style="text-align: right; font-size: small; font-style: italic;">
    wyklepa³<br />
    <?= getWebmaster(); ?>, <? echo date("d.m.Y", filemtime($page)) ?>
</div>