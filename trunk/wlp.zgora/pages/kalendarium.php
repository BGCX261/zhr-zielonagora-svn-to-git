<?
$zapytanie = "SELECT * from `kalendarium` where wyswietlany='tak' order by data desc";

$odpowiedz = mysql_query($zapytanie) or die("Brak danych w bazie!");

while ($wiersz = mysql_fetch_assoc($odpowiedz)) {

    $data = $wiersz['data'];
    $tytul = stripslashes($wiersz['tytul_ogloszenia']);
    $tresc = stripslashes($wiersz['tresc_ogloszenia']);
    $autor = stripslashes($wiersz['autor']);

    //dodaj <br/>-ki do stringu $tresc
    $tresc = implode("<br/>\n", explode("\n", $tresc));

    $wydarzenie = <<<KONIEC
	<br />
	<b>$data: <i>$tytul</i></b><br/>
	<div style="text-align: justify;">$tresc</div>
	<div style="text-align: right; font-style: italic;">og�osi�(a): $autor</div><br/>
	<hr />
KONIEC;

    echo $wydarzenie;
}
?>

<!--
<p><b>Harcerski Festiwal Piosenki "Chlipak" (06.01.2007)</b></p>
<p>1 miejsce w kategorii "piosenka ze �wiata Walta Disney'a - zast�p Li�cie z 31 DH "R�e"<br/>
1 miejsce w kategorii "piosenka obcoj�zyczna" - zast�p Kazulo i Orion z 45 �DH "Wigry"</p>
<hr>

<p><b>Harcerska Akcja Zimowa (13.01-28.01.07) </b></p>
<p>
<pre>
Pierwszy tydzie�:

9 ZDH "Dukt-Zawisza" - 15 os�b, 7 dni
30 DH "Orl�ta" - 9 os�b, 5 dni
31 DH "Paj�ki" - 28 os�b, 5 dni
31 DH "R�e" -18 os�b, 5 dni
patrol Konary - 6 os�b
patrol Trop - 0 (s�ownie: zero)

ZHH-ek "Narnia" - kurs pwd - 8 os�b, 6 dni

Drugi tydzie�:

1 KDH "Port" - 4 osoby, 4 dni
30 DW "Orl�ta" - 12 os�b, 4 dni
45 DH "Wigry" - 6 os�b, 5 dni
45 �DH "Wigry" - 11 os�b, 4 dni
45 �DW "Wigry" - 7 os�b, 4 dni

</pre>
</p>
<hr>

<p><b>Reprezentacja na op�atku wigilijnym Lubuskiej Rodziny Katy�skiej (13.01.2007)</b></p>
<p>Reprezentacja obwodu: dh Nadzieja wraz z Zuzi�</p>
<hr>

<p><b>Op�atek harcerski u Ksi�dza Biskupa (21.01.2007)</b></p>
<p>Nasz obw�d reprezentowali �e�ek, Nadzieja, Zuza, ojciec Zdzis�aw i Lechu.</p>
<hr>

<p><b>Bal karnawa�owy obwodu (22.01.2007)</b></p>
<p>22 stycznia odby� si� bal karnawa�owy obwodu (tematyka balu - �wiat Walta Disneya). Pozdrowienia od Goofiego ;)</p>
<hr>

<p><b>Spotkanie Sprawozdawcze (04.02.2007)</b></p>
<p>4 lutego odby�o si� spotkanie sprawozdawcze z dzia�a� obwodu dla wszystkich funkcyjnych naszego obwodu.</p>

<br>
<br>

-->


<div style="text-align: right; font-size: small; font-style: italic;">
    nabazgra�<br />
    <?= getWebmaster(); ?>, <? echo date("d.m.Y", filemtime($page)) ?>
</div>