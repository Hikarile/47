<style>
	.but{
		width:100%;
		height:30px
		 border:#000 solid 1px;
		 font-size:20px;
	}
</style>
<?php
	include("cd.php");
	$a=$_POST['a'];
	if($a==0){
		$_SESSION['mon']=0;
	}else if($a==1){
		$_SESSION['mon']=$_SESSION['mon']+1;
	}else{
		$_SESSION['mon']=$_SESSION['mon']-1;
	}
	
	$m=$_SESSION['mon'];   //要幾月
	$today=date("Y-m-d",strtotime($m."month"));  //當月當天日期
	$ms=date('Y-m-01', strtotime($today));   //這月第一天日期
	echo $day=date('t', strtotime("$ms"));      //這個月有幾天
	
 	$start=date('w', strtotime($ms));
?>
<table id="big1" width="70%" border="1" bgcolor="#FFFFFF">
	<tr>
    	<th onClick="ab(2)">上一個月</th>
        <th bgcolor="#66CCFF"><?=date("Y-m",strtotime("$today"))?>月</th>
        <th onClick="ab(1)">下一個月</th>
    </tr>
</table>
<table id="big2" border="1" bgcolor="#FFFFFF" width="70%">
	<tr bgcolor="#66CCFF" height="100px">
    	<th width="12.5%">日</th>
        <th width="12.5%">一</th>
    	<th width="12.5%">二</th>
        <th width="12.5%">三</th>
        <th width="12.5%">四</th>
        <th width="12.5%">五</th>
        <th width="12.5%">六</th>
    </tr>
    <tr height="100px">
    <?php
    for($i=1;$i<=$start;$i++){
		$s++;
		echo'<th></th>';
		if($s==7){
			echo'</tr><tr height="100px">';
			$s=0;
		}
	}
	?>
    <?php
    for($i=0;$i<=$day-1;$i++){
		$s++;
		$d=date("Y-m-d",strtotime("$ms + $i day"));
		
		$mon=array('午餐','下午茶','晚餐');
		
		for($j=0;$j<=2;$j++){
			$cont=0;
			$aa=$mysqli->query("SELECT * FROM `eat` where `day` = '$d' and `tp` = '".$mon[$j]."'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}
			$ten[$j]=10-$cont;
		}
		?>
        <th>
			<?=$i+1?><br/>
            <button class="a but" onClick="cli('<?=$d?>','午餐','<?=$ten[0]?>','<?=$s?>','<?=date("m",strtotime("$today"))?>',this)">午餐<br/>可訂桌數:<?=$ten[0]?></button><br/>
            <button class="a but" onClick="cli('<?=$d?>','下午茶','<?=$ten[1]?>','<?=$s?>','<?=date("m",strtotime("$today"))?>',this)">下午茶<br/>可訂桌數:<?=$ten[1]?></button><br/>
            <button class="a but" onClick="cli('<?=$d?>','晚餐','<?=$ten[2]?>','<?=$s?>','<?=date("m",strtotime("$today"))?>',this)">晚餐<br/>可訂桌數:<?=$ten[2]?></button>
        </th>
		<?php
		if($s==7){
			if($i!=$day-1){
				echo'</tr><tr height="100px">';
				$s=0;
			}
		}
	}
	$s=7-$s;
	if($s!=0 && $s!=7){
		for($k=1;$k<=$s;$k++){
			echo'<th></th>';
		}
	}
	?>
    
    </tr>
</table>