<?
require_once("ZarzadcaKomentarzy.class.php");

/**
 * Zarzadza komentarzami do zdjec przechowywanymi w plikach.
 * 
 * Komentarze do zdjecia "20051101_0113.jpg" przechowywane sa w pliku
 * "20051101_0113.jpg.txt" w tym samym katalogu, co plik zdjecia.
 * Udostepnia wszystkie komentarze do zdjecia w postaci jednego tekstu,
 * zawierajacego juz znaczniki HTML. 
 */
class ZarzadcaKomentarzyZPliku extends ZarzadcaKomentarzy
{
	var $nazwaPlikuKomentarzy;
	
	function ZarzadcaKomentarzyZPliku($zdjecie) {
		// Wywolanie konstruktora klasy bazowej.
		$this->ZarzadcaKomentarzy($zdjecie);
    	
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
    
    /**
     * Zapisuje komentarz do zdjecia do pliku komentarzy.
     */
    function zapiszKomentarz($komentarz) {
		$tresc = stripslashes(strip_tags($komentarz->tresc));
		$podpis = stripslashes(strip_tags($komentarz->podpis));

//		if ($podpis == "***opis***" ) {
//			// Uzytkownik chce dodac/zmienic opis do zdjecia zamiast zwyklego komentarza
//			return $this->zapiszOpisZdjecia($tresc);
//		} else 
		if (($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "a")) == NULL) {
			echo "Blad w ZarzadcaKomentarzyZPliku::zapiszKomentarz. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.<br />";
			return 2;
		} else if ($tresc == "") {
			return 1;
		} else {
			// Dodaj komentarz do zdjecia.
			$doPliku = "$tresc <b>[$podpis]</b><br>\n";
			fwrite($uchwytPliku, $doPliku);
			fclose($uchwytPliku);
			return 0;
		}
	}
    
    /**
     * Zapisuje opis do zdjecia do pliku komentarzy.
     */
    function zapiszOpisZdjecia($tresc) {
		$zawartoscPliku = file($this->nazwaPlikuKomentarzy);
		if (strtolower(substr($zawartoscPliku[0], 0, 3)) == "<b>") {
			// Zdjecie ma juz opis, nalezy zamienic go na nowy.
			$zawartoscPliku[0] = "<b>$tresc</b><br><br>\n";
			if (NULL == ($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "w"))) {
				echo "Blad w ZarzadcaKomentarzyZPliku::zapiszOpisZdjecia. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.<br />";
				return 1;
			} else {
				$zawartoscPliku = join("", $zawartoscPliku);
				fwrite($uchwytPliku, $zawartoscPliku);
		    	fclose($uchwytPliku);
		    	return 0;
			}
		} else {
			// Zdjecie nie ma jeszcze opisu, nalezy go dopisac na poczatek pliku.
			if (NULL == ($uchwytPliku = fopen($this->nazwaPlikuKomentarzy, "w"))) {
				echo "Blad w ZarzadcaKomentarzyZPliku::zapiszOpisZdjecia. Nie mozna otworzyc pliku '" . $this->nazwaPlikuKomentarzy . "'.<br />";
				return 1;
			} else {
				fwrite($uchwytPliku, "<b>$tresc</b><br><br>\n");
				$zawartoscPliku = join("", $zawartoscPliku);
				fwrite($uchwytPliku, $zawartoscPliku);
				fclose($uchwytPliku);
				return 0;
			}
		}
    }
}
?>