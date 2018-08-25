<?php
	include("cd.php");
	$ms=explode(' ',microtime("now"));
	$time=$ms[0]+$ms[1];
	
	$_SESSION['out']='out';
	$_SESSION['etime']=$time;
	$_SESSION['time'][$_SESSION['count']]=($_SESSION['etime']-$_SESSION['stime'])*1000;
	$_SESSION['stime']=$time;
	