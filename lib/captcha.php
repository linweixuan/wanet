<?php
	//session_start();
 
	// generate random number and store in session 
	$randomnr = rand(1000, 9999);
	$_SESSION['token'] = md5($randomnr);
 
	//generate image
	$im = imagecreatetruecolor(100, 25);
 
	//colors:
	$white = imagecolorallocate($im, 230, 212, 234);
	$grey = imagecolorallocate($im, 200, 128, 128);
	$black = imagecolorallocate($im, 245, 249, 225);
	
	imagefill($im, 0, 0, $bgcolor);
	imagefilledrectangle($im, 0, 0, 150, 22, $black);
 
	//path to font: 
	$font = 'font.ttf';
 
	//draw text:
	imagettftext($im, 17, 0, 28, 22, $grey, $font, $randomnr); 
	imagettftext($im, 17, 0, 17, 24, $white, $font, $randomnr);
 
	// prevent client side  caching
	header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
 
	//send image to browser
	header ("Content-type: image/gif");
	imagegif($im);
	imagedestroy($im);
?>