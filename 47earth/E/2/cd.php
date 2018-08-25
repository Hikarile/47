<?php
	error_reporting(E_ALL &~ E_NOTICE);
	session_start();
	date_default_timezone_set('Asia/Taipei');
	$mysql=new mysqli('localhost','admin','1234','47earth_E');
	$mysql->query('set names `utf8`');
	