<?php
	error_reporting(E_ALL &~ E_NOTICE);
	session_start();
	date_default_timezone_set("Asia/Taipei");
	$mysqli=new mysqli('localhost','admin','1234','4702');
	$mysqli->query("set names `utf8`");
	$_SESSION['dnlu'];