<?php
	include("cd.php");
	
	$qq=$mysql->query("SELECT * FROM `qa` where `text_id`  = '".$_SESSION['textid']."'");
	$i=0;
	while($qa=mysqli_fetch_array($qq)){
		$i++;
		$_SESSION['qid'][$i]=$qa['id'];
		$_SESSION['q'][$i]=$qa['q'];
		$_SESSION['type'][$i]=$qa['type'];
		$_SESSION['da'][$i]=$qa['da'];
		$_SESSION['correct'][$i]=$qa['correct'];
		$_SESSION['t1'][$i]=$qa['time1'];
		$_SESSION['t2'][$i]=$qa['time2'];
	}
	$_SESSION['count']=$i;
	$_SESSION['ga']=1;
	$_SESSION['ok']=array();
	
	$_SESSION['null_text']=0;
	$_SESSION['no_text']=0;
	$_SESSION['yes_text']=0;
	
	header("location:text.php");
	
	