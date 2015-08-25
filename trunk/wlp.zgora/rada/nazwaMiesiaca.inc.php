<?
function nazwaMiesiaca( $nrMiesiaca ) {
  switch( $nrMiesiaca ) {
    case "01": $miesiac = "styczeñ"; break;
    case "02": $miesiac = "luty"; break;
    case "03": $miesiac = "marzec"; break;
    case "04": $miesiac = "kwiecieñ"; break;
    case "05": $miesiac = "maj"; break;
    case "06": $miesiac = "czerwiec"; break;
    case "07": $miesiac = "lipiec"; break;
    case "08": $miesiac = "sierpieñ"; break;
    case "09": $miesiac = "wrzesieñ"; break;
    case "10": $miesiac = "pa¼dziernik"; break;
    case "11": $miesiac = "listopad"; break;
    case "12": $miesiac = "grudzieñ"; break;
    }//switch( $nr_miesiaca )
  return $miesiac;
  }//function nazwa_miesiaca()
?>

