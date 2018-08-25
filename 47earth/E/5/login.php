<?php
	if($_SESSION['login']!='start'){
		header("location:admin.php");
	}