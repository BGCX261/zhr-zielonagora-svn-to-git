<?
require_once("MysqlGaleriaZdjec.class.php");
/**
 * Zawiera metody do pobierania i aktualizacji danych o galeriach zdjec i komentarzach.
 */
class DaneGaleriiZdjec
{
	var $polaczenie;
	
	function DaneGaleriiZdjec($polaczenie) {
		$this->polaczenie = $polaczenie; 
	}
	
	function pobierzWszystkieGalerie() {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie);
    	return $mysqlGaleriaZdjec->pobierzWszystkie();
	}
	
	function pobierzGalerie($katalog) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie);
    return $mysqlGaleriaZdjec->pobierz($katalog);
	}

	function dodajGalerie($galeriaZdjec) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie);
		return $mysqlGaleriaZdjec->dodaj($galeriaZdjec);
	}
	
	function aktualizujGalerie($katalog, $galeriaZdjec) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie);
		return $mysqlGaleriaZdjec->aktualizuj($katalog, $galeriaZdjec);
	}

	function usunGalerie($katalog) {
		$mysqlGaleriaZdjec = new MysqlGaleriaZdjec($this->polaczenie);
		return $mysqlGaleriaZdjec->usun($katalog);
	}
}
?>
