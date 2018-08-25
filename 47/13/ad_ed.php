<?php
	include("cd.php");
	$mysqli->query("DELETE FROM `eat` WHERE `eat`.`id` = '".$_GET['id']."'");
	header("location:ad_e.php");
?>