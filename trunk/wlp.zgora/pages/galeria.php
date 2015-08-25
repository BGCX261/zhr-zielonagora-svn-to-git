<div id="container"> </div>

<?
/*
<script type="text/javascript">
        window.location = "http://picasaweb.google.pl/wlp.zgora";
</script>

//if ($_SERVER["REMOTE_ADDR"] != "193.25.4.10") {
//	include("listaGaleriiZdjec.inc.php");
//} else {
	include_once("GaleriaZdjec/PrezentacjaGaleriiZdjec.class.php");

	$prezentacjaGaleriiZdjec = new PrezentacjaGaleriiZdjec();

	echo "<style>\n" . file_get_contents("css/galeriaZdjec.css") . "</style>\n";

	if ($prezentacjaGaleriiZdjec->czyTrybListaGalerii) {
?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<!--<img src= "img/przechowalnia_zdjec/flaga2.jpg" width="350" align=left>-->
		</td>
		<td valign="top">
<? $prezentacjaGaleriiZdjec->wyswietl(); ?>
		</td>
	</tr>
</table>
<?
	} else if ($prezentacjaGaleriiZdjec->czyTrybWyswietlenieGalerii) {
		// echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/galeriaZdjec.css\" />\n";

		$powrotHref = "index.php?page=galeria";
		echo "<a href=\"$powrotHref\">Powrót</a>\n";

		$prezentacjaGaleriiZdjec->wyswietl();

		echo "<a href=\"$powrotHref\">Powrót</a>\n";
	} else {
		$prezentacjaGaleriiZdjec->wyswietl();
	}
//}
 */
?>
