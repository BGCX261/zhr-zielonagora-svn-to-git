<?
/**
 * Zawiera statyczne metody do zapisywania loga (domyslnie na standardowe wyjscie).
 */
class Logger
{
	/**
	 * Wypisuje na standardowe wyjscie komunikat o bledzie MySQL.
	 * 
	 * @param $source string Miejsce w kodzie, gdzie wystapil blad, np. NazwaKlasy->nazwaMetody.
	 * @param $query string Zapytanie, ktorego wywolanie spowodowalo blad.
	 * @param $mysqlErrorMessage string Komunikat MySQL, zwrocony przez funkcje mysql_error().
	 */
	function logMysqlError($source, $query, $mysqlErrorMessage) {
		echo "<div class='loggerMysqlError'>Blad MySQL w $source.<br />\nZapytanie: '$query'.<br />\n$mysqlErrorMessage</div>\n";
	}

	/**
	 * Wypisuje na standardowe wyjscie komunikat.
	 * 
	 * @param $message string Komunikat, jaki ma byc wyswietlony. 
	 */
	function logInfo($message) {
		// echo "<div class='loggerInfo'>$message</div>\n";
	}

	function logError($message) {
		echo "<div class='loggerError'>$message</div>\n";
	}
}
?>
