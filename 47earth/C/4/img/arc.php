<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	imagearc($img,150,150,200,200,0,360,$color);
	imagearc($img,150,150,160,160,0,360,$color);
	
	imagefill($img,150,60,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>