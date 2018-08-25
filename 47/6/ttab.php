<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.d0{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		display:inline-block;
		margin-top:50px;
	}
</style>
<script src="../5/jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		for(i=1;i<=10;i++){
			if($("#a"+i).text()=='已訂'){
				$("#t"+i).css('background-color','#666');
				$("#t"+i).removeAttr('onClick');
			}
		}
	})
	function cl(da,odj){
		ta=$("#ta").text();
		if(ta>0){
			$(odj).removeAttr('onClick');
			ta=ta-1;
			$("#ta").text(ta);
			$(odj).css('background-color','#6CF');
			tnum=$("[name='tnum']").val();
			tnum=tnum+da+',';
			$("[name='tnum']").val(tnum);
			if(ta==0){
				$("#ok").show();
			}
		}else{
			alert("超過上限");
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
	$tab=$_GET['tab'];
	$menu=$_GET['menu'];
	$d=explode(' ',$day);
	
	for($i=1;$i<=10;$i++){
		$ii=str_pad($i,2,'0',STR_PAD_LEFT);
		$aa=$mysql->query("SELECT * FROM `eat` where `day` = '".$d[0]."' and `tp` = '$tp' and `tnum` like '%".sprintf('%02d',$ii)."%' ");
		if($a=mysqli_fetch_array($aa)){}else{
			$da[]=$ii;
		}
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 - 選擇桌號<p/>
        <div style="width:80%; height:650px; background-color:#FFF; border:#000 solid 1px; border-radius:20px;">
        	<?=$day?><p/>
            <div class="d0" id="t1" onClick="cl('01',this)">
            	1桌<br/><label id="a1"><?php if(in_array('01',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t2" onClick="cl('02',this)">
            	2桌<br/><label id="a2"><?php if(in_array('02',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t3" onClick="cl('03',this)">
            	3桌<br/><label id="a3"><?php if(in_array('03',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t4" onClick="cl('04',this)">
            	4桌<br/><label id="a4"><?php if(in_array('04',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="t5" onClick="cl('05',this)">
            	5桌<br/><label id="a5"><?php if(in_array('05',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t6" onClick="cl('06',this)">
            	6桌<br/><label id="a6"><?php if(in_array('06',$da)){echo'空';}else{echo'已訂';}?></label>
            </div><br/>
            <div class="d0" id="t7" onClick="cl('07',this)">
            	7桌<br/><label id="a7"><?php if(in_array('07',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t8" onClick="cl('08',this)">
            	8桌<br/><label id="a8"><?php if(in_array('08',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t9" onClick="cl('09',this)">
            	9桌<br/><label id="a9"><?php if(in_array('09',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
            <div class="d0" id="t10" onClick="cl('10',this)">
            	10桌<br/><label id="a10"><?php if(in_array('010',$da)){echo'空';}else{echo'已訂';}?></label>
            </div>
        </div><p/>
        <div style="width:80%; height:60px; background-color:#FFF; font-size:30px;">
        	你還可以選<label id="ta"><?=$tab?></label>桌
        </div>
        
        <form method="post" action="index2.php">
        	<input type="hidden" name="day" value="<?=$day?>">
            <input type="hidden" name="tp" value="<?=$tp?>">
            <input type="hidden" name="quan" value="<?=$quan?>">
            <input type="hidden" name="menu" value="<?=$menu?>">
            <input type="hidden" name="tab" value="<?=$tab?>">
            <input type="hidden" name="tnum">
            <input type="submit" id="ok" value="確定選取" style="width:150px; height:100px; font-size:30px;" hidden><p/>
            
            <input type="button" value="取消選取" onClick="location.href='ttab.php?day=<?=$day?>&tp=<?=$tp?>&quan=<?=$quan?>&menu=<?=$menu?>&tab=<?=$tab?>'">
            <input type="button" value="放棄離開" onClick="location.href='index.php'">
        </form>
        
    </h1></center>
    
</body>
</html>