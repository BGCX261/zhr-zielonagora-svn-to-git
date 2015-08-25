<?
class UstawieniaGaleriiZdjec
{
	/**
	 * Dane polaczenia bazy danych MySQL, w ktorej przechowywane sa informacje o galeriach lub komentarze.
	 */
	var $mysqlSerwer = "YOUR HOST";
	var $mysqlUzytkownik = "YOUR USER";
	var $mysqlHaslo = "YOUR PASS";
	var $mysqlNazwaBazy = "YOUR DB NAME";

//	/**
//	 * Prefiks dodawany do nazwy katalogu ze zdjeciami dla kazdej galerii.
//	 * Np. dla katalogu "051101 cmentarz" pelna sciezka brzmiec bedzie "images/051101 cmentarz".
//	 */
//	var $glownyKatalogZeZdjeciami = "images";
	/**
	 * Okresla sposob przechowywania informacji o galeriach zdjec.
	 * 
	 * Mozliwe wartosci:
	 * - "pliki" - Istnieje plik przechowujacy dane o wszystkich galeriach. NIEZAIMPLEMETOWANE.
	 * - "mysql" - Informacje sa przechowywanie w bazie danych MySQL.
	 */
	var $sposobPrzechowywaniaInformacjiOGaleriach = "mysql";
	
	/**
	 * Okresla domyslny sposob przechowywania komentarzy do zdjec. Wartosc wykorzystywana przy tworzeniu nowej galerii.
	 * 
	 * Mozliwe wartosci:
	 * - "pliki" - Istnieje plik przechowujacy dane o wszystkich galeriach.
	 * - "mysql" - Informacje sa przechowywanie w bazie danych MySQL.
	 */
	var $domyslnySposobPrzechowywaniaKomentarzy = "mysql";
}
?>
