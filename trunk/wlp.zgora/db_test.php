<?
include("init.php");

if (!db_connect()) {
	echo 'dupa jasiu pierdzi stasiu - nic z tego, nie mam po��czenia!';
	} else {
	echo "no prosz�, dzia�a:)<br>Po��czenie z baz� danych... OK.";
	}
?>
