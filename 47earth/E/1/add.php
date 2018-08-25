<?php
	include('cd.php');
	
	$aa=$mysql->query("SELECT * FROM `text`order by `id` DESC limit 1");
	$a=mysqli_fetch_array($aa);
	if($a==''){
		$text_number='0000000';
	}else{
		$text_number=str_pad($a['text_number']+1,8,'0',STR_PAD_LEFT);
	}
	
	if($_POST['ok'] == '????'){
		$ok='????';
	}else{
		$ok='???';
	}
	
	$mysql->query("INSERT INTO `text` (`text_number`, `status`, `time1`, `time2`) VALUES ('".$text_number."', '$ok', '".$_POST['time1']."', '".$_POST['time2']."')");
	$id=mysqli_insert_id($mysql);
	
	for($i=1;$i<=$_POST['ppp'];$i++){
		$correct='';
		$da='';
		$q=$_POST['q'][$i];
		$type=$_POST['type'][$i];
		
		if($type == '2'){
			for($j=1;$j<=4;$j++){
				$da=$da.$_POST['n'.$i.'2'][$j].',';
				if($_POST['okda'.$i.'2'] == $j){
					$correct=$_POST['n'.$i.'2'][$j];
				}
			}
		}else if($type == '3'){
			for($j=1;$j<=$_POST['number'][$i];$j++){
				$da=$da.$_POST['n'.$i.'3'][$j].',';
				foreach($_POST['okda'.$i.'3'] as $k =>$ok){
					if($k == $j){
						$correct=$correct.$_POST['n'.$i.'3'][$j].',';
					}
				}
			}
		}else{
			$correct=$_POST['okda'.$i.'1'];
			$da='';
		}
		$mysql->query("INSERT INTO `qa` (`text_id`, `q`, `type`, `da`,`correct`) VALUES ('$id', '$q', '$type', '$da','$correct')");
	}
	header('location:menu.php');