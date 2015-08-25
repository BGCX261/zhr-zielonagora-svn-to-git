<?
/**
 * Klasa bazowa dla zarzadcow komentarzy przechowywanych w roznych postaciach 
 * - w plikach lub w bazie danych.
 * 
 * Kazda klasa pochodna powinna dziedziczyc obie funkcje zdefiniowane w tej
 * klasie - pobierzKomentarze i zapiszKomentarz. 
 */
class ZarzadcaKomentarzy
{
	var $zdjecie;
	
	/**
	 * Tworzy nowy obiekt.
	 * 
	 * @param $zdjecie Obiekt klasy Zdjecie, do ktorego komentarzami ma zarzadzac 
	 * nowo utworzony obiekt.
	 */
	function ZarzadcaKomentarzy($zdjecie) {
		$this->zdjecie = $zdjecie;
	}
	
	/**
	 * Zwraca komentarze do zdjecia (w formie zaleznej od sposobu przechowywania).
	 */
	function pobierzKomentarze() {}
	
	/**
	 * Zapisuje nowy komentarz dla zdjecia.
	 * 
	 * @param $komentarz Obiekt klasy Komentarz zawierajacy dane komentarza do zapisania.
     * @return Metoda zwraca nastepujace wartosci:
     * 0 - Komentarz zostal dodany.
     * 1 - Tresc komentarza jest pusta, komentarz nie zostal dodany.
     * 2 - Wystapil blad, komentarz nie mogl zostac dodany. Szczegoly bledu zostaly wypisane na stronie.
	 */
	function zapiszKomentarz($komentarz) {}
	
    /**
     * Zapisuje opis do zdjecia.
     * 
     * Opis jest wyswietlany powyzej wszystkich komentarzy pogrubiona czcionka. Zdjecie
     * moze miec co najwyzej jeden opis.
     * @return Metoda zwraca nastepujace wartosci:
     * 0 - Opis do zdjecia zostal dodany.
     * 1 - Wystapil blad, opis nie mogl zostac dodany. Szczegoly bledu zostaly wypisane na stronie.
     */
	function zapiszOpisZdjecia($tresc) {}
}
?>