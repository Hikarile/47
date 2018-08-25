<?php
	if($_SESSION['login']==''){
		header("location:admin.php");
	}