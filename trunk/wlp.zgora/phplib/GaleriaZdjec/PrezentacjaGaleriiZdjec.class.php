<?
include_once("GaleriaZdjec/PrezentacjaZdjecia.class.php");
include_once("GaleriaZdjec/UstawieniaGaleriiZdjec.class.php");
include_once("GaleriaZdjec/ZarzadcaGaleriiZdjec.class.php");
include_once("GaleriaZdjec/ZarzadcaKomentarzy.class.php");
include_once("Utilities/rodzajLiczbyMnogiej.function.php");
include_once("PEAR/Net_URL.class.php");

class PrezentacjaGaleriiZdjec
{
	var $galeriaZdjec;
	var $trybDzialaniaGalerii;
	var $czyTrybListaGalerii;
	var $czyTrybZapisKomentarza;
	var $czyTrybWyswietlenieGalerii;
	var $ustawieniaGaleriiZdjec;

	/**
	 * Tworzy nowy obiekt i inicjalizuje zmienne skladowe. - tryb dzialania galerii
	 * i aktualna galeria zdjec (jesli jest okreslona).
	 */
    function PrezentacjaGaleriiZdjec() {
		$this->ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();
    	$this->zdefiniujTrybDzialaniaGalerii();
    	if (isset($_REQUEST['katalog'])) {
    		$this->galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($_REQUEST['katalog']);
    	}
    }

    /**
     * Zwraca tytul aktualnej galerii.
     */
    function pobierzTytulGalerii() {
    	return $this->galeriaZdjec->tytulGalerii;
    }

    /**
     * Wyswietla liste wszystkich dostepnych galerii.
     */
	function wyswietlListeGalerii() {
		$listaGaleriiZdjec = ZarzadcaGaleriiZdjec::pobierzWszystkieGalerie();

		foreach ($listaGaleriiZdjec as $galeriaZdjec) {
			//$href = $_SERVER['PHP_SELF'] . "?katalog=" . $galeriaZdjec->katalog;
			$href = $_SERVER['PHP_SELF'];
			if (strlen($_SERVER["QUERY_STRING"]) > 0) {
				$href .= "?" . $_SERVER["QUERY_STRING"] . "&amp;";
			} else {
				$href .= "?";
			}
			$href .= "katalog=" . urlencode($galeriaZdjec->katalog);

			$tytul = $galeriaZdjec->tytulGalerii;

			$czescZOpisem = "";
			if ($this->ustawieniaGaleriiZdjec->obslugaPolaGaleriaZdjecOpis) {
				$opis = $galeriaZdjec->opisGalerii == null ? $galeriaZdjec->tytulGalerii : $galeriaZdjec->opisGalerii;
				$czescZOpisem = "<span class=\"opis\"> - $opis</span>";
			}

			$czescZIlosciaZdjec = "";
			if ($this->ustawieniaGaleriiZdjec->wyswietlanieIlosciZdjecWGalerii) {
				$iloscZdjec = ZarzadcaGaleriiZdjec::pobierzIloscZdjecWKatalogu($galeriaZdjec->katalog);
				$formaRzeczownikaZdjecia = rodzajLiczbyMnogiej($iloscZdjec, "zdjêcie", "zdjêcia", "zdjêæ");
				$czescZIlosciaZdjec = " <span class=\"iloscZdjec\">($iloscZdjec $formaRzeczownikaZdjecia)</span>";
			}

			echo "<span class=\"galeriaZdjec\"><a href=\"$href\">$tytul</a>$czescZOpisem$czescZIlosciaZdjec</span>\n";
		}
	}

	/**
	 * Zapisuje komentarz do zdjecia i wyswietla komunikat.
	 */
	function wyswietlZapisKomentarza($katalog, $nazwaPlikuZdjecia, $komentarz) {
		PrezentacjaZdjecia::zapiszKomentarz();
	}

