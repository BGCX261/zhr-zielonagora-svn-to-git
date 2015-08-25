<?
include_once("GaleriaZdjec/FabrykaObiektowGaleriiZdjec.class.php");
include_once("GaleriaZdjec/UstawieniaGaleriiZdjec.class.php");
include_once("GaleriaZdjec/Zdjecie.class.php");
include_once("Utilities/Logger.class.php");

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
    	$daneGaleriiZdjec = FabrykaObiektowGaleriiZdjec::daneGaleriiZdjec();

    	$listaGaleriiZdjec = $daneGaleriiZdjec->pobierzWszystkieGalerie();
		
		if (count($listaGaleriiZdjec) == 0) {
			Logger::logError("Blad w metodzie ZarzadcaGaleriiZdjec::pobierzWszystkieGalerie. Nie znaleziono zadnej galerii zdjec.");
		}
		
		return $listaGaleriiZdjec;
    }
    
    /**
     * Zwraca obiekt klasy GaleriaZdjec.
     */
    function pobierzGalerie($katalog) {
    	$daneGaleriiZdjec = FabrykaObiektowGaleriiZdjec::daneGaleriiZdjec();
    	
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
	 * Zwraca tablice obiektow klasy Zdjecie dla plikow zdjec znajdujacych sie w podanym katalogu.
	 */
	function pobierzZdjeciaZKatalogu($katalog) {
		$zdjecia = array();

		$uchwytKatalogu = opendir($katalog);
		for ($numerZdjecia = 0; $nazwaPliku = readdir($uchwytKatalogu); ) {
			if (strtolower(substr($nazwaPliku, -4)) == ".jpg") {
				$zdjecia[$numerZdjecia] = new Zdjecie($katalog, $nazwaPliku);
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
    	
    	$daneGaleriiZdjec = FabrykaObiektowGaleriiZdjec::daneGaleriiZdjec();

    	return $daneGaleriiZdjec->dodajGalerie($galeriaZdjec);
    }

    /**
     * Aktualizuje w bazie danych informacje o galerii z podanego katalogu, 
     * zgodnie z danymi podanymi w obiekcie $galeriaZdjec.
     */
    function aktualizujGalerie($katalog, $galeriaZdjec) {
    	$daneGaleriiZdjec = FabrykaObiektowGaleriiZdjec::daneGaleriiZdjec();

    	return $daneGaleriiZdjec->aktualizujGalerie($katalog, $galeriaZdjec);
    }
    
    /**
     * Usuwa z bazy danych galerie dla podanego katalogu.
     */
    function usunGalerie($katalog) {
    	$daneGaleriiZdjec = FabrykaObiektowGaleriiZdjec::daneGaleriiZdjec();

    	return $daneGaleriiZdjec->usunGalerie($katalog);
    }
}
?>