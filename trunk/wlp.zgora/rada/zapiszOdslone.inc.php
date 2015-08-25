<?
function zapiszOdslone() {
	$data = date("Y-m-d H:i:s");
	$adres_strony = $_SERVER["REQUEST_URI"];
	$od_ip = $_SERVER["REMOTE_ADDR"];
	$od_nazwa = gethostbyaddr($od_ip);
	$przegladarka = $_SERVER["HTTP_USER_AGENT"];
	$poprzedni_adres = $_SERVER["HTTP_REFERER"];

	$inserted = @mysql_query("INSERT INTO odslony(data,adres_strony,od_ip,od_nazwa,przegladarka,poprzedni_adres) VALUES ('$data','$adres_strony','$od_ip','$od_nazwa','$przegladarka','$poprzedni_adres')");
}
?>
