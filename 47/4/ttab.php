<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="../3/jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		for(i=1;i<=10;i++){
			if($("#a"+i).text() == '已訂'){
				$("#d"+i).css('background-color','#666');
				$("#d"+i).removeAttr('onClick');
			}
		}
	})
	function cli(da,odj){
		tab=$("#pp").text();
		tnum=$("[name='tnum']").val();
		if(tab >0){
			$(odj).css('background-color','#6CF');
			tnum=tnum+da+',';
			tab=tab-1;
			$("#pp").text(tab);
			$("[name='tnum']").val(tnum);
			if(tab==0){
				$("#ok").show();
			}
		}else{
			alert("無法選擇");
			return false;
		}
	}
</script>
<style>
	.d0{
		width:20%;
		height:120px;
		border:#000 solid 1px;
		border-radius:20px;
		display:inline-block;
		margin-top:50px;
	}
</style>
</head>
<?php
	include("cd.php");
	$day=$_GET['day'];
	$d=explode(' ',$day);
	
	for($i=1;$i<=10;$i++){
		$ii=str_pad($i,2,'0',STR_PAD_LEFT);
		$aa=$mysql->query("SELECT * FROM `eat` where `day` = '".$d[0]."' and `tp` = '".$_GET['tp']."' and `tnum` like '%".sprintf('%02d',$ii)."%'");
		if($a=mysqli_fetch_array($aa)){}else{
			$da[]=$ii;
		}
	}
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 - 選擇桌號<p/>
        
        <div style="width:80%; height:600px; border:#000 solid 1px; border-radius:20px; background-color:#FFF">
        	<?=$day?><br/>
        	<div class="d0" id="d1" onClick="cli('01',this)">
            	1桌<br/><label id="a1"><?php if(in_array('01',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d2" onClick="cli('02',this)">
            	2桌<br/><label id="a2"><?php if(in_array('02',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d3" onClick="cli('03',this)">
            	3桌<br/><label id="a3"><?php if(in_array('03',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d4" onClick="cli('04',this)">
            	4桌<br/><label id="a4"><?php if(in_array('04',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="d5" onClick="cli('05',this)">
            	5桌<br/><label id="a5"><?php if(in_array('05',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d6" onClick="cli('06',this)">
            	6桌<br/><label id="a6"><?php if(in_array('06',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="d7" onClick="cli('07',this)">
            	7桌<br/><label id="a7"><?php if(in_array('07',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d8" onClick="cli('08',this)">
            	8桌<br/><label id="a8"><?php if(in_array('08',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d9" onClick="cli('09',this)">
            	9桌<br/><label id="a9"><?php if(in_array('09',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="d10" onClick="cli('10',this)">
            	10桌<br/><label id="a10"><?php if(in_array('10',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
        </div><p/>
        <div style="width:80%; height:50px; font-size:40px; background-color:#FFF;">
        	你可以再選<label id="pp"><?=$_GET['tab']?></label>桌
        </div>
        
        
        <form method="post" action="../3/index2.php">
        	<input type="hidden" name="day" value="<?=$_GET['day']?>">
            <input type="hidden" name="tp" value="<?=$_GET['tp']?>">
            <input type="hidden" name="quan" value="<?=$_GET['quan']?>">
            <input type="hidden" name="menu" value="<?=$_GET['menu']?>">
            <input type="hidden" name="tab" value="<?=$_GET['tab']?>">
            <input type="hidden" name="tnum">
            <input style="width:175px; height:100px; font-size:30px;" id="ok" type="submit" value="確定選取" hidden><p/>
            <input type="button" value="取消選取" onClick="location.href='ttab.php?day=<?=$_GET['day']?>&tp=<?=$_GET['tp']?>&quan=<?=$_GET['quan']?>&menu=<?=$_GET['menu']?>&tab=<?=$_GET['tab']?>'">
            <input type="button" value="放棄離開" onClick="location.href='index.php'">
        </form>
        
    </h1></center>
    
</body>
</html>