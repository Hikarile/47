<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	imagerectangle($img,50,50,250,250,$color);
	imagerectangle($img,80,80,220,220,$color);
	imagefill($img,150,60,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>