<?
include_once("GaleriaZdjec/KomentarzDoZdjecia.class.php");
include_once("Utilities/Logger.class.php");

class MysqlKomentarzDoZdjecia
{
	var $nazwaTabeli;
	var $polaczenie;

    function MysqlKomentarzDoZdjecia($polaczenie, $nazwaTabeli) {
    	$this->nazwaTabeli = $nazwaTabeli;
    	$this->polaczenie = $polaczenie;
    }
    
    function pobierzKomentarzeDlaZdjecia($zdjecie) {
    	$katalog = $zdjecie->katalog;
    	$nazwaPlikuZdjecia = $zdjecie->nazwaPlikuZdjecia;
    	
		$komentarze = array();

		$zapytanie = "SELECT * FROM " . $this->nazwaTabeli . " WHERE katalog = '$katalog' AND nazwaPlikuZdjecia = '$nazwaPlikuZdjecia' AND wyswietlany = 1";
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlKomentarzDoZdjecia::pobierzKomentarzeDlaZdjecia", $zapytanie, mysql_error($this->polaczenie));
		} else {
			Logger::logInfo($zapytanie);
			while ($komentarz = mysql_fetch_object($wynik)) {
				$komentarze[] = $komentarz;
			}
		}
		
		return $komentarze;
    }
    
    function pobierzOstatniKomentarz() {
		$zapytanie = "SELECT MAX(numerKomentarza) FROM " . $this->nazwaTabeli . " WHERE wyswietlany = 1";
		
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlKomentarzDoZdjecia::pobierzKomentarzeDlaZdjecia", $zapytanie, mysql_error($this->polaczenie));
			return new KomentarzDoZdjecia();
		} else {
			Logger::logInfo($zapytanie);
		}

		$numerWiersza = 0;
		if ($wiersz = mysql_fetch_array($wynik)) {
			$numerKomentarza = $wiersz[0];
		}
		
		if ($numerKomentarza == "" || $numerKomentarza == 0) {
			return new KomentarzDoZdjecia();
		}
		$zapytanie = "SELECT * FROM " . $this->nazwaTabeli . " WHERE numerKomentarza = $numerKomentarza";
		
		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlKomentarzDoZdjecia::pobierzKomentarzeDlaZdjecia", $zapytanie, mysql_error($this->polaczenie));
			return new KomentarzDoZdjecia();
		} else {
			Logger::logInfo($zapytanie);
		}

		$komentarzDoZdjecia = new KomentarzDoZdjecia();
		if (!$komentarz = mysql_fetch_object($wynik)) {
			$komentarz = new KomentarzDoZdjecia();
		}
		
		return $komentarz;
    }
    
    function dodaj($komentarzDoZdjecia) {
    	$katalog = $komentarzDoZdjecia->katalog;
    	$nazwaPlikuZdjecia = $komentarzDoZdjecia->nazwaPlikuZdjecia;
    	$podpis = $komentarzDoZdjecia->podpis;
    	$tresc = $komentarzDoZdjecia->tresc;
    	$jestOpisem = ($komentarzDoZdjecia->jestOpisem ? "1" : "0");
    	
		$zapytanie = "INSERT INTO " . $this->nazwaTabeli . " (katalog, nazwaPlikuZdjecia, podpis, tresc, jestOpisem, data)" . 
			" VALUES ('$katalog', '$nazwaPlikuZdjecia', '$podpis', '$tresc', $jestOpisem, NOW())";

		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlKomentarzDoZdjecia->dodaj", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			return true;
		}
    }
    
    function aktualizuj($numerKomentarza, $komentarzDoZdjecia) {
    	Logger::logError("Blad w metodzie MysqlKomentarzDoZdjecia->aktualizuj: metoda niezaimplementowana.");
    }
    
    function usun($numerKomentarza) {
    	Logger::logError("Blad w metodzie MysqlKomentarzDoZdjecia->aktualizuj: metoda niezaimplementowana.");
    }
    
    function usunOpisyDlaZdjecia($katalog, $nazwaPlikuZdjecia) {   
		$zapytanie = "DELETE FROM komentarzDoZdjecia WHERE jestOpisem = 't' AND katalog = '$katalog' AND nazwaPlikuZdjecia = '$nazwaPlikuZdjecia'";

		$wynik = mysql_query($zapytanie, $this->polaczenie);
		if (!$wynik) {
			Logger::logMysqlError("MysqlKomentarzDoZdjecia->usunOpisyDlaZdjecia", $zapytanie, mysql_error($this->polaczenie));
			return false;
		} else {
			Logger::logInfo($zapytanie);
			return true;
		}
    }
}
?>