<?php
	include("cd.php");
	include("login.php");
	
	$mysql->query("INSERT INTO `text` (`teacherid`, `status`) VALUES ('".$_SESSION['id']."', '編輯完成')");
	$id=mysqli_insert_id($mysql);
	
	$q=$mysql->query("SELECT * FROM `qa` where `textid` = '".$_GET['id']."'");
	while($qa=mysqli_fetch_array($q)){
		$mysql->query("INSERT INTO `qa` (`textid`, `q`, `type`, `da`, `correct`,`t1`,`t2`) VALUES ('$id', '".$qa['q']."', '".$qa['type']."', '".$qa['da']."', '".$qa['correct']."','".$qa['t1']."','".$qa['t2']."')");
	}
	
	$number=str_pad($id,8,0,STR_PAD_LEFT);
	$mysql->query("UPDATE `text` SET `number` = '$number' WHERE `id` = '$id'");
	
	header("location:menu.php");
	