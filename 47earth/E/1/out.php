<?php
	include('cd.php');
	if($_SESSION['dnlu']!='true'){
		header('location:admin.php');
	}
	session_destroy();
	header('location:admin.php');
?>