<?php
	include("cd.php");
	
	$id=$_GET['id'];
	$mid=$_GET['mid'];
	
	$mysql->query("DELETE FROM `png` WHERE `id` = '$mid'");
	header("location:messagefix.php?id=".$id);
?>