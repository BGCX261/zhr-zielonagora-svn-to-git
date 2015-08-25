<?php
require_once("GaleriaZdjec.class.php");
require_once("Komentarz.class.php");
require_once("PrezentacjaZdjecia.class.php");
require_once("UstawieniaGaleriiZdjec.class.php");
require_once("ZarzadcaGaleriiZdjec.class.php");
require_once("ZarzadcaKomentarzyZPliku.class.php");
require_once("rodzajLiczbyMnogiej.function.php");

class PrezentacjaGaleriiZdjec
{
	var $galeriaZdjec;
	var $trybDzialaniaGalerii;
	var $czyTrybListaGalerii;
	var $czyTrybZapisKomentarza;
	var $czyTrybWyswietlenieGalerii;
	
	/**
	 * Tworzy nowy obiekt i inicjalizuje zmienne skladowe. - tryb dzialania galerii 
	 * i aktualna galeria zdjec (jesli jest okreslona). 
	 */
    function PrezentacjaGaleriiZdjec() {
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
			$href = $_SERVER['PHP_SELF'] . "?katalog=" . $galeriaZdjec->katalog;
			$tytul = $galeriaZdjec->tytulGalerii;
			$opis = $galeriaZdjec->opisGalerii;
			$iloscZdjec = ZarzadcaGaleriiZdjec::pobierzIloscZdjecWKatalogu($galeriaZdjec->katalog);
			$formaRzeczownikaZdjecia = rodzajLiczbyMnogiej($iloscZdjec, "zdjêcie", "zdjêcia", "zdjêæ");
			
			echo "<a href=\"$href\">$tytul</a> - $opis ($iloscZdjec $formaRzeczownikaZdjecia)<br />";
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

//		$galeriaZdjec = new GaleriaZdjec($katalog, $odZdjecia, $doZdjecia);
		$galeriaZdjec = ZarzadcaGaleriiZdjec::pobierzGalerie($katalog);
		
		echo '<table width="100%" cellpadding="0" cellspacing="0">';
		foreach (ZarzadcaGaleriiZdjec::pobierzZdjeciaGalerii($galeriaZdjec) as $zdjecie) {
			$prezentacjaZdjecia = new PrezentacjaZdjecia($zdjecie);
			echo '<tr>';
			echo '<td valign="top" align="center"><a name="'.$zdjecie->nazwaPlikuZdjecia.'"></a>'.$prezentacjaZdjecia->zdjecieImg.'</td>';
			echo '<td width="8">&nbsp;</td>';
			echo '<td valign="top" align="left">'.$prezentacjaZdjecia->dodawanieKomentarza.$prezentacjaZdjecia->komentarze.'</td>';
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
				$this->wyswietlListeGalerii();
				break;
			case "ZapisKomentarza":
				$komentarz = new Komentarz($_REQUEST['podpis'], $_REQUEST['tresc']);
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
	 * Sprawdza, jakie zmienne istnieja w obiekcie  $_REQUEST, i na tej podstawie okresla tryb dzialania galerii.
	 */
	function zdefiniujTrybDzialaniaGalerii() {
		if (!isset($_REQUEST['katalog'])) {
			// Nie podano katalogu do wyswietlenia, wiec wyswietlimy liste wszystkich galerii.
			$this->trybDzialaniaGalerii = "ListaGalerii";
		} else if (isset($_REQUEST['nazwaPlikuZdjecia'])) {
			// Podano katalog oraz nazwe pliku, wiec zapiszemy komentarz.
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
