<?
//include("db.inc.php");
//db_connect();

$id = $_REQUEST['id'];
$akcja = $_REQUEST['akcja'];
$ogloszenie = $_REQUEST['ogloszenie'];
$nr_rodzica = $_REQUEST['nr_rodzica'];
	if($nr_rodzica=="") $nr_rodzica = 0;

?>


<!--   -----------------  Tresc strony ---------------------------- -->

<br>
<br>
<?// echo "Twoje IP: ".$_SERVER["REMOTE_ADDR"]." wewn:".$_SERVER["HTTP_X_FORWARDED_FOR"]; ?>
<br>
<table width="100%">
	<tr align="left">
		<td>
<?

//	echo "id: $id, ogloszenie: $ogloszenie, od_IP: ".$_SERVER["REMOTE_ADDR"].", nr_rodzica: $nr_rodzica<br />";

if($akcja == "dodaj") {
	$data = date( "Y-m-d H:i:s" );
	$zapytanie = "INSERT INTO ito(id, ogloszenie, od_IP, nr_rodzica, data) VALUES ('$id','$ogloszenie','".$_SERVER["REMOTE_ADDR"]."','$nr_rodzica','$data')"; //".$_SERVER["REMOTE_ADDR"]."
	
	$pytaj = mysql_query($zapytanie) or die("<br />Nie moge wyslac zapytania do bazy.<br />");
	//$odpowiedzi = mysql_query("SELECT odpowiedzi FROM ito WHERE nr_wpisu=$nr_rodzica LIMIT=1");
	$sql = "SELECT `odpowiedzi` FROM `ito` WHERE `nr_wpisu` = $nr_rodzica LIMIT 0, 30 ";
//	nie dziala jeszcze to :/
	$odpowiedzi = mysql_query($sql);

	$odp = @mysql_fetch_assoc($odpowiedzi);
	$temp = $odp['odpowiedzi'];

//		echo "odpowiedzi przed: ".$temp."<br />";
	$temp += 1;
//		echo "odpowiedzi po: $temp<br />";
	$sql = "UPDATE `ito` SET `odpowiedzi`=$temp WHERE `nr_wpisu`=$nr_rodzica";
	@mysql_query($sql);


	echo "<b>Brawo</b>, doda³a¶/e¶ nowy wpis!<br /><br />".
	     "<b>[$data] $id<br />Tekst:</b> $ogloszenie<br /><b>Twoje IP:</b> ".$_SERVER["REMOTE_ADDR"]." ".$_SERVER["HTTP_X_FORWARDED_FOR"]."<br /><br />";
		
} else {
?>
		</td>
	</tr>
	<tr align="center">
		<td>

<form action=index.php?page=itododaj method=post>
<input name="akcja" value="dodaj" type="hidden">
<input name="nr_rodzica" value="<? echo $nr_rodzica;?>" type="hidden">
Identyfikator:<br />
<input name="id" type="text" size="40"><br />
<br />
Ogloszenie:<br />
<textarea name="ogloszenie" cols="50" rows="5"></textarea><br />
<input value="oglaszaj" type="submit"><br />
<input value="kasuj" type="reset"><br />
</form>

<br />

<? } ?>

<a href="?page=ito">Powrot do ITO</a><br />
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

