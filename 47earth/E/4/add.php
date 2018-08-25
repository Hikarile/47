<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['ok']=='編輯完成'){
		$status='編輯完成';
	}else if($_POST['ok']=='稍後編輯'){
		$status='編輯中';
	}
	
	$mysql->query("INSERT INTO `text` (`status` ,`time1`, `time2`) VALUES ('$status','".$_POST['time1']."', '".$_POST['time2']."')");
	$id=mysqli_insert_id($mysql);
	
	for($i=1;$i<=$_POST['p'];$i++){
		$q=$_POST['q'][$i];
		$type=$_POST['type'][$i];
		$da='';
		$correct='';
		
		if($type=='2'){
			for($j=1;$j<=4;$j++){
				$da=$da.$_POST['da2'.$i][$j].',';
				if($_POST['correct2'][$i]==$j){
					$correct=$_POST['da2'.$i][$j];
				}
			}
		}else if($type=='3'){
			for($j=1;$j<=$_POST['number'][$i];$j++){
				$da=$da.$_POST['da3'.$i][$j].',';
				foreach($_POST['correct3'.$i] as $key =>$val){
					if($key==$j){
						$correct=$correct.$_POST['da3'.$i][$j].',';
					}
				}
			}
		}else{
			$correct=$_POST['correct1'][$i];
		}
		
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`, `correct`) VALUES ('$id', '$q', '$type', '$da', '$correct')");
	}
	
	$test_number=str_pad($id,8,0,STR_PAD_LEFT);
	$mysql->query("UPDATE `text` SET `text_number` = '$test_number' WHERE `id` = '$id'");
	
	header("location:menu.php");
	