<?
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );
header( "Expires: Mon, 26 July 1997 05:00:00 GMT" );

 $req = $_REQUEST['req'];
 $Skarga_lub_Wniosek = $_REQUEST['Skarga_lub_Wniosek'];
 $id = $_REQUEST['id'];
?>

<? include( "init.php" ); ?>
<? include( "nazwaMiesiaca.inc.php" ); ?>
<? include_once("miesiacRzymskimi.inc.php"); ?>

<!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> -->
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<meta name="author" content="">
<meta name="reply-to" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<LINK rel="stylesheet" href="../glowny.css" type="text/css">
<style type="text/css">
<!--
.unnamed1 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px}
a:hover {  color: #CC0000}
a:link {  text-decoration: none}
a:visited {  text-decoration: none} -->
</style>
</head>

<body  text="#000000" link="#000099" vlink="#000099" alink="#000099" leftmargin="3" topmargin="3" marginwidth="3" marginheight="3">
<table width="765" border="0" cellspacing="0" cellpadding="0" height="408">
  <tr> 
     <td  valign="top"> <!-- background="../images/designMain/page_tlo.jpg" -->
      <table width="531" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td> 
            <table width="100" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td  valign="top"><img src="../images/designMain/t1.jpg" width="251" height="89"></td>
                <td  background="top"><img src="../images/designMain/t2.jpg" width="509" height="89"></td>
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
                      <td  background="../images/designMain/m1.jpg" height="39">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td  background="../images/designMain/m2.jpg" height="268" valign="top">
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
                      <td background="../images/designMain/m3.jpg" height="106">&nbsp;</td>
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

<?
//<!--   -----------------  Tresc strony ---------------------------- -->
?>

<?
if($req == "zapisz") {
  if( $Skarga_lub_Wniosek != "" ) {
  //Zapisz do tabeli ksiazka_rada w bazie

	// wybieramy z bazy ostatni wpis zeby sprawdzic, czy dodawany wpis nie jest juz w bazie
	$nrOstatniegoWpisu = @mysql_fetch_array(@mysql_query("select max(nr_wpisu) from ksiazka_rada"));
	$ostatniWpis = @mysql_fetch_array(@mysql_query("select id, skarga_lub_wniosek, od_IP from ksiazka_rada
		where nr_wpisu=".$nrOstatniegoWpisu[0]));

	if (($ostatniWpis['id'] == $id)
		&& ($ostatniWpis['skarga_lub_wniosek'] == $Skarga_lub_Wniosek)
		&& ($ostatniWpis['od_IP'] == $_SERVER["REMOTE_ADDR"])) {
		// nic nie robimy, bo ten wpis juz jest w bazie
	} else {
  	$data = date( "Y-m-d H:i:s" );
  	$inserted = @mysql_query( "INSERT INTO ksiazka_rada(data,id,skarga_lub_wniosek,od_IP)
                              VALUES ( '$data' , '$id' , '$Skarga_lub_Wniosek' , '".$_SERVER["REMOTE_ADDR"]."' ) ");

  	//sprawdzamy czy nie wystąpiły błędy
  	if( !$inserted ) {
    	echo "<P><B>BŁĄD! Twój wpis nie został dodany do bazy!</B><BR>\n" , @mysql_error() , "<BR>\n<BR>";
		} else {
			$ip = $SERVER["REMOTE_ADDR"];
			mail("perk@op.pl", "wpis do ksiazka_rada_zgora", "data: $data\nod ip; $ip \nid: $id\ntresc: $Skarga_lub_Wniosek\n");
	 	}	
  	}
	}
}//if($req=='zapisz') 
?>

<?
    // zarzadzanie ksiazka (ponizej) - wylaczone (bo niepotrzebne w log-u)
    //echo "<div align='right'><b>[<a href='ksiazka_zarzadzanie.php'>zarządzanie Książką</a>]</b></div>\n";
    //echo "<br>\n";

if( ( !isset($rok) )||( !isset($miesiac) ) ) {

  //Wyswietl ostatnie $limit_na stronie wpisow z tabeli ksiazka_rada bazy duktbaza
  $limit_na_stronie = 20;

  // wybierz ostatnie kilka wpisow
  // posegregowanych malejaco wg numeru wpisu do tabeli $wpisyTab
  $wpisyTab = @mysql_query( "SELECT * FROM ksiazka_rada
		WHERE wyswietlany='tak'
		ORDER BY nr_wpisu DESC
		LIMIT $limit_na_stronie" );
  $iloscWpisowTab = @mysql_fetch_array( @mysql_query( "SELECT count(*) from ksiazka_rada where wyswietlany = 'tak'" ) );

  // Link do ocenzurowanej ksiazki
  //echo "<div style=\"text-align: right;\"><a href='ksiazkacnz.php'>[ wersja &quot;light&quot; - bez wpisów Naitmera i Mężatki ;) ]</a></div><br>";

  // Wypisz ilosc wpisów do ksiazki
  echo "<DIV ALIGN='right'><B><I><FONT COLOR='red'>$iloscWpisowTab[0]</FONT> wpisów w książce</I></B></div>\n";

  // Wypisz wszystkie wpisy z tabeli $wpisyTab
  echo "<CENTER><B>Ostatnie $limit_na_stronie wpisów:<BR><A HREF='ksiazka_rada.php#formularz'>[wpisz się]</A></B></CENTER><BR>\n";

  for( $i = 0; $i < $limit_na_stronie; ++$i ) {
    if( $wpis = @mysql_fetch_array($wpisyTab) ) {
      //dodaj <BR>-ki do stringu wpis[skarga_lub_wniosek]
      $Skarga_Lub_Wniosek = implode( "<BR>\n" , explode("\n",$wpis['skarga_lub_wniosek']) );
	
			$znacznikWap = ($wpis['typ_wpisu'] == 'wap' ? " <i><b>~wap~</b></i> " : "");
      //wypisz kolejny wpis
      echo "<div class=\"wpis\">$znacznikWap<B>[" , $wpis['data'] , "] " , $wpis['id'] , "</B><BR>\n$Skarga_Lub_Wniosek</div><br><br>\n";
      }//if
    }//for

  } //if( (!isset($rok)) || (!isset($miesiac)) ) 

else {

  //Wyswietl na stronie wpisy z roku i miesiaca danych zmiennymi $rok i $miesiac

  //ustaw zmienna $pocz_miesiaca
  if (strlen($miesiac) == 1)
    $miesiac = implode("", array("0", $miesiac));
  $pocz_miesiaca = implode( "" , array( "$rok" , "$miesiac" , "01" ) );

  //ustaw zmienna $pocz_nast_miesiaca
  if ($miesiac != 12) {
    $nast_rok = $rok;
    if ($miesiac > 8)
      $nast_miesiac = $miesiac + 1;
    else
      $nast_miesiac = implode("", array("0", $miesiac + 1));   
    $pocz_nast_miesiaca = implode("" ,array("$nast_rok", "$nast_miesiac", "01"));
  }
  else {
    $nast_rok = $rok + 1;
    $nast_miesiac = "01";
    $pocz_nast_miesiaca = implode("" ,array("$nast_rok" ,"$nast_miesiac" ,"01"));
  }

  // wybierz z tabeli ksiazka_rada wszystkie wpisy o dacie miedzy 
  // $pocz_miesiaca a $pocz_nast_miesiaca
  $wpisyTab = @mysql_query( "SELECT * FROM ksiazka_rada
                              WHERE wyswietlany = 'tak'
							  AND data >= $pocz_miesiaca
                              AND data < $pocz_nast_miesiaca
                              ORDER BY nr_wpisu DESC" ); 

  while( $wpis = @mysql_fetch_array($wpisyTab) ) {
    $Skarga_Lub_Wniosek = implode( "<BR>\n" , explode("\n",$wpis[skarga_lub_wniosek]) );
    
		$znacznikWap = ($wpis['typ_wpisu'] == 'wap' ? " <i><b>~wap~</b></i> " : "");
    echo "<P ALIGN='JUSTIFY'>$znacznikWap<B>[" , $wpis[data] , "] " , $wpis[id] , "</B><BR>\n $Skarga_Lub_Wniosek<BR></P>\n";
  }//while

} //else if
?>
<br><br><br>
<B>Wszystkie wpisy miesiącami:</B><BR>
<?
/*$rok = date( "Y" );
$miesiac = date( "n" );

$lista = "";
while( $rok >= 2005 ) {  
  $lista = " <A HREF='ksiazka_rada.php?rok=$rok&amp;miesiac=$miesiac'>" . nazwaMiesiaca($miesiac) . "</A> " . $lista;
  if( $miesiac == 5 ) {
	  echo "<br>\n<b>$rok:</b> $lista";
		$lista = "";
    $miesiac = 12;
		--$rok;
	}
  else
    --$miesiac;
}//while
*/?>


<A NAME="formularz"></A>
<CENTER><B><A HREF='ksiazka_rada.php#gora'>[do góry]</A>&nbsp;Formularz wpisu do Książki</B></CENTER><BR>

<FORM ACTION="ksiazka_rada.php" METHOD="POST" NAME="form_Ksiazka_Skarg_i_Wnioskow">
<INPUT TYPE=HIDDEN NAME='req' VALUE='zapisz'>
<B>Podpisz się (czyli xywa, imię, imię dziadka, co chcesz):</B><BR>
<INPUT TYPE="TEXT" NAME="id" SIZE="70"><BR>
<B>A teraz pisz, co Ci na sercu leży:</B><BR>
<TEXTAREA NAME="Skarga_lub_Wniosek" COLS="70" ROWS="5" WRAP="VIRTUAL"></TEXTAREA><BR>
<INPUT TYPE="SUBMIT" VALUE="Wysyłam!">
<INPUT TYPE="RESET" VALUE="Kasuj (tchórzu!)"><BR>
</FORM>
<BR>

<div align="right">
<SMALL><I>wypocił<br>
<?= getWebmaster(); ?>, <? echo date( "d.m.Y" , filemtime($page) ) ?></I></SMALL>
</div>

<?
//<!-- -----------------------   Koniec tresci ------------------------ -->  
?>                      
                        
                          
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
<?
//<!-- <td  valign="bottom" background="../images/designMain/page_tlo.jpg"> -->
//<!-- <img src="../images/designMain/bott.jpg" width="760" height="12"></td> -->
?>
  </tr>
</table>
<p></p>
</body>
</html>
