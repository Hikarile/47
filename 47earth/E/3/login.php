<?php
	include("cd.php");
	if($_SESSION['login']!='true'){
		header("location:out.php");
	}
	