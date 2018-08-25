<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	$with=imagecolorallocate($img,255,255,255);
	
	$pi=array();
	$pp=array();
	$do=-90;
	$doo=120;
	
	for($i=1;$i<=6;$i++){
		$pi[]=150+80*cos(deg2rad($do));
		$pi[]=130+80*sin(deg2rad($do));
		
		$pp[]=150+100*cos(deg2rad($do));
		$pp[]=130+100*sin(deg2rad($do));
		
		$do+=$doo;
	}
	
	imagepolygon($img,$pi,count($pi)/2,$color);
	imagepolygon($img,$pp,count($pp)/2,$color);
	imagefill($img,150,40,$color);
	
	
	imagerectangle($img,130,180,170,270,$color);
	imagerectangle($img,140,190,160,260,$color);
	imagefill($img,150,265,$color);
	
	imagerectangle($img,140,160,160,190,$with);
	imagefill($img,150,180,$with);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>