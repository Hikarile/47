<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	$day=$_GET['day'];
	$tp=$_GET['tp'];
	if($tp == 1){
		$ttpp="午餐";
	}else if($tp == 2){
		$ttpp="下午茶";
	}else{
		$ttpp="晚餐";
	}
	
	for($i=1;$i<=10;$i++){
		$aa=$mysql->query("select * from `eat` where `day`='$day' and `tp`='$ttpp' and `tnum` like '%".sprintf('%01d', $i)."%'");
		if($a=mysqli_fetch_array($aa)){}else{
			$nu[]=$i;
		}
	}
	echo $nu[0];
	
?>