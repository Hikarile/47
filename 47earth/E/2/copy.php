<?php
	include('cd.php');
	$id=$_GET['id'];
	
	$aa=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	$mysql->query("INSERT INTO `text` (`status`,`time1`,`time2`) VALUES ('編輯完成','".$a['time1']."','".$a['time2']."')");
	$new_id=mysqli_insert_id($mysql);
	
	$bb=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
	while($b=mysqli_fetch_array($bb)){
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`, `correct`) VALUES ('".$new_id."', '".$b['q']."', '".$b['type']."', '".$b['da']."', '".$b['correct']."')");
	}
	
	$text_number=str_pad($new_id,8,'0',STR_PAD_LEFT);
	$mysql->query("UPDATE `text` SET `text_number` = '$text_number' WHERE `id` = '$new_id'");
	
	header('location:menu.php');
?>