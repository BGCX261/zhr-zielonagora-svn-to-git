<? include_once( "nazwaMiesiaca.inc.php" ); ?>

<?
  //zwraca date w postaci "YYYY nazwa_mca d" albo "nazwa_mca"...
  function ulozDate( $data_mysql ) {
    //przeksztalc date zeby nie wyswietlala roku jesli aktualny
    //i nie wyswietlala miesiaca i dnia jesli sa zerami
    $dataTab = explode( "-" , $data_mysql );
    if( $dataTab[0] == date("Y") )
      $dataTab[0] = "";
    if( $dataTab[1] == 0 )
      {
      $dataTab[1] = ""; // nie wyswietlaj miesiaca jesli jest zerem
      $dataTab[2] = ""; // nie wyswietlaj dnia jesli miesiac jest zerem
      }
    else
      $dataTab[1] = nazwaMiesiaca( $dataTab[1] );
    if( $dataTab[2] == 0 )
      $dataTab[2] = ""; // nie wyswietlaj dnia jesli jest zerem
    else
      if( $dataTab[2] < 10 )
        $dataTab[2] = substr( $dataTab[2], 1, 1 );

    $data_nowa = implode( " ", $dataTab ); 
    return( $data_nowa );
  } //function uloz_date  
?>

