<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		for(i=1;i<=10;i++){
			text=$("#a"+i).text();
			if(text == "已訂"){
				$("#t"+i).css('background-color','#333');
				$("#t"+i).removeAttr('onclick');
			}
		}
	})
	function c(i,odj){
		var text=$("#text").text();
		var da=$("[name=da]").val();
		var oo=0;
		if(text >0){
			$(odj).css('background-color','#39C');
			$(odj).removeAttr('onclick');
			da=da+i+',';
			oo=text-1;
		}else{
			alert("你已選取完畢");
			return false;
		}
		$("[name=da]").val(da);
		$("#text").text(oo);
		if(oo ==0){
			$("#su").show();
		}
	}
	function subm(day,tp,tab,quan,menu,mon){	
		var tnum=$("[name=da]").val();
		location.href='index2.php?day='+day+'&tp='+tp+'&tab='+tab+'&quan='+quan+'&menu='+menu+'&tnum='+tnum+'&mon='+mon;
	}
</script>
<style>
	.bot{
		width:120px;
		height:70px;
		font-size:20px;
	}
	.div{
		border:#000 solid 1px;
		background-color:#FFF;
		width:60%;
		height:500px;
	}
	.d1{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		display:inline-block;
		margin-right:20px;
		margin-top:25px;
	}
	.d5{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		display:inline-block;
		margin-right:20px;
		margin-top:25px;
	}
	.d6{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		display:inline-block;
		margin-right:20px;
		margin-top:25px;
	}
</style>
</head>
<?php
	include("include.php");
	$day=$_GET['day'];
	$tp=$_GET['tp'];
	$tab=$_GET['tab'];
	$quan=$_GET['quan'];
	$menu=$_GET['menu'];
	$mon=$_GET['mon'];
	
	for($i=1;$i<=10;$i++){
		$ii=str_pad($i,2,'0',STR_PAD_LEFT);
		$aa=$mysql->query("SELECT * FROM `eat` where `day` = '$day' and `tp` = '$tp' and `tnum` like '%".sprintf('%02d',$ii)."%'");
		if($a=mysqli_fetch_array($aa)){}else{
			$nu[]=$ii;
		}
	}
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	選擇桌號<p/>
        <div class="div">
        	<?=$day?><p/>
        	<div class="d1" id="t1" onClick="c('01',this)">
            	1號桌<br/><label id="a1"><?php if(in_array('01',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t2" onClick="c('02',this)">
            	2號桌<br/><label id="a2"><?php if(in_array('02',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t3" onClick="c('03',this)">
            	3號桌<br/><label id="a3"><?php if(in_array('03',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t4" onClick="c('04',this)">
            	4號桌<br/><label id="a4"><?php if(in_array('04',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div><br/>
            <div class="d5" id="t5" onClick="c('05',this)">
            	5號桌<br/><label id="a5"><?php if(in_array('05',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d6" id="t6" onClick="c('06',this)">
            	6號桌<br/><label id="a6"><?php if(in_array('06',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div><br/>
            <div class="d1" id="t7" onClick="c('07',this)">
            	7號桌<br/><label id="a7"><?php if(in_array('07',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t8" onClick="c('08',this)">
            	8號桌<br/><label id="a8"><?php if(in_array('08',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t9" onClick="c('09',this)">
            	9號桌<br/><label id="a9"><?php if(in_array('09',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
            <div class="d1" id="t10" onClick="c('10',this)">
            	10號桌<br/><label id="a10"><?php if(in_array('10',$nu)){echo"空";}else{echo "已訂";}?></label>
            </div>
        </div><br/>
        
        <div style=" width:50%; height:50px; font-size:45px; background-color:#FFF;">
        	你可以再選<label id="text"><?=$tab?></label>桌
        </div><p/>
        
        <input type="hidden" name="da">
        <input class="bot" type="button" value="確定選取" onClick="subm('<?=$day?>','<?=$tp?>','<?=$tab?>','<?=$quan?>','<?=$menu?>','<?=$mon?>')" id="su" hidden><br/>
        <input class="bot" type="button" value="取消選取" onClick="location.href='ttab.php?day=<?=$day?>&tp=<?=$tp?>&tab=<?=$tab?>&quan=<?=$quan?>&menu=<?=$menu?>'">
        <input class="bot" type="button" value="放棄選取" onClick="location.href='index.php'">
    </h1></center>
    
</body>
</html>