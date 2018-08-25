<?php
	include("../cd.php");
	$textid=$_GET['textid'];
	$qaid=$_GET['qaid'];
	
	$text=$mysql->query("SELECT * FROM `qa` where `text_id` = '$textid' and `id` = '$qaid'");
	foreach($text as  $t){
		$type=$t['type'];
		$correct=$t['correct'];
	}
	$okda=['正確人數'=>0,'錯誤人數'=>0,'未填人數'=>0];
	$aa=$mysql->query("SELECT * FROM `count` where `textid` = '$textid' and `qaid` = '$qaid'");
	foreach($aa as  $a){
		if($a['da'] == $correct){
			$okda['正確人數']++;
		}else{
			if($a['da'] == ''){
				$okda['未填人數']++;
			}else{
				$okda['錯誤人數']++;
			}
		}
		$aaa++;//答案總數
	}
	
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$red=imagecolorallocate($img,255,0,0);
	$line=imagecolorallocate($img,0,0,0);
	
	imageline($img,30,0,30,270,$line);
	imageline($img,30,270,300,270,$line);
	
	$hhh=90;
	$z30=90;
	$i=0;
	foreach($okda as $key => $val){
		$i++;
		$den=270-($val*$hhh);
		imagefilledarc($img,$z30,$den,10,10,0,360,$line,IMG_ARC_PIE);
		imagettftext($img,15,0,$z30,$den-20,$line,"abc.ttf",$val);
		
		$x1=$z30;
		$y1=$den;
		imagettftext($img,15,0,$x1-50,290,$line,"abc.ttf",$key);
		if($i != 1){	
			imageline($img,$x1,$y1,$x2,$y2,$red);
		}
		
		$x2=$z30;
		$y2=$den;
		
		$z30+=90;
	}
	
	header("Content-type:image/png");
	imagepng($img);
?>