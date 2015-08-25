<?
include_once("GaleriaZdjec/DaneZBazyDanychMysql.class.php");
include_once("GaleriaZdjec/MysqlKomentarzDoZdjecia.class.php");

/**
 * Zawiera metody do pobierania i aktualizacji danych o galeriach zdjec i komentarzach.
 */
class DaneKomentarzyZBazyDanychMysql extends DaneZBazyDanychMysql
{
	var $nazwaTabeliZKomentarzami;
	
	function DaneKomentarzyZBazyDanychMysql($nazwaTabeliZKomentarzami) {
		$this->DaneZBazyDanychMysql();
		
		$this->nazwaTabeliZKomentarzami = $nazwaTabeliZKomentarzami;
	}

    /**
	 * Zwraca komentarze do zdjecia w postaci tablicy obiektow klasy Komentarz.
	 */
	function pobierzKomentarzeDlaZdjecia($zdjecie) {
		$mysqlKomentarzDoZdjecia = new MysqlKomentarzDoZdjecia($this->polaczenie, $this->nazwaTabeliZKomentarzami);
		
		return $mysqlKomentarzDoZdjecia->pobierzKomentarzeDlaZdjecia($zdjecie);
	}
	
	function pobierzOstatniKomentarz() {
		$mysqlKomentarzDoZdjecia = new MysqlKomentarzDoZdjecia($this->polaczenie, $this->nazwaTabeliZKomentarzami);
		
		return $mysqlKomentarzDoZdjecia->pobierzOstatniKomentarz();
	}

	/**
	 * Zapisuje komentarz do zdjecia.
	 * 
	 * @param $zdjecie Zdjecie Zdjecie, do ktorego odnosi sie komentarz.
	 * @param $komentarzDoZdjecia KomentarzDoZdjecia Dane komentarza, ktory nalezy zapisac.
	 * @return bool True, jesli zapisanie komentarza powiodlo sie.
	 */
	function zapiszKomentarz($zdjecie, $komentarzDoZdjecia) {
		$komentarzDoZdjecia->katalog = $zdjecie->katalog;
		$komentarzDoZdjecia->nazwaPlikuZdjecia = $zdjecie->nazwaPlikuZdjecia;
		$komentarzDoZdjecia->jestOpisem = false;
		
		$mysqlKomentarzDoZdjecia = new MysqlKomentarzDoZdjecia($this->polaczenie, $this->nazwaTabeliZKomentarzami);
		
		return $mysqlKomentarzDoZdjecia->dodaj($komentarzDoZdjecia);
	}

	/**
	 * Zapisuje opis zdjecia.
	 * 
	 * @param $zdjecie Zdjecie Zdjecie, do ktorego odnosi sie opis.
	 * @param $tresc String Tresc opisu.
	 * @return bool True, jesli zapisanie opisu powiodlo sie.
	 */
	function zapiszOpisZdjecia($zdjecie, $opis) {
		$komentarzDoZdjecia = new KomentarzDoZdjecia();
		$komentarzDoZdjecia->katalog = $zdjecie->katalog;
		$komentarzDoZdjecia->nazwaPlikuZdjecia = $zdjecie->nazwaPlikuZdjecia;
		$komentarzDoZdjecia->podpis = "";
		$komentarzDoZdjecia->tresc = $opis;
		$komentarzDoZdjecia->jestOpisem = true;

		$mysqlKomentarzDoZdjecia = new MysqlKomentarzDoZdjecia($this->polaczenie, $this->nazwaTabeliZKomentarzami);
		
		$mysqlKomentarzDoZdjecia->usunOpisyDlaZdjecia($zdjecie);
		
		return $mysqlKomentarzDoZdjecia->dodaj($komentarzDoZdjecia);
	}	
}
?>
