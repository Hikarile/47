<?php
	include("cd.php");
	$mysql->query("DELETE FROM `name` WHERE `id` = '".$_SESSION['id']."'");
	session_destroy();
	header('location:index.php');
