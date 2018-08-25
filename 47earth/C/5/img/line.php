<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	imageline($img,56,41,260,245,$color);
	imageline($img,40,55,244,260,$color);
	imageline($img,56,41,40,55,$color);
	imageline($img,260,245,244,260,$color);
	
	imagefill($img,150,150,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>