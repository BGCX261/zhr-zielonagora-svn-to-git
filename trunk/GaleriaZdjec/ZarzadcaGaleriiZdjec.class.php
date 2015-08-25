<?
require_once("DaneGaleriiZdjec.class.php");
require_once("UstawieniaGaleriiZdjec.class.php");

/**
 * Zawiera statyczne metody sluzace do zarzadzania galeriami zdjec.
 */
class ZarzadcaGaleriiZdjec
{
    /**
     * Zwraca tablice obiektow zawierajacych informacje o galeriach zdjec.
     * 
     * Obiekty w tablicy maja pola takie, jak pola w bazodanowej tabeli "galeriaZdjec". 
     */
    function pobierzWszystkieGalerie() {
    	$daneGaleriiZdjec = new DaneGaleriiZdjec(ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql());
    	$listaGaleriiZdjec = $daneGaleriiZdjec->pobierzWszystkieGalerie();
		
		if (count($listaGaleriiZdjec) == 0) {
			echo "Blad w metodzie ZarzadcaGaleriiZdjec::pobierzWszystkieGalerie. Nie znaleziono zadnej galerii zdjec.<br />\n";
		}
		
		return $listaGaleriiZdjec;
    }
    
    /**
     * Zwraca obiekt klasy GaleriaZdjec.
     */
    function pobierzGalerie($katalog) {
    	$daneGaleriiZdjec = new DaneGaleriiZdjec(ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql());
    	return $daneGaleriiZdjec->pobierzGalerie($katalog);
    }

	/**
	 * Pobiera ilosc zdjec w podanym katalogu.
	 */
	function pobierzIloscZdjecWKatalogu($katalog) {
		$uchwytKatalogu = opendir($katalog);
		for ($iloscZdjec = 0; $nazwaPliku = readdir($uchwytKatalogu); ) {
			if (strtolower(substr($nazwaPliku, -4)) == ".jpg") {
				$iloscZdjec++;
			}
		}
		closedir($uchwytKatalogu);
		
		return $iloscZdjec;
	}
	    
	/**
	 * Tworzy polaczenie z baza danych MySQL i zwraca 'resource', przydatny jako drugi argument w funkcji mysql_query.
	 */
	function pobierzPolaczenieZBazaDanychMysql() {
		$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();
		
		$bazaDanych = mysql_connect($ustawieniaGaleriiZdjec->mysqlSerwer, $ustawieniaGaleriiZdjec->mysqlUzytkownik, $ustawieniaGaleriiZdjec->mysqlHaslo);
		mysql_select_db($ustawieniaGaleriiZdjec->mysqlNazwaBazy, $bazaDanych);
		
		return $bazaDanych; 
	}

	/**
	 * Zwraca tablice obiektow klasy Zdjecie dla plikow zdjec znajdujacych sie w podanym katalogu.
	 */
	function pobierzZdjeciaGalerii($galeriaZdjec) {
		$zdjecia = array();

		$uchwytKatalogu = opendir($galeriaZdjec->katalog);
		for ($numerZdjecia = 0; $nazwaPliku = readdir($uchwytKatalogu); ) {
			if (strtolower(substr($nazwaPliku, -4)) == ".jpg") {
				$zdjecia[$numerZdjecia] = new Zdjecie($galeriaZdjec, $nazwaPliku);
				$numerZdjecia++;
			}
		}
		$iloscZdjec = $numerZdjecia;
		closedir($uchwytKatalogu);

		sort($zdjecia);

		return $zdjecia;
	}

	/**
	 * Tworzy nowa galerie zdjec, zgodnie z danymi podanymi w obiekcie $galeriaZdjec.
	 */    
    function dodajGalerie($galeriaZdjec) {
    	// Ustaw domyslny sposob przechowywania komentarzy i date utworzenia galerii.
    	$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();
    	$galeriaZdjec->sposobPrzechowywaniaKomentarzy = $ustawieniaGaleriiZdjec->domyslnySposobPrzechowywaniaKomentarzy;
    	$galeriaZdjec->dataUtworzenia = date("Y-m-d");
    	
    	$daneGaleriiZdjec = new DaneGaleriiZdjec(ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql());
    	return $daneGaleriiZdjec->dodajGalerie($galeriaZdjec);
    }

    /**
     * Aktualizuje w bazie danych informacje o galerii o ID = $idGalerii, 
     * zgodnie z danymi podanymi w obiekcie $galeriaZdjec.
     */
    function aktualizujGalerie($katalog, $galeriaZdjec) {
    	$daneGaleriiZdjec = new DaneGaleriiZdjec(ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql());
    	return $daneGaleriiZdjec->aktualizujGalerie($katalog, $galeriaZdjec);
    }
    
    /**
     * Usuwa z bazy danych galerie.
     */
    function usunGalerie($katalog) {
    	$daneGaleriiZdjec = new DaneGaleriiZdjec(ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql());
    	return $daneGaleriiZdjec->usunGalerie($katalog);
    }
}
?>
