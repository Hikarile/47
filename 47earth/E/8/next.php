<?php
	include("cd.php");
	
	$_SESSION['ga']++;
	if($_SESSION['ga'] > $_SESSION['count']){
		
		$mysql->query("UPDATE `name` SET `alltext` = '".$_SESSION['count']."', `yestext` = '".$_SESSION['yes_text']."', `notext` = '".$_SESSION['no_text']."', `nulltext` = '".$_SESSION['null_text']."' WHERE `id` = '".$_SESSION['id']."'");
		
		$mysql->query("UPDATE `text` SET `status` = '考試完成' WHERE `id` = '".$_SESSION['textid']."'");
		header("location:end.php");
		
	}else{
		header("location:text.php");
	}
	