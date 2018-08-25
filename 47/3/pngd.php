<?php
	include("cd.php");
	$id=$_GET['id'];
	$mid=$_GET['mid'];
	
	$aa=$mysql->query("SELECT * FROM `png` where `id` = '$mid'");
	$a=mysqli_fetch_array($aa);
	
	unlink("file/".$a['pan'].$a['png']);
	$mysql->query("DELETE FROM `png` WHERE `id` = '$id'");
	header("location:messagefix.php?id=".$id);
?>