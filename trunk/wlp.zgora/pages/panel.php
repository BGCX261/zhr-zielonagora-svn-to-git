<? /* Dodawanie danych do tabeli AKTUALNOSCI */

// **************************************************
//pobieramy adres IP
$ip = $_SERVER["REMOTE_ADDR"];
$ip_wewn = $_SERVER["HTTP_X_FORWARDED_FOR"];

if($ip_wewn != "")
	$ip = $ip." ".$ip_wewn;

//jak nazywa sie ten plik
$nazwa_pliku = "panel";
//$nazwa_pliku = $_SERVER['PHP_SELF'];


//przechwytujemy dane z formularzy
$data = $_REQUEST['data'];
$podpis = addslashes($_REQUEST['podpis']);
$tresc = addslashes($_REQUEST['tresc']);
$tytul = addslashes($_REQUEST['tytul']);
$akcja = $_REQUEST['akcja'];
$haslo = $_REQUEST['haslo'];

$pass = "ddc2672d8e914196d01ee6475b4f3824c2ac70aa";

// **************************************************

$formularz_aktualnosci = <<<KONIEC
<form name="aktualnosc" method="post" action="./?page=$nazwa_pliku">
<table style="border-collapse: collapse;" align="center" border="1" bordercolor="#cdcdff" cellpadding="5" cellspacing="5">
	<tr><td>Data (w formacie rrrr.mm.dd): </td><td><input type="text" size="15" name="data" /> (tak, tam s± kropki)</td></tr>
	<tr><td>Tytu³ (mo¿liwie krótki): </td><td><input type="text" size="15" name="tytul" /></td></tr>
	<tr><td>Tre¶æ:</td><td><textarea COLS="40" ROWS="4" WRAP="VIRTUAL" name="tresc"></textarea></td></tr>
	<tr><td>Podpis: </td><td><input type="text" size="15" name="podpis" /></td></tr>
	<tr><td>Has³o: </td><td><input type="password" size="15" name="haslo" /></td></tr>
</table><br/>
<input type="hidden" name="akcja" value="zapisz_aktualnosc" />
<input type="hidden" name="ip" value="$ip" />
<input type="submit" value="Dodaj" />
<INPUT TYPE="RESET" VALUE="Wyczy¶æ" />
</form>
KONIEC;

$formularz_kalendarium = <<<KONIEC
<form name="kalendarium" method="post" action="./?page=$nazwa_pliku">
<table style="border-collapse: collapse;" align="center" border="1" bordercolor="#cdcdff" cellpadding="5" cellspacing="5">
	<tr><td>Data (w formacie rrrr.mm.dd): </td><td><input type="text" size="15" name="data" /> (tak, tam s± kropki)</td></tr>
	<tr><td>Tytu³ (mo¿liwie krótki): </td><td><input type="text" size="15" name="tytul" /></td></tr>
	<tr><td>Tre¶æ:</td><td><textarea COLS="40" ROWS="4" WRAP="VIRTUAL" name="tresc"></textarea></td></tr>
	<tr><td>Podpis: </td><td><input type="text" size="15" name="podpis" /></td></tr>
	<tr><td>Has³o: </td><td><input type="password" size="15" name="haslo" /></td></tr>
</table><br/>
<input type="hidden" name="akcja" value="zapisz_kalendarium" />
<input type="hidden" name="ip" value="$ip" />
<input type="submit" value="Dodaj" />
<INPUT TYPE="RESET" VALUE="Wyczy¶æ" />
</form>
KONIEC;

// **************************************************

if (($akcja == "zapisz_aktualnosc") || (($akcja == "zapisz_kalendarium"))) {

	//sprawdzamy, czy podane haslo jest w porzadku
	if (sha1($haslo) != $pass)
		switch($akcja) {
			case "zapisz_aktualnosc":
					die("<br/>\nNic z tego. Nie ma has³a, nie ma wpisywania aktualno¶ci.<br/>\n");
					break;
			case "zapisz_kalendarium":
					die("<br/>\nNic z tego. Nie ma has³a, nie ma wpisywania do kalendarium.<br/>\n");
					break;
		}


	switch($akcja) {
		case "zapisz_aktualnosc": $tabela = "aktualnosci"; break;
		case "zapisz_kalendarium": $tabela = "kalendarium"; break;
	}

	//jezeli jest data, podpis, tresc oraz tutyl, to zapisujemy
	if (($data != "") && ($podpis != "") && ($tresc != "") && ($tytul != "")) {
		$zapytanie = "INSERT INTO `$tabela` (data,autor,tresc_ogloszenia,tytul_ogloszenia,od_IP)
					VALUES ('$data','$podpis','$tresc','$tytul','$ip')";

		//proba wstawienia danych do bazy
		$inserted = @mysql_query($zapytanie);

		//jezeli sie nie udalo, to piszemy
		if ( ! $inserted )
			echo "\n<br/><b>B³±d wstawiania danych do tabeli: '$tabela' !!</b><br/>\n";
		//a jezeli sie udalo, to tez piszemy
		else
			echo "<br/>\nWpis do <b>$tabela</b> dodany poprawnie. <a href='./?page=temp'>Powrót</a><br/>\n";

	} else {
		echo "Nic nie zapisa³em. Nie wpisano wszystkich danych.";
	}

} else { //if($akcja)
	echo "<h2>Dodaj dane do aktualno¶ci:</h2>";
	echo $formularz_aktualnosci;
	echo "<br/>\n<br/>\n<h2>Dodaj dane do kalendarium:</h2>";
	echo $formularz_kalendarium;
}

?>



<div align="right">
<SMALL><I>made by<br/>
<?= getWebmaster(); ?>, <? echo date( "d.m.Y" , filemtime($page) ) ?></I></SMALL>
</div>
