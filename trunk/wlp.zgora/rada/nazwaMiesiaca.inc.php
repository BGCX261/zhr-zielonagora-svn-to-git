<?
function nazwaMiesiaca( $nrMiesiaca ) {
  switch( $nrMiesiaca ) {
    case "01": $miesiac = "stycze�"; break;
    case "02": $miesiac = "luty"; break;
    case "03": $miesiac = "marzec"; break;
    case "04": $miesiac = "kwiecie�"; break;
    case "05": $miesiac = "maj"; break;
    case "06": $miesiac = "czerwiec"; break;
    case "07": $miesiac = "lipiec"; break;
    case "08": $miesiac = "sierpie�"; break;
    case "09": $miesiac = "wrzesie�"; break;
    case "10": $miesiac = "pa�dziernik"; break;
    case "11": $miesiac = "listopad"; break;
    case "12": $miesiac = "grudzie�"; break;
    }//switch( $nr_miesiaca )
  return $miesiac;
  }//function nazwa_miesiaca()
?>

