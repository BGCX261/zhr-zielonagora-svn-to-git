<?
include_once("Utilities/Logger.class.php");

class MysqlGaleriaZdjec
{
	var $nazwaTabeli;
	var $polaczenie;

    function MysqlGaleriaZdjec($polaczenie, $nazwaTabeli) {
    	$this->polaczenie = $polaczenie;
    	$this->nazwaTabeli = $nazwaTabeli;
    }
    
    function pobierzWszystkie() {
    	$listaGaleriiZdjec = array();
    	
		$zapytanie = "SELECT * FROM " . $this->nazwaTabeli . " ORDER BY data DESC";
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlGaleriaZdjec->pobierzWszystkie", $zapytanie, mysql_error($this->polaczenie));
		} else {
			Logger::logInfo($zapytanie);
			while ($galeriaZdjec = mysql_fetch_object($wynik)) {
				$listaGaleriiZdjec[] = $galeriaZdjec;
			}
		}
		
		return $listaGaleriiZdjec;
    }
    
    function pobierz($katalog) {
		$zapytanie = "SELECT * FROM " . $this->nazwaTabeli . " WHERE katalog = '$katalog'";
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlGaleriaZdjec->pobierz", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			if ($galeriaZdjec = mysql_fetch_object($wynik)) {
				return $galeriaZdjec;
			}
		}
    }

	function dodaj($galeriaZdjec) {
		$katalog   = $galeriaZdjec->katalog;
		$tytulGalerii = $galeriaZdjec->tytulGalerii;
		$opisGalerii = $galeriaZdjec->opisGalerii;
		$data = $galeriaZdjec->data;
		$sposob = $galeriaZdjec->sposobPrzechowywaniaKomentarzy;
		$dataUtworzenia = $galeriaZdjec->dataUtworzenia;
		$nowa = ($galeriaZdjec->nowa ? "1" : "0");
		$prawieNowa = ($galeriaZdjec->prawieNowa ? "1" : "0");
		
		$zapytanie = "INSERT INTO " . $this->nazwaTabeli . " (katalog, tytulGalerii, opisGalerii, data, sposobPrzechowywaniaKomentarzy, dataUtworzenia, nowa, prawieNowa)" .
				" VALUES ('$katalog', '$tytulGalerii', '$opisGalerii', '$data', '$sposob', '$dataUtworzenia', $nowa, $prawieNowa)";

		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlGaleriaZdjec->aktualizuj", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			return true;
		}
	}
    
	function aktualizuj($katalog, $galeriaZdjec) {
		$zapytanie = "UPDATE " . $this->nazwaTabeli . " SET " .
			"katalog = '" . $galeriaZdjec->katalog . "', " .
			"tytulGalerii = '" . $galeriaZdjec->tytulGalerii . "', " .
			"opisGalerii = '" . $galeriaZdjec->opisGalerii . "', " .
			"data = '" . $galeriaZdjec->data . "', " .
			"sposobPrzechowywaniaKomentarzy = '" . $galeriaZdjec->sposobPrzechowywaniaKomentarzy . "', " .
			"dataUtworzenia = '" . $galeriaZdjec->dataUtworzenia . "', " .
			"nowa = " . ($galeriaZdjec->nowa ? "1" : "0") . ", " .
			"prawieNowa = " . ($galeriaZdjec->prawieNowa ? "1" : "0") . " " .
			"WHERE katalog = '$katalog'";
		
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlGaleriaZdjec->aktualizuj", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			return true;
		}
	}

    function usun($katalog) {
    	$zapytanie = "DELETE FROM " . $this->nazwaTabeli . " WHERE katalog = '$katalog'";

		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlGaleriaZdjec->usun", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			return true;
		}
    }
}
?>