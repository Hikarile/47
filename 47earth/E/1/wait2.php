<?php
	include('cd.php');
	
	$t=$mysql->query("SELECT * FROM `text` where `text_number` = '".$_SESSION['number']."'");
	$text=mysqli_fetch_array($t);
	
	$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '".$text['id']."'");
	$i='0';
	while($qa=mysqli_fetch_array($q)){
		$i+=1;
		
		$_SESSION['qaid'][$i]=$qa['id'];
		$_SESSION['q'][$i]=$qa['q'];
		$_SESSION['type'][$i]=$qa['type'];
		
		if($qa['type'] == '2'){
			$d=explode(',',$qa['da']);
			foreach($d as $j=>$dd){
				if($dd !=''){
					$_SESSION['da'][$i][$j]=$dd;
				}
			}
			$_SESSION['correct'][$i]=$qa['correct'];
		}if($qa['type'] == '3'){
			$d=explode(',',$qa['da']);
			foreach($d as $j=>$dd){
				if($dd !=''){ 
					$_SESSION['da'][$i][$j]=$dd;
				}
			}
			$_SESSION['correct'][$i]=$qa['correct'];
		}else{
			$_SESSION['correct'][$i]=$qa['correct'];
		}
		$_SESSION['t1'][$i]=$qa['time1'];
		$_SESSION['t2'][$i]=$qa['time2'];
	}
	
	$_SESSION['count']=$i;
	$_SESSION['ga']='1';
	$_SESSION['ok']=array();
	
	$_SESSION['null_text']='0';
	$_SESSION['no_text']='0';
	$_SESSION['yes_text']='0';
	
	header('location:test.php');
?>