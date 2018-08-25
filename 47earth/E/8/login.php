<?php
	include("cd.php");
	
	if($_SESSION['login']==''){
		session_destroy();
		header("location:admin.php");
	}
	