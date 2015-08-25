<?
include_once("db.inc.php");
include_once("zapiszOdslone.inc.php");

if (db_connect()) {
	zapiszOdslone();
}
?>
