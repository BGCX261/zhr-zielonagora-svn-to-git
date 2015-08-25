<b>Nowo¶æ:</b> <big><a href="?page=ito">Internetowa Tablica Og³oszeñ!</a></big> do og³aszania siê, oczywiscie.<br />
Wszelkie wady i usterki prosze mi szybko opisywaæ. Zastrzegam jednak, ¿e jest to dopiero wersja testowa i wpisy czasem mog± pojawiaæ siê tam, gdzie nie trzeba, lub nawet same dopisywaæ:]

 
<br>
<br>
Ostatni wpis:<br>


<?
// Pokaz ostatni wpis z Ksiazki Skarg i Wnioskow.

  // Znajdz index ostatniego (najswiezszego) wpisu.
  $ksiazka_rada_ost_nr = @mysql_fetch_array( @mysql_query( "SELECT max(nr_wpisu) as max from ksiazka_rada where wyswietlany='tak'" ) );
	// Wczytaj ten wpis do zmiennej $ksiazka_rada_ost_Tab.
  $ksiazka_rada_ost_Tab = @mysql_fetch_array( @mysql_query( "SELECT * FROM ksiazka_rada WHERE wyswietlany='tak' AND nr_wpisu=$ksiazka_rada_ost_nr[max]" ) ); 
	// Obetnij dlugosc id do 5 znakow.
  if( strlen($ksiazka_rada_ost_Tab[id]) > 10 )
    $ksiazka_rada_ost_id = substr( strip_tags($ksiazka_rada_ost_Tab[id]), 0, 5 ) . "(...)";
  else
    $ksiazka_rada_ost_id = strip_tags($ksiazka_rada_ost_Tab[id]);
	// Obetnij dlugosc wpisu do 20 znakow.
  if( strlen($ksiazka_rada_ost_Tab[skarga_lub_wniosek]) > 25 )
    $ksiazka_rada_ost_slubw = trim( substr( strip_tags($ksiazka_rada_ost_Tab[skarga_lub_wniosek]), 0, 20 ) ) . "(...)";
  else
    $ksiazka_rada_ost_slubw = strip_tags($ksiazka_rada_ost_Tab[skarga_lub_wniosek]);
  //Ostatecznie formatuj dane.
  $ksiazka_rada_ost = "<B>[". $ksiazka_rada_ost_Tab[data]. "] ". $ksiazka_rada_ost_id. "</B> ". $ksiazka_rada_ost_slubw;
	
	// Wypisujemy wpis
	echo $ksiazka_rada_ost;
?>
<br />
