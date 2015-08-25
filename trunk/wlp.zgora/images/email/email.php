<?php
    
		$mail["perk"] = "marcin.stozek@gmail.com";

		Header("Content-type: image/png");
    //$string=implode($argv," ");
    $string=$_REQUEST['email'];
    //$string="perk";

    $im = imageCreateFromPng("./email.png");
    $orange = ImageColorAllocate($im, 220, 210, 60);
    $px = (imagesx($im)-7.5*strlen($mail[$string]))/2;
    ImageString($im,3,$px,9,$mail[$string],$orange);
    ImagePng($im);
    ImageDestroy($im);
?>
