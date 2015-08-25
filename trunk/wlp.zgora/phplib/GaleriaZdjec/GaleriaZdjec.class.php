<?
/**
 * Obiekt danych reprezentujacy dane galerii zdjec. Ma pola takie jak kolumny tabeli 'galeriaZdjec'.
 */
class GaleriaZdjec
{
	/**
	 * Opis galerii, wyswietlany w liscie galerii.
	 * Np. "Odwiedziny u Gandalfa i Donalda i u Pipasa.".
	 */
	var $opisGalerii;
	/**
	 * Sciezka do katalogu ze zdjeciami.
	 * 
	 * Np. "images/051101 cmentarz" albo "images/040709 DODOMU 40/krakow/gra".
	 */
	var $katalog;
	var $sposobPrzechowywaniaKomentarzy;
	/**
	 * Tytul galerii, wyswietlany na gorze galerii i na liscie galerii jako link.
	 * 
	 * Np. "1 listopada na cmentarzu".
	 */
	var $tytulGalerii;
	var $dataUtworzenia;
	var $nowa;
	var $prawieNowa;

	function GaleriaZdjec() { }
	
	function toString() {
		$output = "GaleriaZdjec[".$this->katalog.":".$this->tytulGalerii.":".$this->opisGalerii."]";
		return $output;
	}
}
?>