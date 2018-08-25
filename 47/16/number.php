<?php
	include("cd.php");
	
	$n=array(0,1,2,3,4,5,6,7,8,9);
	shuffle($n);
	
	for($i=1;$i<=4;$i++){
		echo $number=$n[$i].',';
	}
?>