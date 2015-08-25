<?
class UstawieniaGaleriiZdjec
{
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

	/**
	 * Dane polaczenia bazy danych MySQL, w ktorej przechowywane sa informacje o galeriach lub komentarze.
	 */
    // TODO: podstaw dobre zmienne
	var $mysqlSerwer = "localhost";
	var $mysqlUzytkownik = "yourDbUser";
	var $mysqlHaslo = "yourConfidentialPassword9";
	var $mysqlNazwaBazy = "yourDbName";
	var $mysqlNazwaTabeliZGaleriami = "galeriaZdjec";
	var $mysqlNazwaTabeliZKomentarzami = "komentarzDoZdjecia";

//	/**
//	 * Prefiks dodawany do nazwy katalogu ze zdjeciami dla kazdej galerii.
//	 * Np. dla katalogu "051101 cmentarz" pelna sciezka brzmiec bedzie "images/051101 cmentarz".
//	 */
//	var $glownyKatalogZeZdjeciami = "images";

	/**
	 * Okresla, czy przy edycji galerii i przy wyswietlaniu listy galerii ma byc obslugiwany opis galerii, czy tylko tytul.
	 */
	var $obslugaPolaGaleriaZdjecOpis = false;

	/**
	 * Okresla, czy przy edycji galerii ma byc obslugiwane pole tabeli "galeriaZdjec.nowa".
	 */
	var $obslugaPolaGaleriaZdjecNowa = false;

	/**
	 * Okresla, czy przy edycji galerii ma byc obslugiwane pole tabeli "galeriaZdjec.prawieNowa".
	 */
	var $obslugaPolaGaleriaZdjecPrawieNowa = false;

	/**
	 * Okresla, czy klasa PrezentacjaGaleriiZdjec ma wyswietlac liste galerii, jesli nie jest wybrana zadna galeria.
	 */
	var $wyswietlajListeGalerii = true;

	/**
	 * Okresla, czy na liscie galerii ma sie pojawiac w nawiasie przy kazdej galerii ilosc zdjec w tej galerii.
	 */
	var $wyswietlanieIlosciZdjecWGalerii = false;

	var $linkDoGaleriiZdjec = "/~wlp.zgora/index.php?page=galeria";

}
?>