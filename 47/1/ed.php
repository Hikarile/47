<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	$id=$_GET['id'];
	$mysql->query("DELETE FROM `eat` WHERE `id` = '$id'");
	header("location:eat-manage.php");
?>