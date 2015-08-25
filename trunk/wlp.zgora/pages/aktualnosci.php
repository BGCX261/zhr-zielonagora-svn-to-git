<?
$zapytanie = "SELECT * from `aktualnosci` where wyswietlany='tak' order by data desc";

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
?>
<div style="text-align: right; font-size: small; font-style: italic;">
    wypoci³<br />
    <?= getWebmaster(); ?>, <? echo date("d.m.Y", filemtime($page)) ?>
</div>