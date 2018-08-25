<?php
	include("cd.php");
	$id=$_POST['id'];
	$aa=$mysql->query("DELETE FROM `png` WHERE `png`.`id` = '$id'");
	$a=mysqli_fetch_array($aa);
?>