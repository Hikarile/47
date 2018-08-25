<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	$id=$_GET['id'];
	
	$aa=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	echo $png=$a['png'];
	if($png !=""){
		unlink('file/'.$png);
	}
	
	$mysql->query("DELETE FROM `message` WHERE `id` = '$id'");
	$mysql->query("DELETE FROM `mrepoly` WHERE `mid` = '$id'");
	header("location:mess-manage.php");
	
?>