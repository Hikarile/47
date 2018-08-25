<?php
	error_reporting(E_ALL &~ E_NOTICE);
	session_start();
	date_default_timezone_set("Asia/Taipei");
	$mysql=new mysqli('localhost','admin','1234','4702');
	$mysql->query("set names `utf8`");
	$_SESSION['dnlu'];