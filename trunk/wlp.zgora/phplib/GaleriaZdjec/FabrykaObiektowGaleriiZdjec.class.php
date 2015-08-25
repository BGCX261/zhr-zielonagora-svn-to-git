<?
include_once("Utilities/Logger.class.php");

/**
 * Zawiera metody statyczne tworzace obiekty klas galerii zdjec na podstawie ustawien.
 */
class FabrykaObiektowGaleriiZdjec
{
	/**
	 * Zwraca obiekt jednej z klas pochodnych klasy DaneGaleriiZdjec.
	 * 
	 * Zaleznie od sposobu przechowywania komentarzy, zwracany obiekt jest obiektem klasy:
	 * - "pliki" ZarzadcaKomentarzyZPliku
	 * - "mysql" ZarzadcaKomentarzyZBazyDanychMysql
	 * - inny    null
	 */
	function daneGaleriiZdjec() {
		$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();

		$daneGaleriiZdjec = null;
		
		switch ($ustawieniaGaleriiZdjec->sposobPrzechowywaniaInformacjiOGaleriach) {
			case "mysql":
				include_once("DaneGaleriiZdjecZBazyDanychMysql.class.php");
				$daneGaleriiZdjec = new DaneGaleriiZdjecZBazyDanychMysql($ustawieniaGaleriiZdjec->mysqlNazwaTabeliZGaleriami);
				break;
			case "pliki":
				Logger::logError("Przechowywanie informacji o galeriach zdjec w plikach nie jest zaimplementowane.");				
				$daneGaleriiZdjec = null;
				break;
			default:
				Logger::logError("Nieznany typ przechowywania informacji o galeriach zdjec: '" . $ustawieniaGaleriiZdjec->sposobPrzechowywaniaInformacjiOGaleriach . "'");				
				$daneGaleriiZdjec = null;
				break;
		}
		
		return $daneGaleriiZdjec;
	}
	
	/**
	 * Zwraca obiekt jednej z klas pochodnych klasy ZarzadcaKomentarzy.
	 * 
	 * Zaleznie od sposobu przechowywania komentarzy, zwracany obiekt jest obiektem klasy:
	 * - "pliki" ZarzadcaKomentarzyZPliku
	 * - "mysql" ZarzadcaKomentarzyZBazyDanychMysql
	 * - inny    null
	 */
	function daneKomentarzy() {
		$ustawieniaGaleriiZdjec = new UstawieniaGaleriiZdjec();
		
		$daneKomentarzy = null;
		
		switch ($ustawieniaGaleriiZdjec->domyslnySposobPrzechowywaniaKomentarzy) {
			case "mysql":
				include_once("DaneKomentarzyZBazyDanychMysql.class.php");
				$daneKomentarzy = new DaneKomentarzyZBazyDanychMysql($ustawieniaGaleriiZdjec->mysqlNazwaTabeliZKomentarzami);
				break;
			case "pliki":
				Logger::logError("Przechowywanie komentarzy do zdjec w plikach nie jest zaimplementowane.");				
				//include_once("DaneKomentarzyZPlikow.class.php");
				//$daneKomentarzy = new DaneKomentarzyZPlikow();
				break;
			default:
				Logger::logError("Nieznany typ przechowywania komentarzy: '" . $ustawieniaGaleriiZdjec->sposobPrzechowywaniaKomentarzy . "'");				
				break;
		}
		
		return $daneKomentarzy;
	}
}
?>
