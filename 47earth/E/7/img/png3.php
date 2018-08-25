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
	
	$dd=120;  //一開始
	$gh=100/$aaa;  //一開始
	$ghh=$gh;      //+的
	foreach($okda as $key => $val){
		$h=$val*$ghh;
		$pie[]=150+$h*cos(deg2rad($dd));
		$pie[]=150+$h*sin(deg2rad($dd));
		
		$xx=150+115*cos(deg2rad($dd));
		$yy=150+115*sin(deg2rad($dd));
		imagettftext($img,10,0,$xx,$yy,$line,"abc.ttf",$key.'('.$val.')');
		$xx="";
		$yy="";
		
		$dd+=120;
	}
	imagefilledpolygon($img,$pie,count($pie)/2,$red);
	
	$dd=120;  //一開始
	$gh=100/$aaa;  //一開始
	$ghh=$gh;      //+的
	for($i=1;$i<=$aaa;$i++){
		for($j=1;$j<=3;$j++){
			$x[]=150+$gh*cos(deg2rad($dd));
			$x[]=150+$gh*sin(deg2rad($dd));
			$dd+=120;
			$v++;
		}
		imagepolygon($img,$x,count($x)/2,$line);
		$dd-=360;
		$gh+=$ghh;
	}
	
	header("Content-type:image/png");
	imagepng($img);
	