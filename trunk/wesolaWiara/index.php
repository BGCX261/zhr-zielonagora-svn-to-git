<?
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Związek Harcerstwa Rzeczypospolitej :: Wesoła Wiara</title>
        <meta http-equiv="Content-Language" content="pl" />
        <meta name="author" content="perk" />
        <meta name="keywords" content="skauting skaut zielona góra gora zgora harcerstwo zhr harcerze harcerki harcerski zwiazek związek harcerstwa rzeczypospolitej wesola wiara" />
        <meta name="description" content="Strona jubileuszowa szczepu Wesoła Wiara z Zielonej Góry - Związku Harcerstwa Rzeczypospolitej" />
        <meta name="robots" content="index, follow" />
        <script type="text/javascript" src="./lib/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="./lib/fancybox/jquery.fancybox-1.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="./lib/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
        <link rel="stylesheet" href="./glowny.css" type="text/css" />
        <script type="text/javascript" >
            $(document).ready(function() {
                $("a#stareFoty").fancybox({
                    'hideOnContentClick':       true,
                    'transitionIn'	:	'fade',
                    'transitionOut'	:	'fade',
                    'speedIn'		:	200,
                    'speedOut'		:	200   
                });
            });
        </script>
    </head>
    <body>
        <div class="body">
            <div>
                <a class="menuRocznica" href="./?page=rocznica"></a>
                <a class="menuForum" href="./forum"></a>
                <a class="menuKontakt" href="./?page=kontakt"></a>
            </div>
            <div class="tresc"><? require("./" . $page); ?></div>
            <div class="stopka"><? require("./stopka.php"); ?></div>
        </div>
    </body>
</html>