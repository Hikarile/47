<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.d0{
		width:20%;
		height:100px;
		border: #000 solid 1px;
		border-radius:20px;
		margin-top:20px;
		display:inline-block;
	}
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		for(i=1;i<=10;i++){
			if($("#d"+i+" label").text()=='已訂'){
				$("#d"+i).css('background-color','#666');
				$("#d"+i).removeAttr('onClick');
			}
		}
	})
	function cli(da,odj){
		aa=$("#aa").text();
		if(aa!=''){
			aa=aa-1;
			$("#aa").text(aa);
			tnum=$("#tnum").val();
			tnum=tnum+da+',';
			tnum=$("#tnum").val(tnum);
			$(odj).css('background-color','#3C9');
			if(aa == 0){
				$("#ok").show();
			}
		}else{
			alert("無法選擇");
			return false;
		}
	}
</script>
</head>
<?php
	include("cd.php");
	$day=$_GET['day'];
	$tp=$_GET['tp'];
	$quan=$_GET['quan'];
	$menu=$_GET['menu'];
	$tab=$_GET['tab'];
	$c=$_GET['c'];
	$d=explode(' ',$day);
	
	for($i=1;$i<=10;$i++){
		$ii=str_pad($i,2,'0',STR_PAD_LEFT);
		$aa=$mysql->query("SELECT * FROM `eat` where `day` = '".$d[0]."' and `tp` = '$tp' and `tnum` like '%".sprintf('%02d',$ii)."%'");
		if($a=mysqli_fetch_array($aa)){}else{
			$da[]=$ii;
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 選擇桌號<p/>
        
        <div style="width:80%; height:600px; border-radius:20px; border:#000 solid 1px; background-color:#FFF;">
        	<?=$day?><p/>
        	<div class="d0" id="d1" onClick="cli('01',this)">
            	1桌<br/><label><?php if(in_array('01',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d2" onClick="cli('02',this)">
            	2桌<br/><label><?php if(in_array('02',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d3" onClick="cli('03',this)">
            	3桌<br/><label><?php if(in_array('03',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d4" onClick="cli('04',this)">
            	4桌<br/><label><?php if(in_array('04',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="d5" onClick="cli('05',this)">
            	5桌<br/><label><?php if(in_array('05',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d6" onClick="cli('06',this)">
            	6桌<br/><label><?php if(in_array('06',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="d7" onClick="cli('07',this)">
            	7桌<br/><label><?php if(in_array('07',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d8" onClick="cli('08',this)">
            	8桌<br/><label><?php if(in_array('08',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d9" onClick="cli('09',this)">
            	9桌<br/><label><?php if(in_array('09',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d10" onClick="cli('10',this)">
            	10桌<br/><label><?php if(in_array('10',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><p/>
            可以選<label id="aa"><?=$tab?></label>桌
        </div>
        
        <form method="post" action="index2.php">
        	<input type="hidden" name="day" value="<?=$day?>">
            <input type="hidden" name="tp" value="<?=$tp?>">
            <input type="hidden" name="quan" value="<?=$quan?>">
            <input type="hidden" name="menu" value="<?=$menu?>">
            <input type="hidden" name="tab" value="<?=$tab?>">
            <input type="hidden" name="c" value="<?=$c?>">
            <input type="hidden" id="tnum" name="tnum">
            <input type="submit" value="確定選取" id="ok" hidden><p/>
            <input type="button" value="取消選取" onClick="location.href='ttab.php?day=<?=$day?>&tp=<?=$tp?>&quan=<?=$quan?>&menu=<?=$menu?>&tab=<?=$tab?>&c=<?=$c?>'">
            <input type="button" value="放棄離開" onClick="location.href='index.php'">
        </form>
    </h1></center>
</body>
</html>