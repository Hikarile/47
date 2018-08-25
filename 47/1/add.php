<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	$_SESSION['number']=$_SESSION['number']+1;
	
	$day=$_POST['day'];
	$number=$_POST['number'];
	$tp=$_POST['tp'];
	$quan=$_POST['quan'];
	$menu=$_POST['menu'];
	$tab=$_POST['tab'];
	$tnum=$_POST['tnum'];
	$money=$_POST['money'];
	$moneymoney=$_POST['moneymoney'];
	
	$bo=str_pad($_SESSION['number'],4,0,STR_PAD_LEFT);
	$n=$number.$bo;
	
	$mysql->query("INSERT INTO `eat` (`number`, `day`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$n', '$day', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
	$id=mysqli_insert_id($mysql);
	header("location:index3.php?id=".$id);
?>