<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	
	$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($t);
	
	$mysql->query("INSERT INTO `text` (`type`,`status`) VALUES ('".$_SESSION['id']."','編輯完成')");
	$newid=mysqli_insert_id($mysql);
	
	$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
	while($qa=mysqli_fetch_array($q)){
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`, `correct`, `t1`, `t2`) VALUES ('$newid', '".$qa['q']."', '".$qa['type']."', '".$qa['da']."', '".$qa['correct']."', '".$qa['t1']."', '".$qa['t2']."')");
	}
	
	$text_number=str_pad($newid,8,0,STR_PAD_LEFT);
	$mysql->query("UPDATE `text` SET `text_number` = '$text_number' WHERE `id` = '$newid'");
	
	header("location:menu.php");
	