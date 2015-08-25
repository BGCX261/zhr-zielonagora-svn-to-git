<?
/**
 * Obiekt danych reprezentujacy dane komentarza. Ma pola takie jak kolumny tabeli 'komentarzDoZdjecia'.
 */
class KomentarzDoZdjecia
{
	var $data;
	var $jestOpisem;
	var $katalog;
	var $nazwaPlikuZdjecia;
	var $numerKomentarza;
	var $podpis;
	var $tresc;
	var $wyswietlany;


	/**
	 * Konstruktor uzywany przy zapisywaniu komentarza.
	 */
    function KomentarzDoZdjecia($podpis = "", $tresc = "") {
    	$this->podpis = $podpis;
    	$this->tresc = $tresc;
    }
    
    function toString() {
		$output = "[KomentarzDoZdjecia:".$this->katalog.":".$this->nazwaPlikuZdjecia.":".$this->tresc.":".$this->podpis."]";
		return $output;
    }
}
?>