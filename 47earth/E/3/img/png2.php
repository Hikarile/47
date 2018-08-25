<?php
	include("../cd.php");
	$textid=$_GET['textid'];
	$qaid=$_GET['qaid'];
	
	$text=$mysql->query("SELECT * FROM `qa` where `text_id` = '$textid' and `id` = '$qaid'");
	foreach($text as  $t){
		$type=$t['type'];
		$correct=$t['correct'];
	}
	
	if($type == '3'){
		$name=$mysql->query("SELECT * FROM `name` where `text_number` = '".$_SESSION['number']."'");
		foreach($name as $na){
			$correct='';
			$aa=$mysql->query("SELECT * FROM `count` where `textid` = '$textid' and `qaid` = '$qaid' and `nameid` = '".$na['id']."'");
			foreach($aa as  $a){
				$ok=$ok.$a['da'].',';
			}
			if($ok == $correct){
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
	}else{
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
	}
	
	$img=imagecreate(300,300);
	$bg=imagecolorallocate($img,255,255,255);
	$line=imagecolorallocate($img,0,0,0);
	
	$do=0;
	$i=0;
	foreach($okda as $key => $val){
		$pi=$val/$aaa*360;
		
		$color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));
		
		imagefilledarc($img,150,150,200,200,$do,$pi+$do,$color,IMG_ARC_PIE);
		
		$x[]=160+130*cos(deg2rad($pi/2+$do));
		$y[]=200+130*sin(deg2rad($pi/2+$do));
		
		$do+=$pi;
		
		imagettftext($img,15,0,$x[$i],$y[$i],$line,"abc.ttf",$key.'('.$val.')');
		$i++;
	}
	
	header("Content-type:image/png");
	imagepng($img);
?>