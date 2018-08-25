<?php
	include("cd.php");
	$mysql->query("DELETE FROM `eat` WHERE `eat`.`id` = '".$_GET['id']."'");
	header("location:ad_e.php");
?>