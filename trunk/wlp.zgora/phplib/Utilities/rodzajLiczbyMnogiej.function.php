<?php
/**
 * Zwraca rodzaj liczby mnogiej dla liczebnika.
 *
 * @param $liczebnik Liczebnik do zbadania.
 * @param $formaPojedyncza Postac rzeczownika w liczbie pojedynczej (np. "zdjecie").
 * @param $formaPodwojna Postac rzeczownika w liczbie podwojnej (np. "zdjecia").
 * @param $formaMnoga Postac rzeczownika w liczbie mnogiej (np. "zdjec").
 *  
 * @return Jedna z podanych form rzeczownika. 
 */
function rodzajLiczbyMnogiej($liczebnik, $formaPojedyncza = 1, $formaPodwojna = 2, $formaMnoga = 3) {
	$rodzaj = 0;
	if ($liczebnik == 1) {
		$rodzaj = 1;
	} else if ($liczebnik >= 2 && $liczebnik <= 4) {
		$rodzaj = 2;
	} else if ($liczebnik % 100 >= 12 && $liczebnik % 100 <= 14) {
		$rodzaj = 3;
	} else if ($liczebnik % 10 >= 2 && $liczebnik % 10 <= 4) {
		$rodzaj = 2;
	} else {
		$rodzaj = 3;
	}
	
	switch ($rodzaj) {
		case 1: return $formaPojedyncza;
		case 2: return $formaPodwojna;
		case 3: return $formaMnoga;  
	}
}
?>
