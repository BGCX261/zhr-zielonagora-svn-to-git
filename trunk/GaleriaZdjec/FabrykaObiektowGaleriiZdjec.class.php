<?
/**
 * Zawiera metody statyczne tworzace obiekty klas galerii zdjec.
 */
class FabrykaObiektowGaleriiZdjec
{
	/**
	 * Zwraca obiekt jednej z klas pochodnych klasy ZarzadcaKomentarzy.
	 * 
	 * Zaleznie od sposobu przechowywania komentarzy, zwracany obiekt jest obiektem klasy:
	 * - "pliki" ZarzadcaKomentarzyZPliku
	 * - "mysql" ZarzadcaKomentarzyZBazyDanychMysql
	 * - inny    null
	 */
	function zarzadcaKomentarzy($zdjecie, $sposobPrzechowywaniaKomentarzy) {
		$zarzadcaKomentarzy = null;
		
		switch ($sposobPrzechowywaniaKomentarzy) {
			case "pliki":
				$zarzadcaKomentarzy = new ZarzadcaKomentarzyZPliku($zdjecie);
				break;
			case "mysql":
				//echo "Przechowywanie komentarzy w bazie danych MySQL nie jest zaimplementowane.";
				$zarzadcaKomentarzy = new ZarzadcaKomentarzyZBazyDanychMysql($zdjecie); 
				break;
			default:
				echo "Nieznany typ przechowywania komentarzy: '$sposobPrzechowywaniaKomentarzy'";
				break;
		}
		
		return $zarzadcaKomentarzy;
	}
}
?>
