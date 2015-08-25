<?
class GaleriaZdjec
{
//	/**
//	 * Liczba okreslajaca numer ostatniego zdjecia, ktore ma zostac wyswietlone (dla galerii czesciowej).
//	 * Np. 10.
//	 */
//	var $doZdjecia;

//	/**
//	 * Liczba okreslajaca numer pierwszego zdjecia, ktore ma zostac wyswietlone (dla galerii czesciowej).
//	 * Np. 1.
//	 */
//	var $odZdjecia;
	/**
	 * Opis galerii, wyswietlany w liscie galerii.
	 * Np. "Odwiedziny u Gandalfa i Donalda i u Pipasa.".
	 */
	var $opisGalerii;
	/**
	 * Sciezka do katalogu ze zdjeciami. Katalog jest unikalnym identyfikatorem galerii.
	 * 
	 * Np. "images/051101 cmentarz" albo "images/040709 DODOMU 40/krakow/gra".
	 */
	var $katalog;
	/**
	 * Sposób przechowywania komentarzy - 'pliki' albo 'mysql'.
	 */
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

	function GaleriaZdjec() {}

	function toString() {
		$output = "GaleriaZdjec[".$this->katalog.":".$this->tytulGalerii.":".$this->opisGalerii."]";
		return $output;
	}
}
?>
