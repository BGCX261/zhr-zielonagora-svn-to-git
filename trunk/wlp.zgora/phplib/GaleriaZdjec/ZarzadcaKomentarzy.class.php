<?
include_once("GaleriaZdjec/FabrykaObiektowGaleriiZdjec.class.php");
/**
 * Klasa bazowa dla zarzadcow komentarzy przechowywanych w roznych postaciach 
 * - w plikach lub w bazie danych.
 * 
 * Kazda klasa pochodna powinna dziedziczyc obie funkcje zdefiniowane w tej
 * klasie - pobierzKomentarze i zapiszKomentarz. 
 */
class ZarzadcaKomentarzy
{
	/**
	 * Zwraca komentarze do zdjecia.
	 *  
	 * @static
	 * @param $zdjecie Zdjecie Zdjecie, dla ktorego nalezy pobrac komentarze.
	 */
	function pobierzKomentarze($zdjecie) {
		$daneKomentarzy = FabrykaObiektowGaleriiZdjec::daneKomentarzy();
		
		return $daneKomentarzy->pobierzKomentarzeDlaZdjecia($zdjecie);
	}
	
	function pobierzOstatniKomentarz() {
		$daneKomentarzy = FabrykaObiektowGaleriiZdjec::daneKomentarzy();
		
		return $daneKomentarzy->pobierzOstatniKomentarz();
	}
	
	/**
	 * Zapisuje nowy komentarz dla zdjecia.
	 * 
	 * @static
	 * @param $zdjecie Zdjecie Zdjecie, do ktorego odnosi sie komentarz.
	 * @param $komentarzDoZdjecia KomentarzDoZdjecia Obiekt zawieraj¹cy dane komentarza, ktory ma byc zapisany.
     * @return bool True, jesli komentarz zostal poprawnie zapisany.
	 */
	function zapiszKomentarz($zdjecie, $komentarzDoZdjecia) {
		// echo $komentarzDoZdjecia->toString();
		$daneKomentarzy = FabrykaObiektowGaleriiZdjec::daneKomentarzy();

		return $daneKomentarzy->zapiszKomentarz($zdjecie, $komentarzDoZdjecia);
	}
	
    /**
     * Zapisuje opis zdjecia.
     * 
     * Opis jest wyswietlany powyzej wszystkich komentarzy pogrubiona czcionka. Zdjecie
     * moze miec co najwyzej jeden opis.
     * 
     * @static
     * @param $opis String Tresc opisu zdjecia.
     * @return bool True, jesli opis zostal poprawnie zapisany.
     */
	function zapiszOpisZdjecia($zdjecie, $opis) {
		$daneKomentarzy = FabrykaObiektowGaleriiZdjec::daneKomentarzy();

		return $daneKomentarzy->zapiszOpisZdjecia($zdjecie, $opis);
	}
}
?>