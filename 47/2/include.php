<?php
	session_start();
	date_default_timezone_set("Asia/Taipei");
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','4702');
	$mysql->query("set names `utf8`");
	$_SESSION['save'];