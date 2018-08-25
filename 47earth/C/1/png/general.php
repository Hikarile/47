<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	imagearc($img,101,101,150,150,-150,45,$color);
	imagearc($img,101,101,130,130,-150,45,$color);
	
	imagearc($img,199,199,130,130,30,225,$color);
	imagearc($img,199,199,150,150,30,225,$color);
	
	imageline($img,37,64,46,69,$color);
	imageline($img,254,231,263,237,$color);
	imagefill($img,150,150,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>