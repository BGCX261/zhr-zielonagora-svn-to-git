<?
function getDbConnection() {
	// TODO: podstaw dobre zmienne
        $dbHost = "localhost";
        $dbName = "yourDbName";
        $dbUser = "yourDbUser";
        $dbPass = "yourConfidentialPassword9";

	if ($dbConnection = mysql_connect($dbHost, $dbUser, $dbPass)) {
		mysql_select_db($dbName, $dbConnection);
	}
	return $dbConnection;
}
?>