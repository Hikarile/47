<?php
	include("cd.php");
	$id=$_POST['id'];
	$a=$_POST['a'];
	$mon=date("N")-1;
	$ss=date("Ymd",strtotime(-$mon."day"));
	
	if($a==0){
		if($_POST['se']!=''){
			$sd=strtotime($_POST['se']);
			$se=strtotime($ss);
			$_SESSION['a']=($sd-$se)/3600/24/7;
		}else{
			$_SESSION['a']=0;
		}
	}else if($a==1){
		$_SESSION['a']=$_SESSION['a']+1;
	}else{
		$_SESSION['a']=$_SESSION['a']-1;
	}
	$ii=$_SESSION['a']*7;
	
?>
<table id="big1" border="1" bgcolor="#FFFFFF" width="80%">
	<tr>
    	<th onClick="ab(2)">上一週</th>
        <th bgcolor="#66CCFF"><?=date("Y年m月d日",strtotime(-$mon+$ii."day")).'-'.date("Y年m月d日",strtotime(-$mon+6+$ii."day"))?></th>
        <th onClick="ab(1)">下一週</th>
    </tr>
</table>
<table id="big2" border="1" bgcolor="#FFFFFF" width="80%">
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
			$day=date("Y-m-d",strtotime(-$mon+$i+$ii."day"));
			$dd=date("Ymd",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '午餐'");
			while($a=mysqli_fetch_array($aa)){
				if($a['id']!=$id){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
				echo'<th class="a">已無坐位</th>';
			}else{
		?><th class="a" day="<?=$day?>" tp="午餐" onClick="cli('<?=$day?>','午餐','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th>
		<?php
			}
		}
		?>
    </tr>
      <tr height="100px">
    	<th bgcolor="#66CCFF">下午茶<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(-$mon+$i+$ii."day"));
			$dd=date("Ymd",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '下午茶'");
			while($a=mysqli_fetch_array($aa)){
				if($a['id']!=$id){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
				echo'<th class="a">已無坐位</th>';
			}else{
				?><th class="a" day="<?=$day?>" tp="下午茶" onClick="cli('<?=$day?>','下午茶','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th>
		<?php
			}
		}
		?>
    </tr>
    <tr height="100px">
    	<th bgcolor="#66CCFF">晚餐<br/>(可訂桌數)</th>
        <?php
        for($i=0;$i<=6;$i++){
			$day=date("Y-m-d",strtotime(-$mon+$i+$ii."day"));
			$dd=date("Ymd",strtotime(-$mon+$ii."day"));
			$cont=0;
			$ten=0;
			$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '晚餐'");
			while($a=mysqli_fetch_array($aa)){
				if($a['id']!=$id){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
				echo'<th class="a">已無坐位</th>';
			}else{
				?><th class="a" day="<?=$day?>" tp="晚餐" onClick="cli('<?=$day?>','午餐','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th>
		<?php
			}
		}
		?>
    </tr>
</table>