<?

if(!function_exists("getmicrotime")) {
    function getmicrotime() {
        list($usec, $sec) = explode(" ",microtime());
        return ((float)$usec + (float)$sec);
    }
}

$TIME=getmicrotime();

if(!function_exists("scandir")) {
    function scandir($dirstr) {
        $files = array();
        $fh = opendir($dirstr);

        while (false !== ($filename = readdir($fh))) array_push($files, $filename);

        closedir($fh);
        sort($files);

        return $files;
    }
}

if(!function_exists("whatbrowser")) {
    function whatbrowser() {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko')) {
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
            return 1; //$browser = 'Netscape (Gecko/Netscape)';
            elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
            return 1;  //$browser = 'Mozilla Firefox (Gecko/Firefox)';
            else
            return 1; //$browser = 'Mozilla (Gecko/Mozilla)';
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
            return 1; //$browser = 'Opera (MSIE/Opera/Compatible)';
            else
            return 0; //$browser = 'Internet Explorer (MSIE/Compatible)';
        } else
        return 1; //$browser = 'Others browsers';
    }
}

if(!function_exists("getPagePath")) {
    function getPagePath($pageName) {
        $pagePath = 'pages/';
        $fileName = '';
        
        switch ($pageName) {
            case '1procent':
                $fileName = '1procent.php';
                break;
            case 'aktualnosci':
                $fileName = 'aktualnosci.php';
                break;
            case 'biblioteczka':
                $fileName = 'biblioteczka.php';
                break;
            case 'harcerki':
                $fileName = 'harcerki.php';
                break;
            case 'harcerze':
                $fileName = 'harcerze.php';
                break;
            case 'galeria':
                $fileName = 'galeria.php';
                break;
            case 'kalendarium':
                $fileName = 'kalendarium.php';
                break;
            case 'kalendarz07':
                $fileName = 'kalendarz07.php';
                break;
            case 'kapelan':
                $fileName = 'kapelan.php';
                break;
            case 'kontakt':
                $fileName = 'kontakt.php';
                break;
            case 'linki':
                $fileName = 'linki.php';
                break;
            case 'o_nas':
                $fileName = 'o_nas.php';
                break;
            case 'panel':
                $fileName = 'panel.php';
                break;
            case 'rada_harcerek':
                $fileName = 'rada_harcerek.php';
                break;
            case 'rada_harcerzy':
                $fileName = 'rada_harcerzy.php';
                break;
            case 'rada_obwodu':
                $fileName = 'rada_obwodu.php';
                break;
            case 'rajd':
                $fileName = 'rajd.php';
                break;
            case 'regulaminy':
                $fileName = 'regulaminy.php';
                break;
            case 'rozkazy':
                $fileName = 'rozkazy.php';
                break;
            case 'recencja_wilk_ktory_nigdy_nie_spi':
                $fileName = 'recencja_wilk_ktory_nigdy_nie_spi.php';
                break;
            case 'przybornik':
                $fileName = 'przybornik.php';
                break;
            case 'kalendarz':
                $fileName = 'kalendarz.php';
                break;
//            case 'powstanie_zielonogorskiego_zhr':
//                $fileName = 'powstanie_zielonogorskiego_zhr.php';
//                break;
            default:
                $fileName = 'index.php';
            }
            
            return $pagePath . $fileName;
        }
    }

    if(!function_exists("getWebmaster")) {
        function getWebmaster() {
            return "<a href='./images/email/email.php?email=perk'>pwd. Marcin Sto¿ek \"Nietoperz\" HR</a>";
        }
    }
    ?>