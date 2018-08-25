<?php
	include('cd.php');
	if($_POST['ok'] == '編輯完成'){
		$ok='編輯完成';
	}else{
		$ok='編輯中';
	}
	
	$mysql->query("INSERT INTO `text` (`status`, `time1`, `time2`) VALUES ('$ok', '".$_POST['time1']."', '".$_POST['time2']."')");
	$id=mysqli_insert_id($mysql);
	
	for($i=1;$i<=$_POST['ppp'];$i++){
		$correct='';
		$da='';
		$q=$_POST['q'][$i];
		$type=$_POST['type'][$i];
		
		if($type == '2'){
			for($j=1;$j<=4;$j++){
				$da=$da.$_POST['n'.$i.'2'][$j].',';
				if($_POST['okda'.$i.'2'] == $j){
					$correct=$_POST['n'.$i.'2'][$j];
				}
			}
		}else if($type == '3'){
			for($j=1;$j<=$_POST['number'][$i];$j++){
				$da=$da.$_POST['n'.$i.'3'][$j].',';
				foreach($_POST['okda'.$i.'3'] as $k =>$ok){
					if($k == $j){
						$correct=$correct.$_POST['n'.$i.'3'][$j].',';
					}
				}
			}
		}else{
			$correct=$_POST['okda'.$i.'1'];
			$da='';
		}
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`,`correct`) VALUES ('$id', '$q', '$type', '$da','$correct')");
	}
	
	$text_number=str_pad($id,8,'0',STR_PAD_LEFT);
	$mysql->query("UPDATE `text` SET `text_number` = '$text_number' WHERE `id` = '$id'");
	
	header('location:menu.php');