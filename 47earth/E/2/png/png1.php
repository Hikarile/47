<?php
	include("../cd.php");
	$textid=$_GET['textid'];
	$qaid=$_GET['qaid'];
	$id=$_SESSION['$id'];
	
	$aa=$mysql->query("SELECT `da`, COUNT(`id`) as number FROM `count` where `textid` = '$textid' and `qaid` = '$qaid' group by `da`");
	foreach($aa as $a){
		$number[]=$a['number'];
		$da[]=$a['da'];
	}
	$aaa=array_sum($number);//答案總數
	$max=count($number);//幾種答案
	
	$img=imagecreate(400,400);
	$bg=imagecolorallocate($img,255,255,255);
	$line=imagecolorallocate($img,0,0,0);
	
	$do=0;
	foreach($number as $i => $val){
		$pi=$val/$aaa*360;
		
		$color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));
		
		imagefilledarc($img,200,200,200,200,$do,$pi+$do,$color,IMG_ARC_PIE);
		
		$x[]=160+130*cos(deg2rad($pi/2+$do));
		$y[]=200+130*sin(deg2rad($pi/2+$do));
		
		$do+=$pi;
	}
	
	for($j=1;$j<=$max;$j++){
		$text='';
		if($da[$j-1] == ''){
			$text='沒有作答';
		}else{
			$text=$da[$j-1];
		}
		imagettftext($img,15,0,$x[$j-1],$y[$j-1],$line,"abc.ttf",$text.'('.$number[$j-1].')');
	}
	
	header("Content-type:image/png");
	imagepng($img);
?>