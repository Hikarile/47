<?php
	include('cd.php');
	$id=$_GET['id'];
	
	$aa=$mysql->query("SELECT * FROM `text`order by `id` DESC limit 1");
	$a=mysqli_fetch_array($aa);
	$text_number=str_pad($a['text_number']+1,8,'0',STR_PAD_LEFT);
	
	$mysql->query("INSERT INTO `text` (`text_number`, `status`,`time1`,`time2`) VALUES ('".$text_number."', '編輯完成','".$a['time1']."','".$a['time2']."')");
	$new_id=mysqli_insert_id($mysql);
	
	$bb=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
	while($b=mysqli_fetch_array($bb)){
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`, `correct`) VALUES ('".$new_id."', '".$b['q']."', '".$b['type']."', '".$b['da']."', '".$b['correct']."')");
	}
	header('location:menu.php');
?>