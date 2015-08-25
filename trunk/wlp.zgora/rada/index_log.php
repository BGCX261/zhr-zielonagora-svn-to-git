<? include( "init.php" ); ?>
<? include( "nazwaMiesiaca.inc.php" ); ?>
<? include( "ulozDate.inc.php" ); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META HTTP-EQUIV="Content-Language" CONTENT="pl">
<META NAME="Keywords" CONTENT="skauting skaut harcerstwo harcerze ZHR zhr 9 ZDH 'DUKT-Zawisza' Zielona Góra Zielona Gora DUKT-Zawisza dukt-zawisza DUKT Dukt dukt dukciarze ZAWISZA Zawisza zawisza THH Tajny Hufiec Harcerzy">
<META NAME="Description" CONTENT="9 Zielonogórska Drużyna Harcerzy 'DUKT-Zawisza' im. THH w Gdyni - fajna drużynka z fajnymi chłopakami.">
<TITLE>ZHR 9 ZDH "Dukt" im. THH w Gdyni &gt; Log</TITLE>
<LINK rel="stylesheet" href="glowny.css" type="text/css">
<STYLE type="text/css">
<!--
div.special {
	background: #ff9966;
	border: 2px solid #c00;
	color: #366;
	font-family: Arial, Verdana, Halvetica, sans-serif;
	font-weight: bold;
	line-height: 12px;
	padding: 3px;
	text-align: center;
}
DIV.specialleft {
	background: #ff9966;
	border: 2px solid #c00;
	color: #366;
	font-family: Arial, Verdana, Halvetica, sans-serif;
	font-weight: bold;
	line-height: 12px;
	padding: 3px;
	text-align: center;
	position: absolute;
	top: 12%;
	left: 17%;
}
DIV.specialright {
	background: #FF9966;
	border: 2px solid #c00;
	color: #366;
	font-family: Arial, Verdana, Halvetica, sans-serif;
	font-weight: bold;
	line-height: 20px;
	padding: 3px;
	text-align: center;
	position: absolute;
	left: 79%;
	top: 12%;
}
A.special {
	font-family: Verdana, Halvetica, sans-serif; 
	font-weight: bolder; 
	font-size: 13pt; 
	text-decoration: none;
	color: #FF0000;
}
A.special:hover {
	color: #FF6666;
}
-->
</STYLE>
</HEAD>

<BODY TEXT="#000000" BGCOLOR="#d4ffd4" LINK="green" ALINK="red" VLINK="gray">
<!--DIV CLASS="specialleft"-->
<!-- <A HREF="http://www.wigry45.prv.pl" CLASS="special" TARGET="_blank" >Zobacz!<BR>wigry45.prv.pl<BR>Zobacz!</A> -->
<!--a href="javascript:void(0)" class="special"><b>wap.dukt.prv.pl</b></a><br>gdziekolwiek jesteś<br>- wpisujesz się do Książki!-->
<!--/DIV-->

<!--DIV CLASS="specialright"-->
<!-- <A HREF="http://www.wigry45.prv.pl" CLASS="special" TARGET="_blank" >Zobacz!<BR>wigry45.prv.pl<BR>Zobacz!</A> -->
<!-- <a href="javascript:void(0)" class="special"><b>wap.dukt.prv.pl</b></a><br>gdziekolwiek jesteś<br>- wpisujesz się do Książki! -->
<!--/DIV-->

<center>
<table width="98%" align="center" cellspacing="2" cellpadding="0" border="0">
<tr valign="top">

<td width="15%" align="center" class="menuLewe">
<? include("menulewe.inc.php"); ?>
</td>

<td width="85%" align="center" class="wnetrze">

<!-- Naglowek -->
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor='#005000'>
<tr>
<td width="100%" align="center" class="naglowek">
<B>9 ZDH "Dukt" im. THH w Gdyni &nbsp;&gt;&nbsp; Log</B>
</td>
</tr>
</table>
<!--/Naglowek -->

<hr width="100%" size="1" noshade>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<!--<tr>
<td align="center" style="width: 170px; text-align: center;">
<div align="center"><div class="special" style="width: 150px;">Aha no właśnie czas minął i co z nagrodami?...</div></div>
</td>-->
<td>
<Center>
<H5>
<font face="Courier">
  <FONT COLOR="#FF0000">Związek Harcerstwa Rzeczypospolitej</FONT><BR>
  <FONT COLOR="#000000">
  9 Zielonogórska Drużyna Harcerzy "Dukt" im. Tajnego Hufca Harcerzy w Gdyni
  </FONT>
