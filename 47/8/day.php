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
<table id="big1" border="1" width="80%" bgcolor="#FFFFFF">
    <tr>
        <th onClick="after()">上一週</th>
        <th bgcolor="#66CCFF"><?=date("Y年m月d日",strtotime(-$mon+$ii."day"))."-".date("Y年m月d日",strtotime(-$mon+6+$ii."day"))?></th>
        <th onClick="before()">下一週</th>
    </tr>
</table>
<table id="big2" width="80%" border="1" bgcolor="#FFFFFF">
	<tr bgcolor="#66CCFF" height="100px">
    	<th width="10%"></th>
        <th width="10%">一<br/><?=date("d",strtotime(-$mon+$ii."day"))?></th>
        <th width="10%">二<br/><?=date("d",strtotime(-$mon+1+$ii."day"))?></th>
        <th width="10%">三<br/><?=date("d",strtotime(-$mon+2+$ii."day"))?></th>
        <th width="10%">四<br/><?=date("d",strtotime(-$mon+3+$ii."day"))?></th>
        <th width="10%">五<br/><?=date("d",strtotime(-$mon+4+$ii."day"))?></th>
        <th width="10%">六<br/><?=date("d",strtotime(-$mon+5+$ii."day"))?></th>
        <th width="10%">日<br/><?=date("d",strtotime(-$mon+6+$ii."day"))?></th>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">午餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '午餐'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten!=0){
			?>
			<th class="a" onClick="cli('<?=$day?>','午餐','<?=$ten?>','<?=$i?>',this)"><?=$ten?></th>
			<?php
			}else{
				echo'<th class="a">已無座位</th>';
			}
		}
		?>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">下午茶<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '下午茶'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten!=0){
			?>
			<th class="a" onClick="cli('<?=$day?>','下午茶','<?=$ten?>','<?=$i?>',this)"><?=$ten?></th>
			<?php
			}else{
				echo'<th class="a">已無座位</th>';
			}
		}
		?>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">晚餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '晚餐'");
			while($a=mysqli_fetch_array($aa)){
				$cont=$cont+$a['tab'];
			}$ten=10-$cont;
			if($ten!=0){
			?>
			<th class="a" onClick="cli('<?=$day?>','晚餐','<?=$ten?>','<?=$i?>',this)"><?=$ten?></th>
			<?php
			}else{
				echo'<th class="a">已無座位</th>';
			}
		}
		?>
    </tr>
</table>