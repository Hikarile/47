<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	$mysql->query("DELETE FROM `login` WHERE `id` = '$id' ");
	header("location:teacher.php");
	