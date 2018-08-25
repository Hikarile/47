<?php
	include("cd.php");
	
	$mysql->query("DELETE FROM `name` WHERE `id` = '".$_SESSION['id']."'");
	header("location:index.php");
	