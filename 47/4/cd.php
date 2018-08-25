<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	date_default_timezone_set("Aisa/Taipei");
	$mysql=new mysqli('localhost','admin','1234','4702');
	$mysql->query("set names `utf8`");