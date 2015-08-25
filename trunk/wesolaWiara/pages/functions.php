<?
if(!function_exists("getPagePath")) {
    function getPagePath($pageName) {
        $pagePath = 'pages/';
        $fileName = '';

        switch ($pageName) {
            case 'rocznica':
                $fileName = 'rocznica.php';
                break;
            case 'forum':
                $fileName = 'forum.php';
                break;
            case 'kontakt':
                $fileName = 'kontakt.php';
                break;
            default:
                $fileName = 'rocznica.php';
        }

        return $pagePath . $fileName;
    }
}
?>