<?
require_once("FabrykaObiektowGaleriiZdjec.class.php");
require_once("ZarzadcaKomentarzyZPliku.class.php");
require_once("ZarzadcaKomentarzyZBazyDanychMysql.class.php");

class Zdjecie
{
	/**
	 * Obiekt klasy GaleriaZdjec - galeria, do ktorej nalezy zdjecie.
	 */
	var $galeriaZdjec;
	/**
	 * Sciezka do katalogu, w ktorym znajduje sie plik zdjecia.
	 * 
	 * Np. "images/051101 cmentarz".
	 */
	var $katalog;
	/**
	 * Nazwa pliku ze zdjeciem.
	 * 
	 * Np. "20051101_0113.jpg".
	 */
	var $nazwaPlikuZdjecia;
	/**
	 * Pelna sciezka do pliku ze zdjeciem (polaczony katalog z nazwa pliku).
	 * 
	 * Np. "images/051101 cmentarz/20051101_0113.jpg".
	 */
	var $sciezkaDoPliku;
	
	/**
	 * @param $galeriaZdjec Obiekt klasy GaleriaZdjec lub string zawierajacy unikalny identyfikator galerii (idGalerii).
	 */
	function Zdjecie($galeriaZdjecLubKatalog, $nazwaPliku) {
		if (is_string($galeriaZdjecLubKatalog)) {
			$this->galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($galeriaZdjecLubKatalog);
		} else if (is_object($galeriaZdjecLubKatalog)) {
			$this->galeriaZdjec = $galeriaZdjecLubKatalog;
		}
		$this->katalog = $this->galeriaZdjec->katalog;
		$this->nazwaPlikuZdjecia = $nazwaPliku;
		$this->sciezkaDoPliku = $this->katalog.'/'.$this->nazwaPlikuZdjecia; 
	}
	
	function pobierzKomentarze() {
		$zarzadcaKomentarzy = FabrykaObiektowGaleriiZdjec::zarzadcaKomentarzy($this, $this->galeriaZdjec->sposobPrzechowywaniaKomentarzy);
		return $zarzadcaKomentarzy->pobierzKomentarze();
	}

	function zapiszKomentarz($komentarz) {
		$zarzadcaKomentarzy = FabrykaObiektowGaleriiZdjec::zarzadcaKomentarzy($this, $this->galeriaZdjec->sposobPrzechowywaniaKomentarzy);
		return $zarzadcaKomentarzy->zapiszKomentarz($komentarz);
	}
	
	function zapiszOpisZdjecia($tresc) {
		$zarzadcaKomentarzy = FabrykaObiektowGaleriiZdjec::zarzadcaKomentarzy($this, $this->galeriaZdjec->sposobPrzechowywaniaKomentarzy);
		return $zarzadcaKomentarzy->zapiszOpisZdjecia($tresc);
	}
}
?>
