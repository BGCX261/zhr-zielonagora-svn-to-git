<?
class Zdjecie
{
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
	 * Konstruktor klasy.
	 * 
	 * @param $katalog String Nazwa katalogu galerii zdjec.
	 */
	function Zdjecie($katalog, $nazwaPlikuZdjecia) {
		$this->katalog = $katalog;
		$this->nazwaPlikuZdjecia = $nazwaPlikuZdjecia;
	}

	/**
	 * Pobiera pelna sciezke do pliku ze zdjeciem (polaczony katalog z nazwa pliku).
	 * 
	 * Np. "images/051101 cmentarz/20051101_0113.jpg".
	 */
	function sciezkaDoPliku() {
		return $this->katalog.'/'.$this->nazwaPlikuZdjecia;
	}
	
	function toString() {
		echo "[Zdjecie:".$this->katalog.":".$this->nazwaPlikuZdjecia."]";
	}
}
?>