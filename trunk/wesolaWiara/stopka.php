<?
$stopka = '<a href="http://www.zhr.pl">www.zhr.pl</a>&nbsp;&nbsp;|&nbsp;&nbsp;' .
          '<a href="http://www.zgora.zhr.pl">www.zgora.zhr.pl</a>&nbsp;&nbsp;|&nbsp;&nbsp;' .
          'Grafika: phm. Paweł Sulatycki "Łełek"&nbsp;&nbsp;|&nbsp;&nbsp;' .
          'Webmaster: pwd. Marcin Stożek "Perk"&nbsp;&nbsp;|&nbsp;&nbsp;' .
          'Zielona Góra, ' . date( "d.m.Y" , filemtime($_SERVER["SCRIPT_FILENAME"]));

echo $stopka;
?>