<?
include("init.php");

$id = $_REQUEST['id'];
$ogloszenie = $_REQUEST['ogloszenie'];
$od_IP = $_REQUEST['od_IP'];
$nr_rodzica = $_REQUEST['nr_rodzica'];
$req = $_REQUEST['req'];

if ($req == "zapisz"){
//echo $req;
}
?>


<html>
<head>
<title>www.zgora.harc.pl > Internetowa Tablica Ogłoszeń</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<meta name="author" content="">
<meta name="reply-to" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<style type="text/css">
<!-- <LINK rel="stylesheet" href="glowny.css" type="text/css">-->
<!--
.unnamed1 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px}
a:hover {  color: #CC0000}
a:link {  text-decoration: none}
a:visited {  text-decoration: none}-->
</style>
</head>

<body  text="#000000" link="#000099" vlink="#000099" alink="#000099" leftmargin="3" topmargin="3" marginwidth="3" marginheight="3">
<table width="765" border="0" cellspacing="0" cellpadding="0" height="408">
  <tr> 
    <td  valign="top" background="http://www.zhr.pl/~wlp.zgora/images/designMain/page_tlo.jpg"> 
      <table width="531" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td> 
            <table width="100" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td  valign="top"><img src="http://www.zhr.pl/~wlp.zgora/images/designMain/t1.jpg" width="251" height="89"></td>
                <td  background="top"><img src="http://www.zhr.pl/~wlp.zgora/images/designMain/t2.jpg" width="509" height="89"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td> 
            <table width="760" border="0" cellspacing="0" cellpadding="0" height="295">
              <tr valign="top"> 
                <td> 
                  <table width="206" border="0" cellspacing="0" cellpadding="0" height="287">
                    <tr> 
                      <td  background="http://www.zhr.pl/~wlp.zgora/images/designMain/m1.jpg" height="39">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td  background="http://www.zhr.pl/~wlp.zgora/images/designMain/m2.jpg" height="268" valign="top">
                        <table width="185" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="37">&nbsp;</td>
                            <td width="148">
                              <table width="143" border="0" cellspacing="0" cellpadding="0" class="unnamed1">
                                <tr>
                                  <td>
                                    <p>&nbsp;</p>
                                    </td>
                                </tr>
				<? include ("menulewe.inc.php"); ?>	
                              </table>
                            </td>
                          </tr>
                        </table>      
                      </td>
                    </tr>
                    <tr> 
                      <td background="http://www.zhr.pl/~wlp.zgora/images/designMain/m3.jpg" height="106">&nbsp;</td>
                    </tr>
                    
                <? include ("menulewebaner.inc.php"); ?>	
				
                  </table>
                </td>
                <td width="550"> 
                  <table  width="520" border="0" cellspacing="0" cellpadding="0" class="unnamed1">
                    <tr> 
                      <td> 
                        <!-- <p>&nbsp;</p> -->
                        <p><b></b>
                        <table  width="100%" align="center" cellspacing="2" cellpadding="0" border="0">

<td  width="85%" class="wnetrze">

<!--   -----------------  Tresc strony ---------------------------- -->

<br>
<br>
<table width="100%">
	<tr align="justify">
		<td>
<?

	echo "id= $id<br>ogloszenie= $ogloszenie<br><br>";

	$ilosc_ogloszen = 20;
	$itoTab = mysql_query("SELECT id, ogloszenie, nr_wpisu, od_IP, nr_rodzica FROM ito WHERE wyswietlany='tak'
													ORDER BY nr_wpisu DESC LIMIT $ilosc_ogloszen");

	// ... i wypisz je...
	while ( $ito = @mysql_fetch_array($itoTab) ) {
		echo "<b>id=</b>", $ito['id']," <b>ogloszenie=</b>", $ito['ogloszenie']," <b>nr_wpisu=</b> ",$ito['nr_wpisu']," <b>nr_rodzica=</b> ",$ito['nr_rodzica'],"<br>";
	}	

?>
			<br>
			<br>
			<br>
			<form method="POST" action="ito.php" name="form_ITO">
			<input type="hidden" name="req" value="zapisz">
			<b>Podaj swoją ksywę (lub pseudonim, jak wolisz)</b><br>
			<input type="text" name="id" id="id" size="60"><br>
			<b>Twoje ogłoszenie:</b><br>
			<textarea name="ogloszenie" id="ogloszenie" cols="60" rows="5" wrap="virtual"></textarea><br>
			<input type="submit" value="Ogłaszam">
			<input type="reset" value="Rezygnuję">
			</form>
		</td>
	</tr>
</table>

<? 
//	for($i=0 ; $i<15 ; $i++) echo "<br>";
?>
<div align="right">
<SMALL><I>wypocił<br>
<?= getWebmaster(); ?>, <? echo date( "d.m.Y" , filemtime($page) ) ?></I></SMALL>
</div>

</td>
</tr>
</table>                        

<!-- -----------------------   Koniec tresci ------------------------ -->  
                      
                        
                          
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td  valign="bottom" background="http://www.zhr.pl/~wlp.zgora/images/designMain/page_tlo.jpg"><img src="http://www.zhr.pl/~wlp.zgora/images/designMain/bott.jpg" width="760" height="12"></td>
  </tr>
</table>
<p></p>
</body>
</html>
