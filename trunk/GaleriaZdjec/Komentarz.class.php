<?
class Komentarz
{
	var $data;
	var $podpis;
	var $tresc;
	var $jestOpisem;
	
	/**
	 * Konstruktor uzywany przy zapisywaniu komentarza.
	 */
    function Komentarz($podpis, $tresc) {
    	$this->podpis = $podpis;
    	$this->tresc = $tresc;
    }
}
?>