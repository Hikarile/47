<?php
	$x=array();
	$y=array();
	
	$xx=array();
	$yy=array();
	
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$color=imagecolorallocate($img,0,0,0);
	
	$do=-90;
	$doo=-54;
	for($i=1;$i<=5;$i++){
		$x[]=150+120*cos(deg2rad($do));
		$y[]=150+120*sin(deg2rad($do));
		
		$x[]=150+60*cos(deg2rad($doo));
		$y[]=150+60*sin(deg2rad($doo));
		
		$xx[]=150+80*cos(deg2rad($do));
		$yy[]=150+80*sin(deg2rad($do));
		
		$xx[]=150+30*cos(deg2rad($doo));
		$yy[]=150+30*sin(deg2rad($doo));
		
		$do+=72;
		$doo+=72;
	}
	
	for($j=0;$j<=9;$j++){
		if($j==9){
			imageline($img,$x[$j],$y[$j],$x[$j-9],$y[$j-9],$color);
			imageline($img,$xx[$j],$yy[$j],$xx[$j-9],$yy[$j-9],$color);
		}else{
			imageline($img,$x[$j],$y[$j],$x[$j+1],$y[$j+1],$color);
			imageline($img,$xx[$j],$yy[$j],$xx[$j+1],$yy[$j+1],$color);
		}
	}
	
	imagefill($img,150,50,$color);
	
	header("Content-type:image/png");
	imagepng($img);
	imagedestroy($img);
?>