<?php
	include("cd.php");
	$id=$_GET['id'];
	$mysqli->query("DELETE FROM `png` WHERE `png`.`id` = '$id'");
	header("location:messagefix.php?id=".$id);
?>