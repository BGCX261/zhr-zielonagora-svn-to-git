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
	<div style="text-align: right; font-style: italic;">og³osi³(a): $autor</div><br/>
	<hr />
KONIEC;

    echo $wydarzenie;
}
?>

<!--
<p><b>Harcerski Festiwal Piosenki "Chlipak" (06.01.2007)</b></p>
<p>1 miejsce w kategorii "piosenka ze ¶wiata Walta Disney'a - zastêp Li¶cie z 31 DH "Ró¿e"<br/>
1 miejsce w kategorii "piosenka obcojêzyczna" - zastêp Kazulo i Orion z 45 ¯DH "Wigry"</p>
<hr>

<p><b>Harcerska Akcja Zimowa (13.01-28.01.07) </b></p>
<p>
<pre>
Pierwszy tydzieñ:

9 ZDH "Dukt-Zawisza" - 15 osób, 7 dni
30 DH "Orlêta" - 9 osób, 5 dni
31 DH "Paj±ki" - 28 osób, 5 dni
31 DH "Ró¿e" -18 osób, 5 dni
patrol Konary - 6 osób
patrol Trop - 0 (s³ownie: zero)

ZHH-ek "Narnia" - kurs pwd - 8 osób, 6 dni

Drugi tydzieñ:

1 KDH "Port" - 4 osoby, 4 dni
30 DW "Orlêta" - 12 osób, 4 dni
45 DH "Wigry" - 6 osób, 5 dni
45 ¯DH "Wigry" - 11 osób, 4 dni
45 ¯DW "Wigry" - 7 osób, 4 dni

</pre>
</p>
<hr>

<p><b>Reprezentacja na op³atku wigilijnym Lubuskiej Rodziny Katyñskiej (13.01.2007)</b></p>
<p>Reprezentacja obwodu: dh Nadzieja wraz z Zuzi±</p>
<hr>

<p><b>Op³atek harcerski u Ksiêdza Biskupa (21.01.2007)</b></p>
<p>Nasz obwód reprezentowali £e³ek, Nadzieja, Zuza, ojciec Zdzis³aw i Lechu.</p>
<hr>

<p><b>Bal karnawa³owy obwodu (22.01.2007)</b></p>
<p>22 stycznia odby³ siê bal karnawa³owy obwodu (tematyka balu - ¶wiat Walta Disneya). Pozdrowienia od Goofiego ;)</p>
<hr>

<p><b>Spotkanie Sprawozdawcze (04.02.2007)</b></p>
<p>4 lutego odby³o siê spotkanie sprawozdawcze z dzia³añ obwodu dla wszystkich funkcyjnych naszego obwodu.</p>

<br>
<br>

-->


<div style="text-align: right; font-size: small; font-style: italic;">
    nabazgra³<br />
    <?= getWebmaster(); ?>, <? echo date("d.m.Y", filemtime($page)) ?>
</div>