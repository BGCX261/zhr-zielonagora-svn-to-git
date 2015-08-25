<?
require_once(".htdb2.inc.php");
/**
 * Zawiera metody do obslugi polaczenia z baza danych MySQL.
 */
class DaneZBazyDanychMysql
{
	var $polaczenie;

	/**
	 * Tworzy polaczenie z baza danych.
	 */
	function DaneZBazyDanychMysql() {
		$this->polaczenie = $this->utworzPolaczenieMysql();

		if (!$this->polaczenie) {
			echo "nie ma po³±czenia";
		}
	}

	/**
	 * Tworzy polaczenie z baza danych MySQL i zwraca 'resource', przydatny jako drugi argument
	 * w funkcji mysql_query.
	 */
	function utworzPolaczenieMysql() {
		return getDbConnection();
	}
}
?>
