<?php
	include("cd.php");
	
	$day=$_POST['day'];
	$tp=$_POST['tp'];
	$tab=$_POST['tab'];
	$id=$_POST['id'];
	$d=explode(" ",$day);
	for($i=1;$i<=10;$i++){
		$ii=str_pad($i,2,'0',STR_PAD_LEFT);
		$aa=$mysqli->query("SELECT * FROM `eat` where `day` = '".$d[0]."' and `tp` = '$tp' and `tnum` like '%".sprintf('%02d',$ii)."%'");
		if($a=mysqli_fetch_array($aa)){
			if($a['id']==$id){
				$da[]=$ii;
			}
		}else{
			$da[]=$ii;
		}
	}
	for($j=0;$j<=$tab-1;$j++){
		echo $da[$j].',';
	}
	
?>