<?php
	include("cd.php");
	$a=$_POST['a'];
	if($a==0){
		$_SESSION['aa']=0;
	}else if($a==1){
		$_SESSION['aa']=$_SESSION['aa']+1;
	}else{
		$_SESSION['aa']=$_SESSION['aa']-1;
	}
	$ii=$_SESSION['aa']*7;
	$mon=date("N")-1;
?>
<table id="big1" bgcolor="#FFFFFF" border="1" width="80%">
	<tr>
    	<th onClick="after()">上一週</th>
        <th bgcolor="#66CCFF"><?=date("Y年m月d日",strtotime(+$ii-$mon."day")).'-'.date("Y年m月d日",strtotime(+$ii+6-$mon."day"))?></th>
        <th onClick="before()">下一週</th>
    </tr>
</table>
<table id="big2" bgcolor="#FFFFFF" border="1" width="80%">
	<tr height="100px" bgcolor="#66CCFF">
    	<th width="12.5%"></th>
        <th width="12.5%">一<br/><?=date("d",strtotime(+$ii-$mon."day"))?></th>
        <th width="12.5%">二<br/><?=date("d",strtotime(+$ii+1-$mon."day"))?></th>
        <th width="12.5%">三<br/><?=date("d",strtotime(+$ii+2-$mon."day"))?></th>
        <th width="12.5%">四<br/><?=date("d",strtotime(+$ii+3-$mon."day"))?></th>
        <th width="12.5%">五<br/><?=date("d",strtotime(+$ii+4-$mon."day"))?></th>
        <th width="12.5%">六<br/><?=date("d",strtotime(+$ii+5-$mon."day"))?></th>
        <th width="12.5%">日<br/><?=date("d",strtotime(+$ii+6-$mon."day"))?></th>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">午餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(+$ii+$i-$mon."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '午餐'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten==0){
				echo '<th class="a">已無座位</th>';
			}else{
				echo '<th class="a" onClick="cli(\''.$day.'\',\'午餐\','.$ten.','.$i.',this)">'.$ten.'</th>';
			}
		}
		?>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">下午茶<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(+$ii+$i-$mon."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '下午茶'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten==0){
				echo '<th class="a">已無座位</th>';
			}else{
				echo '<th class="a" onClick="cli(\''.$day.'\',\'下午茶\','.$ten.','.$i.',this)">'.$ten.'</th>';
			}
		}
		?>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">晚餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(+$ii+$i-$mon."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '晚餐'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten==0){
				echo '<th class="a">已無座位</th>';
			}else{
				echo '<th class="a" onClick="cli(\''.$day.'\',\'晚餐\','.$ten.','.$i.',this)">'.$ten.'</th>';
			}
		}
		?>
    </tr>
</table>