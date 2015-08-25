<?php
require_once("ZarzadcaKomentarzy.class.php");
require_once("ZarzadcaGaleriiZdjec.class.php");

class ZarzadcaKomentarzyZBazyDanychMysql extends ZarzadcaKomentarzy
{
	function ZarzadcaKomentarzyZBazyDanychMysql($zdjecie) {
		// Wywolanie konstruktora klasy bazowej.
		$this->ZarzadcaKomentarzy($zdjecie);
	}
    
	/**
	 * Zwraca komentarze do zdjecia w postaci tablicy obiektow klasy Komentarz.
	 */
	function pobierzKomentarze() {
		$komentarze = array();

		$bazaDanych = ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql();
		$katalog = $this->zdjecie->katalog;
		$nazwaPlikuZdjecia = $this->zdjecie->nazwaPlikuZdjecia;
		$zapytanie = "SELECT podpis, tresc, jestOpisem, data FROM komentarzDoZdjecia WHERE katalog = '$katalog' AND nazwaPlikuZdjecia = '$nazwaPlikuZdjecia'";
		$wynik = mysql_query($zapytanie, $bazaDanych);
		if (!$wynik) {
			echo "Blad MySQL w ZarzadcaKomentarzyZBazyDanychMysql::pobierzKomentarze.<br />Zapytanie '$zapytanie'<br />" . mysql_error($bazaDanych);
		} else {
			while ($komentarz = mysql_fetch_object($wynik)) {
				$komentarze[] = $komentarz;
			}
		}
		
		return $komentarze;
	}

	/**
	 * Metoda statyczna. Pobiera ostatnie $iloscKomentarzy dodanych komentarzy.
	 */
	function pobierzNajnowszeKomentarze($iloscKomentarzy = 1) {
		$komentarze = array();

		$bazaDanych = ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql();
		$zapytanie = "SELECT katalog, nazwaPlikuZdjecia, podpis, tresc, data FROM komentarzDoZdjecia WHERE jestOpisem = 0 AND wyswietlany = 1 ORDER BY numerKomentarza DESC LIMIT $iloscKomentarzy";
		$wynik = mysql_query($zapytanie, $bazaDanych);
		if (!$wynik) {
			echo "Blad MySQL w ZarzadcaKomentarzyZBazyDanychMysql::pobierzNajnowszeKomentarze.<br />Zapytanie '$zapytanie'<br />" . mysql_error($bazaDanych);
		} else {
			while ($komentarz = mysql_fetch_object($wynik)) {
				$komentarze[] = $komentarz;
			}
		}
		
		return $komentarze;
	}

	/**
	 * Metoda statyczna. Pobiera ostatni dodany komentarz.
	 */
	function pobierzOstatniKomentarz() {
		return pobierzNajnowszeKomentarze(1);
	}
	
	function zapiszKomentarz($komentarz) {
		$katalog = $this->zdjecie->katalog;
		$nazwaPlikuZdjecia = $this->zdjecie->nazwaPlikuZdjecia;
		$podpis = $komentarz->podpis;
		$tresc = $komentarz->tresc;
		
		$bazaDanych = ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql();
		$zapytanie = "INSERT INTO komentarzDoZdjecia (katalog, nazwaPlikuZdjecia, podpis, tresc, data) VALUES ('$katalog', '$nazwaPlikuZdjecia', '$podpis', '$tresc', NOW())";
		$wynik = mysql_query($zapytanie, $bazaDanych);
		if (!$wynik) {
			echo "Blad MySQL w ZarzadcaKomentarzyZBazyDanychMysql::zapiszKomentarz.<br />\nZapytanie: '$zapytanie'.<br />\n" . mysql_error($bazaDanych);
			return 1;
		} else {
			return 0;
		}
	}
	
	function zapiszOpisZdjecia($tresc) {
		$katalog = $this->zdjecie->katalog;
		$nazwaPlikuZdjecia = $this->zdjecie->nazwaPlikuZdjecia;
		
		$bazaDanych = ZarzadcaGaleriiZdjec::pobierzPolaczenieZBazaDanychMysql();
		$zapytanie = "DELETE FROM komentarzDoZdjecia WHERE jestOpisem = 't' AND katalog = '$katalog' AND nazwaPlikuZdjecia = '$nazwaPlikuZdjecia'";
		$wynik = mysql_query($zapytanie, $bazaDanych);
		if (!$wynik) {
			echo "Blad MySQL w ZarzadcaKomentarzyZBazyDanychMysql::zapiszOpis.<br />\nZapytanie: '$zapytanie'.<br />\n" . mysql_error($bazaDanych);
			return 1;
		}
		$zapytanie = "INSERT INTO komentarzDoZdjecia (katalog, nazwaPlikuZdjecia, podpis, tresc, jestOpisem, data) VALUES ('$katalog', '$nazwaPlikuZdjecia', '$podpis', '$tresc', 't', NOW())";
		$wynik = mysql_query($zapytanie, $bazaDanych);
		if (!$wynik) {
			echo "Blad MySQL w ZarzadcaKomentarzyZBazyDanychMysql::zapiszOpis.<br />\nZapytanie: '$zapytanie'.<br />\n" . mysql_error($bazaDanych);
			return 1;
		} else {
			return 0;
		}
	}
}
?>