	/**
	 * Pobiera wszystkie zdjecia dla okreslonej galerii i wyswiela je w tabeli razem z komentarzami.
	 */
	function wyswietlGalerie($katalog) {
//		$odZdjecia = $_REQUEST['odZdjecia'];
//		$doZdjecia = $_REQUEST['doZdjecia'];

		$galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($katalog);
		echo "<h1>" . $galeriaZdjec->tytulGalerii . "</h1>\n";
		echo '<table width="100%">';
		foreach (ZarzadcaGaleriiZdjec::pobierzZdjeciaZKatalogu($katalog) as $zdjecie) {
			$prezentacjaZdjecia = new PrezentacjaZdjecia($zdjecie);
			echo '<tr>';
			echo '<td valign="top">'.$prezentacjaZdjecia->zdjecieImg.'</td>';
//			echo '<td valign="top" align="left">'.$prezentacjaZdjecia->komentarze.$prezentacjaZdjecia->dodawanieKomentarza.'</td>';
			echo '</tr>';
		}
		echo "</table>";
	}

	/**
	 * Glowna metoda klasy - wyswietla odpowiedni kod zaleznie od trybu dzialania galerii.
	 *
	 * Zaleznie od trybu dzialania galerii wywoluje jedna z metod wyswietlListeGalerii,
	 * wyswietlZapisKomentarza, wyswietlGalerie.
	 */
	function wyswietl() {
		switch ($this->trybDzialaniaGalerii) {
			case "ListaGalerii":
				if ($this->ustawieniaGaleriiZdjec->wyswietlajListeGalerii) {
					$this->wyswietlListeGalerii();
				}
				break;
			case "ZapisKomentarza":
				$komentarz = new KomentarzDoZdjecia($_REQUEST['podpis'], $_REQUEST['tresc']);
				$this->wyswietlZapisKomentarza($_REQUEST['katalog'], $_REQUEST['nazwaPlikuZdjecia'], $komentarz);
				break;
			case "WyswietlenieGalerii":
				$this->wyswietlGalerie($_REQUEST['katalog']);
				break;
			default:
				echo "Blad w PrezentacjaGaleriiZdjec::wyswietl. Nieznany tryb dzialania galerii '" . $this->trybDzialaniaGalerii . "'";
				break;
		}
	}

	/**
	 *
	 * @static
	 */
	function wyswietlOstatniKomentarz() {
		$ostatniKomentarz = ZarzadcaKomentarzy::pobierzOstatniKomentarz();
		$galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($ostatniKomentarz->katalog);

		$tytulGalerii = "";
		if ($galeriaZdjec != null) {
			$tytulGalerii = $galeriaZdjec->tytulGalerii;
		}
		$podpis = $ostatniKomentarz->podpis;
		$tresc = $ostatniKomentarz->tresc;

		$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();
		$url = new Net_URL($ustawieniaGaleriiZdjec->linkDoGaleriiZdjec, false);
		$url->addQueryString("katalog", $ostatniKomentarz->katalog);
		$url->anchor = $ostatniKomentarz->nazwaPlikuZdjecia;

		if ($tresc != null && $tresc != "") {
			echo "<span class=\"ostatniKomentarz\"><a href=\"" . $url->getURL() . "\" title=\"$tytulGalerii\"><b>[$podpis]</b> $tresc</a></span>";
		}
	}

	/**
	 * Sprawdza, jakie zmienne istnieja w obiekcie  $_REQUEST, i na tej podstawie okresla tryb dzialania galerii.
	 */
	function zdefiniujTrybDzialaniaGalerii() {
		if (!isset($_REQUEST['katalog'])) {
			// Nie podano identyfikatora galerii do wyswietlenia, wiec wyswietlimy liste wszystkich galerii.
			$this->trybDzialaniaGalerii = "ListaGalerii";
		} else if (isset($_REQUEST['nazwaPlikuZdjecia'])) {
			// Podano identyfikator galerii oraz nazwe pliku, wiec zapiszemy komentarz.
			$this->trybDzialaniaGalerii = "ZapisKomentarza";
		} else {
			$this->trybDzialaniaGalerii = "WyswietlenieGalerii";
		}

		$this->czyTrybListaGalerii = ($this->trybDzialaniaGalerii == "ListaGalerii");
		$this->czyTrybZapisKomentarza = ($this->trybDzialaniaGalerii == "ZapisKomentarza");
		$this->czyTrybWyswietlenieGalerii = ($this->trybDzialaniaGalerii == "WyswietlenieGalerii");
	}
}
?>