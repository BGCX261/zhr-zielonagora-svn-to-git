<?
include_once("GaleriaZdjec/ZarzadcaKomentarzy.class.php");
include_once("GaleriaZdjec/KomentarzDoZdjecia.class.php");
include_once("GaleriaZdjec/Zdjecie.class.php");

/**
 * U³atwia wyœwietlanie obiektu Zdjecie na stronie HTML.
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
		
		$this->zdjecieImg = '<img src="'.$this->zdjecie->sciezkaDoPliku().'" />';
		$this->komentarze = $this->ubierzKomentarzeWHtml(ZarzadcaKomentarzy::pobierzKomentarze($zdjecie));
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
			// Zmienna $komentarze jest tablic¹ obiektow KomentarzDoZdjecia.
			foreach ($komentarze as $komentarzDoZdjecia) {
				if ($komentarzDoZdjecia->jestOpisem) {
					$html = "<span class=\"opis\">" . $komentarzDoZdjecia->tresc . "</span><br /><br />" . $html;
				} else {
					$html = $html . "<span class=\"komentarz\">" . $komentarzDoZdjecia->tresc . "</span>" . " " . "<span class=\"podpis\">[" . $komentarzDoZdjecia->podpis . "]</span><br />";
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
		$inputKomentarz = '<input name="tresc" value="" class="okienkoKomentarz" />';
		$inputPodpis = '<input name="podpis" value="" class="okienkoPodpis" />';
		$przyciskDodajKomentarz = '<input type="submit" value="Wyœlij" class="przyciskDodajKomentarz" />';
		$przyciskKasuj = '<input type="reset" value="Kasuj" class="przyciskKasujKomentarz" />';
		$formularzPoczatek = '';
		$formularzKoniec = '</form>';
		
		// Uloz elementy panelu.
		$html = "<div style=\"float: right;\">" .
				"<form action=\"$formAction\" method=\"post\">\n" .
				"$hiddenNazwaPlikuZdjecia\n" .
				"<table cellpadding=\"0\" cellspacing=\"1\" border=\"0\">" .
				"<tr><td style=\"text-align: left\" class=\"napisKomentarz\">komentarz:&nbsp;$inputKomentarz</td></tr>\n" .
				"<tr><td style=\"text-align: left\" class=\"napisPodpis\">podpis:&nbsp;$inputPodpis</td></tr>\n" .
				"<tr><td style=\"text-align: left\">$przyciskDodajKomentarz&nbsp;$przyciskKasuj</td></tr>\n" .
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
		$adresPowrotny = $_SERVER['REQUEST_URI'];
		
		$zdjecie = new Zdjecie($katalog, $nazwaPlikuZdjecia);
		
		if ($tresc != null) {
			if ($podpis == "***opis***") {
				if (ZarzadcaKomentarzy::zapiszOpisZdjecia($zdjecie, $tresc)) {
					echo "OK, komentarz zosta³ zapisany. <a href='$adresPowrotny'>Dalej</a>";
				} else {
					echo "Niestety, nie uda³o siê dodaæ komentarza. <a href='$adresPowrotny'>Dalej</a>";
				}
			} else {
				if (ZarzadcaKomentarzy::zapiszKomentarz($zdjecie, new KomentarzDoZdjecia($podpis, $tresc))) {
					echo "OK, opis zosta³ zapisany. <a href='$adresPowrotny'>Dalej</a>";
				} else {
					echo "Niestety, nie uda³o siê dodaæ opisu. <a href='$adresPowrotny'>Dalej</a>";
				}
			}
		} else {
			echo "Komentarz jest pusty. Spróbuj jeszcze raz. <a href='$adresPowrotny'>Dalej</a>";
		}
	}
}
?>
