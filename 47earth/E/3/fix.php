<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['ok']=='編輯完成'){
		$status='編輯完成';
	}else{
		$status='還再編輯';
	}
	
	$id=$_POST['id'];
	$mysql->query("UPDATE `text` SET `status` = '$status',`time1` = '".$_POST['time1']."', `time2` = '".$_POST['time1']."' WHERE `id` = '$id'");
	$mysql->query("DELETE FROM `qa` WHERE `text_id` = '$id'");
	
	for($i=1;$i<=$_POST['p'];$i++){
		$q=$_POST['q'][$i];
		$type=$_POST['type'][$i];
		$da='';
		$count='';
		
		if($type==2){
			for($j=1;$j<=4;$j++){
				$da=$da.$_POST['da2'.$i][$j].',';
			}
			$count=$_POST['correct2'][$i];
		}else if($type==3){
			$number=$_POST['number'][$i];
			for($j=1;$j<=$number;$j++){
				$da=$da.$_POST['da3'.$i][$j].',';
				foreach($_POST['correct3'.$i] as $key=>$val){
					if($key == $j){
						$count=$count.$_POST['da3'.$i][$j].',';
					}
				}
			}
		}else{
			$count=$_POST['correct1'][$i];
		}
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`, `correct`) VALUES ('$id', '$q', '$type', '$da', '$count')");
	}
	
	header("location:menu.php");
	