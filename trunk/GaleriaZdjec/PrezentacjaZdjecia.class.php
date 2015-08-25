<?
require_once("Komentarz.class.php");
require_once("Zdjecie.class.php");

/**
 * Ulatwia wyswietlanie obiektu Zdjecie na stronie HTML.
 */
class PrezentacjaZdjecia
{
	/**
	 * Zwraca kod HTML wyswietlajacy dwa okienka i przycisk do dodawania nowego komentarza.
	 */
	var $dodawanieKomentarza;
	/**
	 * Zwraca komentarze do zdjecia.
	 * 
	 * Zwracany tekst jest kodem HTML wyswietlajacym wszystkie komentarze dla zdjecia.
	 * Np. "<b>ziomek</b> Ale fajna mina:)<br /><b>inny ziomek</b>Ale glupia mina :(". 
	 */
	var $komentarze;
	/**
	 * Kod HTML elementu IMG zawierajacego zdjecie.
	 * 
	 * Np. "<img src="images/051101 cmentarz/20051101_0113.jpg" />".
	 */
	var $zdjecieImg;
	/**
	 * Obiekt klasy Zdjecie, dla ktorego utworzony zostal ten obiekt.
	 */
	var $zdjecie;
	
	function PrezentacjaZdjecia($zdjecie) {
		$this->zdjecie = $zdjecie;
		
		$this->zdjecieImg = '<img src="'.$this->zdjecie->sciezkaDoPliku.'" />';
		$this->komentarze = $this->ubierzKomentarzeWHtml($this->zdjecie->pobierzKomentarze());
		$this->dodawanieKomentarza = $this->utworzPanelDodawaniaKomentarza();
	}
	
	/**
	 * Zwraca kod HTML zawierajacy wszystkie komentarze podane w zmiennej $komentarze.
	 */
	function ubierzKomentarzeWHtml($komentarze) {
		$html = "";
		if (is_string($komentarze)) {
			// Zmienna $komentarze juz jest tekstem HTML, nie ma nic do roboty.
			$html = $komentarze;
		} else if (is_array($komentarze)) {
			// Zmienna $komentarze jest tablic¹ obiektow Komentarz.
			foreach ($komentarze as $komentarz) {
				if ($komentarz->jestOpisem) {
					$html = "<b>" . $komentarz->tresc . "</b><br /><br />\n" . $html;
				} else {
					$html = $html  . " <b>" . $komentarz->podpis . "</b><br />" . $komentarz->tresc . "<br />\n";
				}
			}
		}
		return $html;
	}
	
	/**
	 * Zwraca kod HTML zawierajacy okienko do wpisania komentarza do zdjecia, okienka do wpisania podpisu do komentarza
	 * i przycisk do dodania komentarza.
	 */
	function utworzPanelDodawaniaKomentarza() {
		$html = "";
		
		// Zdefiniuj poszczegolne elementy panelu.
		$formAction = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		$hiddenNazwaPlikuZdjecia = '<input type="hidden" name="nazwaPlikuZdjecia" value="'.$this->zdjecie->nazwaPlikuZdjecia.'" />';
		$inputKomentarz = '<input name="tresc" value="" size="10" />';
		$inputPodpis = '<input name="podpis" value="" size="10" />';
		$przyciskDodajKomentarz = '<input type="submit" value="klick" />';
		$formularzPoczatek = '';
		$formularzKoniec = '</form>';
		
		// Uloz elementy panelu.
		$html = "<div>" .
				"<form action=\"$formAction\" method=\"post\">\n" .
				"$hiddenNazwaPlikuZdjecia\n" .
				"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">" .
				"<tr><td style=\"text-align: left\"><b>nick:</b>$inputPodpis</td></tr>\n" .
				"<tr><td style=\"text-align: left\"><b>txt:</b>$inputKomentarz</td></tr>\n" .
				"<tr><td style=\"text-align: left\">$przyciskDodajKomentarz</td></tr>\n" .
				"</table>\n" .
				"</form>\n" .
				"</div>\n";
		
		return $html;
	}	

	/**
	 * Wykonuje wszystkie czynnosci wymagane przy zapisie komentarza do pliku,
	 * zaczynajac od pobrania odpowiednich danych ze zmiennej $_REQUEST, przez 
	 * utworzenie odpowiednich obiektow i wywolanie ich metod, a konczac na 
	 * wypisaniu komunikatu potwierdzajacego lub stwierdzajacego blad. 
	 */
	function zapiszKomentarz() {
		$katalog = $_REQUEST['katalog'];
		$nazwaPlikuZdjecia = $_REQUEST['nazwaPlikuZdjecia'];
		$podpis = trim($_REQUEST['podpis']);
		$tresc = trim($_REQUEST['tresc']);
		$adresPowrotny = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']; // . "#" . $nazwaPlikuZdjecia;
		
		$zdjecie = new Zdjecie($katalog, $nazwaPlikuZdjecia);
		if ($podpis == "***opis***") {
			$wynik = $zdjecie->zapiszOpisZdjecia($tresc);
		} else {
			$wynik = $zdjecie->zapiszKomentarz(new Komentarz($podpis, $tresc));
		}
		switch ($wynik) {
			case 0:
				echo "OK doda³e¶ komentarz do zdjêcia. <a href='$adresPowrotny'>Powrót</a>";
				break;
			case 1:
				echo "OK doda³e¶ opis do zdjêcia. <a href='$adresPowrotny'>Powrót</a>";
				break;
			case 2:
				echo "Wygl±da na to, ¿e chcia³e¶ dodaæ pusty komentarz. Spróbuj jeszcze raz. <a href='$adresPowrotny'>Powrót</a>";
				break;
			case 3:
				echo "Wygl±da na to, ¿e dodawanie komentarzy chwilowo nie dzia³a. Mo¿e spróbuj pó¼niej?... <a href='$adresPowrotny'>Powrót</a>";
				break;
		}
	}
}
?>
