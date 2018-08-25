<?php
	include("cd.php");
	
	$qaid=$_POST['qaid'];
	$type=$_POST['type'];
	
	$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`) VALUES ('".$_SESSION['text_id']."', '$qaid', '".$_SESSION['id']."', '$type')");
	$_SESSION['ok'][$_POST['count']]='';
?>