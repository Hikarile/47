<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['ok']=='編輯完成'){
		$status='編輯完成';
	}else{
		$status='編輯中';
	}
	$id=$_POST['id'];
	
	$mysql->query("DELETE FROM `qa` WHERE `textid` = '$id'");
	$mysql->query("UPDATE `text` SET `status` = '$status' WHERE `id` = '$id'");
	
	for($i=1;$i<=$_POST['p'];$i++){
		$q=$_POST['q'][$i];
		$type=$_POST['type'][$i];
		$t1=$_POST['t1'][$i];
		$t2=$_POST['t2'][$i];
		$da='';
		$correct='';
		
		if($type == '2'){
			for($j=1;$j<=4;$j++){
				$da=$da.$_POST['da2'.$i][$j].',';
				if($_POST['correct2'.$i] == $j){
					$correct=$_POST['da2'.$i][$j];
				}
			}
		}else if($type == '3'){
			for($j=1;$j<=$_POST['number'.$i];$j++){
				$da=$da.$_POST['da3'.$i][$j].',';
							
				foreach($_POST['correct3'.$i] as $key => $val){
					if($val == $j){
						$correct=$correct.$_POST['da3'.$i][$j].',';
					}
				}
			}
		}else{
			$correct=$_POST['correct1'.$i];
		}
		$mysql->query("INSERT INTO `qa` (`textid`, `q`, `type`, `da`, `correct`,`t1`,`t2`) VALUES ('$id', '$q', '$type', '$da', '$correct','$t1','$t2')");
	}
	
	header("location:menu.php");
	