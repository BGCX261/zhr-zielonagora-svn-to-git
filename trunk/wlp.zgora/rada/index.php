<?
$page = $_REQUEST['page'];
if ($page == "") $page = "strony/index.php";
else $page = "strony/".$page.".php";

set_include_path(".:..:../phplib");
include( "init.php" ); 
include( "nazwaMiesiaca.inc.php" ); 
include_once("miesiacRzymskimi.inc.php"); ?>

<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
        <meta name="author" content="">
        <meta name="reply-to" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <LINK rel="stylesheet" href="../glowny.css" type="text/css">
        <style type="text/css">
            <!--
            .unnamed1 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px}
            a:hover {  color: #CC0000}
            a:link {  text-decoration: none}
            a:visited {  text-decoration: none}-->
        </style>
    </head>

    <body  text="#000000" link="#000099" vlink="#000099" alink="#000099" leftmargin="3" topmargin="3" marginwidth="3" marginheight="3">
        <table width="765" border="0" cellspacing="0" cellpadding="0" height="408">
            <tr>
                <td  valign="top" background="../images/designMain/page_tlo.jpg">
                    <table width="531" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td  valign="top"><img src="../images/designMain/t1.jpg" width="251" height="89"></td>
                                        <td  background="top"><img src="../images/designMain/t2.jpg" width="509" height="89"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="760" border="0" cellspacing="0" cellpadding="0" height="295">
                                    <tr valign="top">
                                        <td>
                                            <table width="206" border="0" cellspacing="0" cellpadding="0" height="287">
                                                <tr>
                                                    <td  background="../images/designMain/m1.jpg" height="39">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td  background="../images/designMain/m2.jpg" height="268" valign="top">
                                                        <table width="185" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="37">&nbsp;</td>
                                                                <td width="148">
                                                                    <table width="143" border="0" cellspacing="0" cellpadding="0" class="unnamed1">
                                                                        <tr>
                                                                            <td>
                                                                                <p>&nbsp;</p>
                                                                            </td>
                                                                        </tr>
                                                                        <? include ("menulewe.inc.php"); ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td background="../images/designMain/m3.jpg" height="106">&nbsp;</td>
                                                </tr>

                            <? include ("menulewebaner.inc.php"); ?>

                                            </table>
                                        </td>
                                        <td width="550">
                                            <table  width="520" border="0" cellspacing="0" cellpadding="0" class="unnamed1">
                                                <tr>
                                                    <td>
                                                        <!-- <p>&nbsp;</p> -->
                                                        <p><b></b>
                                                            <table  width="100%" align="center" cellspacing="2" cellpadding="0" border="0">

                                                            <td  width="85%" class="wnetrze">

                                                            <!--   -----------------  Tresc strony ---------------------------- -->
<?	if ($page == "") $page = "strony/index.php";

//	echo "Dostalem: $page";

require($page);
?>
                                                            <!-- ---------------------   Koniec tresci ------------------------ -->



                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td  valign="bottom" background="../images/designMain/page_tlo.jpg"><img src="../images/designMain/bott.jpg" width="760" height="12"></td>
            </tr>
        </table>
        <p></p>
    </body>
</html>
