<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	date_default_timezone_set("Asia/Taipei");
	$mysqli=new mysqli('localhost','admin','1234','47');
	$mysqli->query("set name `utf8`");
	
	