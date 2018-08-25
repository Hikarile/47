<?php
	include("cd.php");
	include("login.php");
	session_destroy();
	header("location:admin.php");
	