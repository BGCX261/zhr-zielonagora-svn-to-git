<?php
// **************************************************
//laczymy sie z baza danych
include("./db.inc.php");
db_connect();

echo '<?xml version="1.0" encoding="iso-8859-2" ?>' . "\n";
echo '<rss version="2.0">' . "\n";
echo '<channel>' . "\n";

$teraz = date(DATE_RFC822);

$aksdas = <<<KONIECSA
    <title>Zielonogórski Obwód ZHR - Aktualności</title>
    <link>http://zielonagora.zhr.pl</link>
    <description>zielonagora.zhr.pl/aktualnosci</description>
    <pubDate>$teraz</pubDate>
    <lastBuildDate>$teraz</lastBuildDate>

KONIECSA;

echo $aksdas;

$zapytanie = "SELECT * from `aktualnosci` where wyswietlany='tak' order by data desc LIMIT 10";

$odpowiedz = mysql_query($zapytanie) or die("Brak danych w bazie!");

while ( $wiersz = mysql_fetch_assoc($odpowiedz) ) {

    $data = $wiersz['data'];
    $tytul = stripslashes($wiersz['tytul_ogloszenia']);
    $tresc = stripslashes($wiersz['tresc_ogloszenia']);
    $autor = stripslashes($wiersz['autor']);

	$description = htmlspecialchars($tresc . "<br /><div align='right'><i>ogłosił(a): " . $autor . "</i></div>");

    $aktualnosc = <<<KONIEC
	<item>
            <title>$tytul</title>
            <link>http://zielonagora.zhr.pl/?page=aktualnosci&amp;kiedy=$data</link>
            <guid isPermaLink="false">http://zielonagora.zhr.pl/?page=aktualnosci</guid>
            <description>$description</description>
            <pubDate>$data</pubDate>
	</item>
KONIEC;

    echo $aktualnosc;

}

echo "</channel>";
echo "</rss>";
?>
