<?
include("init.php");

if (!db_connect()) {
	echo 'dupa jasiu pierdzi stasiu - nic z tego, nie mam po³±czenia!';
	} else {
	echo "no proszê, dzia³a:)<br>Po³±czenie z baz± danych... OK.";
	}
?>
