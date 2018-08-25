<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	
	$_SESSION['out'] = 'out';
	
	$_SESSION['etime']=date("H:i:s"); 
	$_SESSION['time'][$_SESSION['mcount']]=(strtotime($_SESSION['etime'])-strtotime($_SESSION['stime']));
	$_SESSION['stime']=$_SESSION['etime'];
	