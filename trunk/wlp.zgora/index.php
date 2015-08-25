<?
// **************************************************
//laczymy sie z baza danych
include("./db.inc.php");
db_connect();

// **************************************************
//sciezki do galerii
set_include_path("./phplib");

// **************************************************
//funkcje
include_once("./pages/functions.php");

// **************************************************
//jaka strona
$page = getPagePath($_REQUEST['page']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl">
    <head>
        <title>ZHR Zielona Góra - Związek Harcerstwa Rzeczypospolitej</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
        <meta http-equiv="Content-Language" content="pl" />
        <meta name="author" content="perk" />
        <meta name="keywords" content="skauting skaut zielona góra gora zgora harcerstwo zhr harcerze harcerki harcerski zwiazek związek harcerstwa rzeczypospolitej zbiórki zbiorki obozy hufiec drużyny dryzyny drużyna druzyna obwód obwod zielonogórski zielonogorski" />
        <meta name="description" content="Strona zielonogórskiego środowiska ZHR - Związku Harcerstwa Rzeczypospolitej" />
        <meta name="robots" content="index, follow" />
        <link rel="stylesheet" href="./glowny.css" type="text/css" />
        <link rel="alternate" type="application/rss+xml" title="aktualnosciRSS" href="rss.php" />
        <? if ($_REQUEST['page'] == "galeria") include("./pages/galeria.head.php"); ?>
        <script type="text/javascript">
          var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-20666097-1']); _gaq.push(['_trackPageview']);
          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
    </head>

    <body>
        <div class="body">
            <div class="logo"></div>
            <div class="topRight"></div>
            <div class="menuTop"></div>
            <div class="menuCenter"><? include("menulewe.inc.php"); ?></div>
            <div class="menuBottom"></div>
            <div class="menuBaner"><? include("menulewebaner.inc.php"); ?></div>

            <div class="tresc"><? require("./" . $page); ?></div>

            <div>
                <? if ($_SERVER["SERVER_NAME"] <> 'localhost') {require("./stat4u.inc.php");} ?>
                <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fzielonagora.zhr.pl%2F%3Fpage%3D<?= $_REQUEST['page'];?>">.</a>
            </div>
        </div>
    </body>
</html>

<?
//rozlaczamy sie z baza danych
db_close();
?>
