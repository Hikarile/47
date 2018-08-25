<?php
	include("include.php");
	$a=$_POST['a'];
	
	if($a==0){
		$_SESSION['n']=0;
	}else if($a == 1){
		$_SESSION['n']=$_SESSION['n']+1;
	}else{
		$_SESSION['n']=$_SESSION['n']-1;
	}
	
	$mon=date("N")-1;
	$ii=$_SESSION['n']*7;
	$day=date("Y年m月d日",strtotime(-$mon+$ii."day"))."-".date("Y年m月d日",strtotime(-$mon+6+$ii."day"));
	
?>
<table border="1" width="80%" id="big1">
	<tr bgcolor="#33CCFF">
    	<th onClick="before()">前一周</th>
        <th><?=$day?></th>
        <th onClick="after()">後一周</th>
    </tr>
</table>
<table border="1" width="80%" id="big2">
	<tr>
    	<th width="15%"></th>
        <th bgcolor="#0099FF" width="12.5%">一<br/><?=date("d",strtotime(-$mon+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">二<br/><?=date("d",strtotime(-$mon+1+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">三<br/><?=date("d",strtotime(-$mon+2+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">四<br/><?=date("d",strtotime(-$mon+3+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">五<br/><?=date("d",strtotime(-$mon+4+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">六<br/><?=date("d",strtotime(-$mon+5+$ii."day"))?></th>
        <th bgcolor="#0099FF" width="12.5%">日<br/><?=date("d",strtotime(-$mon+6+$ii."day"))?></th>
    </tr>
    <tr>
    	<th bgcolor="#0099FF">午餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$d=date("Y-m-d",strtotime($ii+$i-$mon."day"));
			$count=0;
			$ten=0;
			$bb=$mysql->query("SELECT * FROM `eat` where `day` = '$d' and `tp` = '午餐'");
			while($b=mysqli_fetch_array($bb)){
				$count=$count+$b['tab'];
			}
			$ten=10-$count;
			if($ten == 0){
				echo"<th class='a'>已無座位</th>";
			}else{
				echo "<th class='a' onClick='cli(\"午餐\",\"".date("Y-m-d",strtotime(-$mon+$ii+$i."day"))."\",".$ten.",".$i.",this)'>".$ten."</th>";
			}
		}
		?>
    </tr>
    <tr>
    	<th bgcolor="#0099FF">下午茶<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$d=date("Y-m-d",strtotime($ii+$i-$mon."day"));
			$count=0;
			$ten=0;
			$bb=$mysql->query("SELECT * FROM `eat` where `day` = '$d' and `tp` = '下午茶'");
			while($b=mysqli_fetch_array($bb)){
				$count=$count+$b['tab'];
			}
			$ten=10-$count;
			if($ten == 0){
				echo"<th class='a'>已無座位</th>";
			}else{
				echo "<th class='a' onClick='cli(\"下午茶\",\"".date("Y-m-d",strtotime(-$mon+$ii+$i."day"))."\",".$ten.",".$i.",this)'>".$ten."</th>";
			}
		}
		?>
    </tr>
    <tr>
    	<th bgcolor="#0099FF">晚餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$d=date("Y-m-d",strtotime($ii+$i-$mon."day"));
			$count=0;
			$ten=0;
			$bb=$mysql->query("SELECT * FROM `eat` where `day` = '$d' and `tp` = '晚餐'");
			while($b=mysqli_fetch_array($bb)){
				$count=$count+$b['tab'];
			}
			$ten=10-$count;
			if($ten == 0){
				echo"<th class='a'>已無座位</th>";
			}else{
				echo "<th class='a' onClick='cli(\"晚餐\",\"".date("Y-m-d",strtotime(-$mon+$ii+$i."day"))."\",".$ten.",".$i.",this)'>".$ten."</th>";
			}
		}
		?>
    </tr>
</table>