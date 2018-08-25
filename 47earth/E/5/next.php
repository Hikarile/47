<?php
	include("cd.php");
	
	$_SESSION['ga']++;
	if($_SESSION['ga']>$_SESSION['count']){
		$mysql->query("UPDATE `text` SET `status` = '考試完成' WHERE `id` = '".$_SESSION['textid']."'");
		
		$mysql->query("UPDATE `name` SET `all_text` = '".$_SESSION['count']."', `yes_text` = '".$_SESSION['yes_text']."', `no_text` = '".$_SESSION['no_text']."', `null_text` = '".$_SESSION['null_text']."' WHERE `id` = '".$_SESSION['id']."'");
		header("location:end.php");
	}else{
		header("location:text.php");
	}
	