<?php
	include("cd.php");
	
	$_SESSION['out']='out';
	
	$ms=explode(' ',microtime("now"));
	$time=$ms[0]+$ms[1];
	
	$_SESSION['etime']=$time;
	$_SESSION['time']=($_SESSION['etime']-$_SESSION['stime'])*1000;
	$_SESSION['stime']=$time;
	
	