</font>
</H5>
</Center>
</td>
</tr>
</table>

<HR ALIGN="CENTER" SIZE="1" WIDTH="100%" NOSHADE> 
<?
// Sprawdz czy dziala MySQL
$worksMySQL = @db_connect();
if(!$worksMySQL) {
  echo "<p style=\"color: red; background: #000;\"><b>Kurcze!<br> W tej chwili nie działa niestety serwer MySQL, a to oznacza, że niedostępne są serwisy Książka, FAQ, Wydarzenia i Ludzie... :((( Bardzo mi przykro, mam nadzieję, że to chwilowe! Dopóki jednak to nie działa, zapraszam do obejrzenia pozostałej części serwisu, ze <a href=\"zdjecia.php\">Zdjęciami</a> na czele.</b></p>\n";
}

?>
<!-- <table width="100%" border="0" cellpadding="1" cellspacing="3">
<tr>
<td width="50%" class="jasneTlo">
<b><a href="conowego.php">Co nowego?</a></b>
</td>
<td width="50%" class="jasneTlo">
<b><a href="plany.php">A w planach...</a></b>
</td>
</tr>

<tr>
<td width="50%" valign="top" align="justify" class="bezTla">

<?
// Wypisz trzy ostatnie nowosci
  $today = date( "Ymd" );
  $nowosciTab = @mysql_query( "SELECT * FROM conowego
                               WHERE data <= $today
                               ORDER BY data DESC, nr_wpisu DESC
                               LIMIT 3" );

  for( $i = 0; $i < 3; ++$i ) {
    if( $nowosc = @mysql_fetch_array( $nowosciTab ) )
      {
      $nowosc['data'] = ulozDate( $nowosc['data'] );
      echo "<B>" , $nowosc['data'] , "</B> " , $nowosc['tytul'] , " <I>[" , $nowosc['id'] , "]</I><BR>";
      } //if
    }
?>

</td>
<TD ALIGN="JUSTIFY" VALIGN="TOP" WIDTH="50%" class="bezTla">

<?
// Wypisz trzy najnowsze plany
  $today = date( "Ymd" );
  $nowosciTab = @mysql_query( "SELECT * FROM plany
                               WHERE data >= $today
                               ORDER BY data, nr_wpisu
                               LIMIT 3" );

  $wszystkie = ""; //zamiast wypisywac po jednym zbiera je, odwracajac kolejnosc
  for( $i=0; $i<3; ++$i ) {
    if( $nowosc = @mysql_fetch_array( $nowosciTab ) )
      {
      $nowosc['data'] = ulozDate( $nowosc['data'] );
      $wszystkie = "<B>${nowosc['data']}</B> ${nowosc['tytul']} <I>[${nowosc['id']}]</I><BR>\n$wszystkie";
      } //if
    } //for
  echo $wszystkie;
?>

</td>
</tr>
</TABLE>-->
<BR>

<?
// Pokaz ostatni wpis z Ksiazki Skarg i Wnioskow.

  // Znajdz index ostatniego (najswiezszego) wpisu.
  $ksiazka_log_ost_nr = @mysql_fetch_array( @mysql_query( "SELECT max(nr_wpisu) as max from ksiazka_log where wyswietlany='tak'" ) );
  // Wczytaj ten wpis do zmiennej $ksiazka_log_ost_Tab.
  $ksiazka_log_ost_Tab = @mysql_fetch_array( @mysql_query( "SELECT * FROM ksiazka_log WHERE wyswietlany='tak' AND nr_wpisu=$ksiazka_log_ost_nr[max]" ) ); 
  // Obetnij dlugosc id do 5 znakow.
  if( strlen($ksiazka_log_ost_Tab[id]) > 10 )
    $ksiazka_log_ost_id = substr( strip_tags($ksiazka_log_ost_Tab[id]), 0, 5 ) . "(...)";
  else
    $ksiazka_log_ost_id = strip_tags($ksiazka_log_ost_Tab[id]);
  // Obetnij dlugosc wpisu do 20 znakow.
  if( strlen($ksiazka_log_ost_Tab[skarga_lub_wniosek]) > 25 )
    $ksiazka_log_ost_slubw = trim( substr( strip_tags($ksiazka_log_ost_Tab[skarga_lub_wniosek]), 0, 20 ) ) . "(...)";
  else
    $ksiazka_log_ost_slubw = strip_tags($ksiazka_log_ost_Tab[skarga_lub_wniosek]);
  //Ostatecznie formatuj dane.
  $ksiazka_log_ost = "<B>[". $ksiazka_log_ost_Tab[data]. "] ". $ksiazka_log_ost_id. "</B> ". $ksiazka_log_ost_slubw;
?>

<? 
// Pokaz ostatni wpis z FAQ-a

  //Znajdz index ostatniego (najswiezszego Qytania.
  $pyt_ost_nr = @mysql_fetch_array( @mysql_query( "SELECT max(nr_pyt) as max from pyt where wyswietlane='tak'" ) );
  // Wczytaj to Qytanie do zmiennej $pyt_ost_Tab.
  $pyt_ost_Tab = @mysql_fetch_array( @mysql_query( "SELECT * FROM pyt WHERE wyswietlane='tak' AND nr_pyt=$pyt_ost_nr[max]" ) );
  // Obetnij dlugosc pytania do 20 znakow.
  if( strlen($pyt_ost_Tab[tresc_pyt]) > 20 )
    $pyt_ost_tresc = trim( substr( strip_tags($pyt_ost_Tab[tresc_pyt]), 0, 20 ) ) . "(...)";
  else
    $pyt_ost_tresc = strip_tags($pyt_ost_Tab[tresc_pyt]);
  // Musimy jeszcze wyciac z 'kiedy' sama date, wyrzucajac czas.
  $pyt_ost_data = substr( $pyt_ost_Tab[kiedy], 0, strpos( $pyt_ost_Tab[kiedy], " " ) );
  // Ostatecznie formatujemy dane.
  $pyt_ost = "<B>[". $pyt_ost_data. "]</B> ". $pyt_ost_tresc;

  //Znajdz index ostatniej (najswiezszej) odpowiedzi.
  $odp_ost_nr = @mysql_fetch_array( @mysql_query( "SELECT max(nr_odp) as max from odp where wyswietlana='tak'" ) );
  // Wczytaj to Qytanie do zmiennej $odp_ost_Tab.
  $odp_ost_Tab = @mysql_fetch_array( @mysql_query( "SELECT * FROM odp WHERE wyswietlana='tak' AND nr_odp=$odp_ost_nr[max]" ) );
  // Obetnij dlugosc id do 5 znakow.
  if( strlen($odp_ost_Tab[id]) > 10 )
    $odp_ost_id = substr( strip_tags($odp_ost_Tab[id]), 0, 5 ) . "(...)";
  else
    $odp_ost_id = strip_tags($odp_ost_Tab[id]);
  // Obetnij dlugosc odpowiedzi do 20 znakow.
  if( strlen($odp_ost_Tab[tresc_odp]) > 25 )
    $odp_ost_tresc = trim( substr( strip_tags($odp_ost_Tab[tresc_odp]), 0, 20 ) ) . "(...)";
  else
    $odp_ost_tresc = strip_tags($odp_ost_Tab[tresc_odp]);
  // Musimy jeszcze wyciac z 'kiedy' czas, zostawiajac sama date.
  $odp_ost_data = substr( $odp_ost_Tab[kiedy], 0, strpos( $odp_ost_Tab[kiedy], " " ) );
  // Ostatecznie formatujemy dane.
  $odp_ost = "<B>[". $odp_ost_data. "] ". $odp_ost_id. "</B> ". $odp_ost_tresc;
 
// Pokaz ostatni komentarz do zdjecia
$zdjecia_ost_Tab = @mysql_fetch_array(@mysql_query("select * from zdjecia_ostatni_wpis"));
// Obetnij dlugosc podpisu do 5 znakow.
if( strlen($zdjecia_ost_Tab[id]) > 10 )
  $zdjecia_ost_podpis = substr(strip_tags($zdjecia_ost_Tab['podpis']), 0, 5) . "(...)";
else
  $zdjecia_ost_podpis = strip_tags($zdjecia_ost_Tab['podpis']);
// Obetnij dlugosc komentarza do 20 znakow.
if( strlen($zdjecia_ost_Tab['komentarz']) > 25 )
  $zdjecia_ost_komentarz = trim( substr( strip_tags($zdjecia_ost_Tab['komentarz']), 0, 20 ) ) . "(...)";
else
  $zdjecia_ost_komentarz = strip_tags($zdjecia_ost_Tab['komentarz']);
$zdjecia_ost = "<b>${zdjecia_ost_Tab['podtytulStrony']}</b><br>\n<b>[$zdjecia_ost_podpis]</b> $zdjecia_ost_komentarz";
?>

<TABLE WIDTH="100%" BORDER="0" CELLPADDING="1" CELLSPACING="3">

<tr>
<td width="50%" class="ciemneTlo">
<B>Teraz na stronie:</B>
</td>
<td width="50%" class="ciemneTlo">
<B>Ostatnio dodane:</B>
</td>
</tr>

<tr>

<td width="50%" align="justify" class="bezTla">
<!-- <A HREF="index.php"><B>Start</B></A> - tu jesteś<BR> -->
<A HREF="ksiazka_log.php"><B>Książka robocza</B></A> - plany, coś nie działa, wszystko działa...<BR>
<div style="text-align: left">
ostatni wpis:<br>
<i><? echo $ksiazka_log_ost; ?></i><br>
</div>
<!--<A HREF="faq.php"><B>FAQ</B></A> - masz pytanie? Zadaj je nam!<BR>
<div style="text-align: left">
ostatnie pytanie:<br>
<i><? //echo $pyt_ost; ?></i><br>
ostatnia odpowiedź:<br>
<i><? //echo $odp_ost; ?></i><br>
</div>-->
<!-- <A HREF="conowego.php"><B>Wydarzenia</B></A> - nowości z życia drużyny, plany na przyszłość i archiwum<BR>
<A HREF="ludzie.php"><B>Ludzie</B></A> - czyli tzw. skład osobowy<BR>
<A HREF="druzyna.php"><B>Drużyna</B></A> - coś o mundurach, historii i nie tylko<BR>
<A HREF="zdjecia.php"><B>Zdjęcia</B></A> - bardziej kolorowa część serwisu<BR>
<div style="text-align: left">
ostatni komentarz w: 
<i><? echo $zdjecia_ost; ?></i><br>
</div>
<A HREF="spiewnik.php"><B>Śpiewnik</B></A> - 223 piosenki harcerskie, półharcerskie i całkiem nieharcerskie<br> 
<A HREF="hufiec.php"><B>Zielonogórski Hufiec Harcerzy</B></A> - kto jest kim w zielonogórskim ZHR<BR>
<A HREF="linki.php"><B>Linki</B></A> do stron znanych i lubianych a może nieznanych ale lubianych przez tych co znanych!... czy jakoś tak...<BR>
</td> -->

<td width="50%" valign="top" class="bezTla">
<div align="justify"> 
<b>[20.03.2005 11:20:39]</b> Dodane przegladanie <a href="http://www.zhr.pl/~wlp.dukt/stat/index.php">satystyk serwisu</a> i ogolne udogodnienia;) oraz najwazniejsze - <a href="http://www.zhr.pl/~wlp.dukt/log/admin/panel.php">ladowanie zdjec</a> calkowicie automatyczne:]<br>
<!-- <b>[01.08.2004 1:20:39]</b> Żóóóółty..... A tak w ogóóóóle to są <a href="zdjecia.php">zdjęęęciaaa z obooozuuu</a>... uuuuaaaa. Idziemy spać.<br>
<b>[09.03.2004]</b> Masz komórę?? Wlazłeś na Mont Blanc, wędrujesz po Indiach, zatrzasnąłeś się w kiblu w szkole?! Właź na <b>wap.dukt.prv.pl</b> i wpisz się do Książki!!! :)))<br>
<b>[03.09.2003]</b> Nowa drużyna w naszym wspaniałym <a href="hufiec.php">Hufcu</a>!<br>
</div>
<BR><A HREF="archserw.php"><B>[archiwum serwisu]</B></A><BR>
<div align="center" style="padding-top: 50px"><div class="special" style="width: 200px;"><a href="javascript:void(0)" class="special"><b>wap.dukt.prv.pl</b></a><br>gdziekolwiek jesteś<br>- wpisujesz się do Książki!</div></div> -->
</td>

</tr>
</table>

<BR>

<div align="right">
<SMALL><I>pozmieniał na maksa, korzystając z szablonu dukt.prv.pl <A HREF="mailto:nietoperek9@poczta.onet.pl">Perek</A>, <? echo date( "d.m.Y" , filemtime($page) ) ?></I></SMALL>
</div>

</td>
</tr>
</table>

<HR ALIGN="CENTER" SIZE="1" WIDTH="60%" NOSHADE> 

<? include("stopka.inc.php"); ?>
</center>

</BODY>

</HTML>

