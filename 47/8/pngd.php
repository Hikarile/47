<?php
	include("cd.php");
	$id=$_GET['id'];
	$mysql->query("DELETE FROM `png` WHERE `mid` = '$id'");
	header("location:messagefix.php?id=".$id);
?>