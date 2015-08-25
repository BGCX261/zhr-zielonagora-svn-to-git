<?
include_once("GaleriaZdjec/KomentarzDoZdjecia.class.php");
include_once("Utilities/Logger.class.php");

/**
 * Zarzadza komentarzami do zdjec przechowywanymi w plikach.
 * 
 * Komentarze do zdjecia "20051101_0113.jpg" przechowywane sa w pliku
 * "20051101_0113.jpg.txt" w tym samym katalogu, co plik zdjecia.
 * Udostepnia wszystkie komentarze do zdjecia w postaci jednego tekstu,
 * zawierajacego juz znaczniki HTML. 
 */
class DaneKomentarzyZPlikow
{
	var $nazwaPlikuKomentarzy;
	
	function DaneKomentarzyZPlikow($zdjecie) {
		$this->nazwaPlikuKomentarzy = $this->zdjecie->katalog . "/" . $this->zdjecie->nazwaPlikuZdjecia . ".txt";
	}
	
	/**
	 * Odnajduje plik komentarzy dla pliku zdjecia i zwraca jego zawartosc.
	 * 
	 * Nazwa pliku komentarzy powinna byc taka jak nazwa pliku zdjecia, plus '.txt' na koncu.
	 * Np. dla zdjecia "20051101_0113.jpg" plik komentarzy powinien nazywac sie
	 * "20051101_0113.jpg.txt". 
	 */
    function pobierzKomentarze() {
    	return file_get_contents($this->nazwaPlikuKomentarzy);
    }
    
    function pobierzOstatniKomentarz() {
		return new KomentarzDoZdjecia();
    }
    
    /**
     * Zapisuje komentarz do zdjecia do pliku komentarzy.
     * 
     * @return bool True, jesli udalo sie zapisac komentarz.
     */
    function zapiszKomentarz($komentarz) {
		$tresc = stripslashes(strip_tags($komentarz->tresc));
		$podpis = stripslashes(strip_tags($komentarz->podpis));

		if (($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "a")) == NULL) {
			Logger::logError("Blad w DaneKomentarzyZPlikow::zapiszKomentarz. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.");
			return false;
		} else if ($tresc == "") {
			Logger::logError("Blad w DaneKomentarzyZPlikow::zapiszKomentarz. Tresc komentarza jest pusta.");
			return false;
		} else {
			// Dodaj komentarz do zdjecia.
			$doPliku = "$tresc <b>[$podpis]</b><br>\n";
			fwrite($uchwytPliku, $doPliku);
			fclose($uchwytPliku);
			return true;
		}
	}
    
    /**
     * Zapisuje opis do zdjecia do pliku komentarzy.
     * 
     * @return bool True, jesli udalo sie zapisac opis.
     */
    function zapiszOpisZdjecia($opis) {
		$zawartoscPliku = file($this->nazwaPlikuKomentarzy);
		if (strtolower(substr($zawartoscPliku[0], 0, 3)) == "<b>") {
			// Zdjecie ma juz opis, nalezy zamienic go na nowy.
			$zawartoscPliku[0] = "<b>$opis</b><br><br>\n";
			if (NULL == ($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "w"))) {
				Logger::logError("Blad w DaneKomentarzyZPlikow::zapiszOpisZdjecia. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.");
				return false;
			} else {
				$zawartoscPliku = join("", $zawartoscPliku);
				fwrite($uchwytPliku, $zawartoscPliku);
		    	fclose($uchwytPliku);
		    	return true;
			}
		} else {
			// Zdjecie nie ma jeszcze opisu, nalezy go dopisac na poczatek pliku.
			if (NULL == ($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "w"))) {
				Logger::logError("Blad w DaneKomentarzyZPlikow::zapiszOpisZdjecia. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.");
				return false;
			} else {
				fwrite($uchwytPliku, "<b>$opis</b><br><br>\n");
				$zawartoscPliku = join("", $zawartoscPliku);
				fwrite($uchwytPliku, $zawartoscPliku);
				fclose($uchwytPliku);
				return true;
			}
		}
    }
}
?>