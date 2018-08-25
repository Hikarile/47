<?php
	include("cd.php");
	$a=$_POST['a'];
	$id=$_POST['id'];
	$mon=date("N")-1;
	$ss=date("Y-m-d",strtotime(-$mon."day"));
	
	if($a==0){
		if($_POST['dd']!=''){
			$s=strtotime($ss);
			$e=strtotime($_POST['dd']);
			$_SESSION['a']=($e-$s)/3600/24/7;
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
<table id="big1" border="1" width="80%" bgcolor="#FFFFFF">
	<tr>
    	<th onClick="ab(2)">上一週</th>
        <th bgcolor="#66CCFF"><?=date("Y年m月d日",strtotime(-$mon+$ii."day")).'-'.date("Y年m月d日",strtotime(-$mon+6+$ii."day"))?></th>
        <th onClick="ab(1)">下一週</th>
    </tr>
</table>
<table id="big2" border="1" width="80%" bgcolor="#FFFFFF">
	<tr height="100px" bgcolor="#66CCFF">
    	<th width="12.5%"></th>
        <th width="12.5%">一<br/><?=date("d",strtotime(-$mon+$ii."day"))?></th>
        <th width="12.5%">二<br/><?=date("d",strtotime(-$mon+1+$ii."day"))?></th>
        <th width="12.5%">三<br/><?=date("d",strtotime(-$mon+2+$ii."day"))?></th>
        <th width="12.5%">四<br/><?=date("d",strtotime(-$mon+3+$ii."day"))?></th>
        <th width="12.5%">五<br/><?=date("d",strtotime(-$mon+4+$ii."day"))?></th>
        <th width="12.5%">六<br/><?=date("d",strtotime(-$mon+5+$ii."day"))?></th>
        <th width="12.5%">日<br/><?=date("d",strtotime(-$mon+6+$ii."day"))?></th>
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
				if($id!=$a['id']){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
			?><th class="a" day="<?=$day?>" tp="午餐">已無座位</th><?php
			}else{
			?><th class="a" day="<?=$day?>" tp="午餐" onClick="cli('<?=$day?>','午餐','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th><?php
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
				if($id!=$a['id']){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
			?><th class="a" day="<?=$day?>" tp="下午茶">已無座位</th><?php
			}else{
			?><th class="a" day="<?=$day?>" tp="下午茶" onClick="cli('<?=$day?>','下午茶','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th><?php
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
				if($id!=$a['id']){
					$cont=$cont+$a['tab'];
				}
			}$ten=10-$cont;
			if($ten<=0){
			?><th class="a" day="<?=$day?>" tp="晚餐">已無座位</th><?php
			}else{
			?><th class="a" day="<?=$day?>" tp="晚餐" onClick="cli('<?=$day?>','晚餐','<?=$ten?>','<?=$i?>','<?=$dd?>',this)"><?=$ten?></th><?php
			}
		}
		?>
    </tr>
</table>