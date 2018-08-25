<?php
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	$pi=array();
	$pp=array();
	$do=60;
	$doo=60;
	
	for($i=1;$i<=6;$i++){
		$pi[]=150+110*cos(deg2rad($do));
		$pi[]=150+110*sin(deg2rad($do));
		
		$pp[]=150+140*cos(deg2rad($do));
		$pp[]=150+140*sin(deg2rad($do));
		
		$do+=$doo;
	}
	
	imagepolygon($img,$pi,count($pi)/2,$color);
	imagepolygon($img,$pp,count($pp)/2,$color);
	
	imagefill($img,150,50,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>