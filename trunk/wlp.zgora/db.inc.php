<?

function db_connect() {
    include_once(".htdb.inc.php");
    if(!@mysql_connect($dbHost ,$dbUser, $dbPass))
    return 0;
    if(!@mysql_select_db($dbName))
    return 0;
    mysql_query("set names 'latin2'");
    return 1;
}// db_connect()

function db_close() {
    mysql_close();
} // db_close()

?>
