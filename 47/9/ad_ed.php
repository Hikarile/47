<?php
	include("cd.php");
	$id=$_GET['id'];
	$mysql->query("DELETE FROM `eat` WHERE `id` = '$id'");
	header("location:ad_e.php");
?>