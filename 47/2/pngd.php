<?php
	include("include.php");
	$id=$_GET['id'];
	$mid=$_GET['mid'];
	
	$aa=$mysql->query("SELECT * FROM `png` where `mid` = '$mid'");
	$a=mysqli_fetch_array($aa);
	unlink('file/'.$a['png']);
	$mysql->query("DELETE FROM `png` WHERE `id` = '".$a['id']."'");
	
	header("location:messagefix.php?id=".$id);
?>