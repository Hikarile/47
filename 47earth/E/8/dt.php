<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	$lo=$mysql->query("DELETE FROM `login` WHERE `id` = '$id'");
	
	header("location:teacher.php");
	
	