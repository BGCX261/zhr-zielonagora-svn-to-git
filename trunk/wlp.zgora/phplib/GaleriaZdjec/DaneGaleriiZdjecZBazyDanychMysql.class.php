<?
include_once("GaleriaZdjec/DaneZBazyDanychMysql.class.php");
include_once("GaleriaZdjec/MysqlGaleriaZdjec.class.php");

/**
 * Zawiera metody do pobierania i aktualizacji danych o galeriach zdjec i komentarzach.
 */
class DaneGaleriiZdjecZBazyDanychMysql extends DaneZBazyDanychMysql
{
	var $nazwaTabeliZGaleriami;
	
	function DaneGaleriiZdjecZBazyDanychMysql($mysqlNazwaTabeliZGaleriami) {
		$this->DaneZBazyDanychMysql();
		
		$this->nazwaTabeliZGaleriami = $mysqlNazwaTabeliZGaleriami;
	}
	
	function pobierzWszystkieGalerie() {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie, $this->nazwaTabeliZGaleriami);
    	return $mysqlGaleriaZdjec->pobierzWszystkie();
	}
	
	function pobierzGalerie($katalog) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie, $this->nazwaTabeliZGaleriami);
    	return $mysqlGaleriaZdjec->pobierz($katalog);
	}

    function dodajGalerie($galeriaZdjec) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie, $this->nazwaTabeliZGaleriami);
		return $mysqlGaleriaZdjec->dodaj($galeriaZdjec);
    }
	
	function aktualizujGalerie($katalog, $galeriaZdjec) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie, $this->nazwaTabeliZGaleriami);
		return $mysqlGaleriaZdjec->aktualizuj($katalog, $galeriaZdjec);
	}

    function usunGalerie($katalog) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie, $this->nazwaTabeliZGaleriami);
		return $mysqlGaleriaZdjec->usun($katalog);
    }
}
?>
