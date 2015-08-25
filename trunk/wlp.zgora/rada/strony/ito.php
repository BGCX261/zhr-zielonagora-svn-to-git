<?
//charset iso-8859-2

//include("db.inc.php");
//db_connect();

$id = $_REQUEST['id'];
$ogloszenie = $_REQUEST['ogloszenie'];
$od_IP = $_REQUEST['od_IP'];
$nr_rodzica = $_REQUEST['nr_rodzica'];
	if($nr_rodzica=="") $nr_rodzica = 0;

?>


<!--   -----------------  Tresc strony ---------------------------- -->

<br>
<br>
<table width="100%">
	<tr align="center">
		<td>
<?
	$ilosc_ogloszen = 10;
	//tworzymy zapytanie do bazy
	$zapytanie = "SELECT id, ogloszenie, nr_wpisu, od_IP, nr_rodzica, odpowiedzi, data FROM ito WHERE wyswietlany='tak' and nr_rodzica='$nr_rodzica' ORDER BY nr_wpisu DESC LIMIT $ilosc_ogloszen";
	$itoTab = mysql_query($zapytanie) or die("<br />Nie moge wyslac zapytania do bazy.<br />");

	//jezeli chcemy zobaczyc, na co odpowiadamy, to
	$czy_odp = false;
	if ($nr_rodzica!=0) {
		$zapytanie_rodzic = "SELECT id, ogloszenie, nr_wpisu, od_IP, nr_rodzica, odpowiedzi, data FROM ito WHERE wyswietlany='tak' and nr_wpisu='$nr_rodzica' ORDER BY nr_wpisu DESC LIMIT 1";
		$odpowiedz_rodzic = mysql_query($zapytanie_rodzic);
		$czy_odp = true;
		
		echo "Ostatnie $ilosc_ogloszen odpowiedzi do:<br />\n";
	} else 
		echo "Ostatnie $ilosc_ogloszen og³oszeñ.<br /><br />\n";
?>
		</td>
	</tr>
	
	<tr align="left">
		<td>
<?
	if ($czy_odp == true) {
	//wypisujemy rodzica
	$temp = @mysql_fetch_assoc($odpowiedz_rodzic);
	echo "<br /><b>[". $temp['data'].
			"] ".$temp['id']." </b><i>(".$temp['odpowiedzi'].")</i></span>".
			"<br />\"" .$temp['ogloszenie'].
			"\"<br />\n".
		"==============================================================<br /><br />\n";

	}


	$czy_byly_odpowiedzi = false;
	// wypisujemy odpowiedzi (lub ogloszenia, jezeli rodzic == 0
	while ( $ito = @mysql_fetch_assoc($itoTab) ) {
		echo 	//"[" .$ito['data'].
			"<span style='background-color: lightgreen; font-weight: bold;'>[". $ito['data'].
			"] ".$ito['id']."</span>";
		
		if($ito['odpowiedzi'] != 0) echo "<i>(".$ito['odpowiedzi'].")</i>";

		echo	"<a href='?page=ito&nr_rodzica=".$ito['nr_wpisu'].
			"'> zobacz</a>".
			"<br />" .$ito['ogloszenie'].
			"<br /><br />\n";
		$czy_byly_odpowiedzi = true;
	}	

	if ($czy_byly_odpowiedzi == false) echo "<span style='background-color: lightblue;'>Brak odpowiedzi do tego og³oszenia.</span><br />\n";
	
	echo "<br />";
	if ($nr_rodzica==0)
		echo '<a href="?page=itododaj">Dodaj nowe ogloszenie</a><br /><br />';
	else
		echo '<a href="?page=itododaj&nr_rodzica='.$nr_rodzica.'">Odpowiedz</a><br /><br />'."\n".
		     '<a href="?page=ito">Powrót do strony g³ównej ITO</a>';
?>
	
		</td>
	</tr>
</table>



<? 
	for($i=0 ; $i<15 ; $i++) echo "<br>";
?>
<div align="right">
<SMALL><I>wypoci³<br>
<?= getWebmaster(); ?>, <? echo date( "d.m.Y" , filemtime($page) ) ?></I></SMALL>
</div>

</td>
</tr>
</table>                        

