<?
function getDbConnection() {
	if ($dbConnection = mysql_connect($dbHost, $dbUser, $dbPass)) {
		mysql_select_db($dbName, $dbConnection);
//		mysql_query("set names 'latin2'", $dbConnection);
	}
	return $dbConnection;
}
?>
