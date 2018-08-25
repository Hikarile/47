<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	$day=$_GET['day'];
	$number=$_GET['number'];
	$quan=$_GET['quan'];
	$ttp=$_GET['tp'];
	$menu=$_GET['menu'];
	$aaa=$_GET['aaa'];
	
	if($_GET['tp'] == 1){
		$tp="午餐";
	}else if($_GET['tp'] == 2){
		$tp="下午茶";
	}else{
		$tp="晚餐";
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	var tab=0;
	$(function(){
		for(i=1;i<=10;i++){
			text=$("#text"+i).text();
			if(text == "已訂"){
				$("#t"+i).css('background-color','#333');
				$("#t"+i).removeAttr('onclick');
			}
		}
	});
	
	function c(i){
		if($("#t"+i).attr('a')){
			return false;
		}else{
			$("#t"+i).css('background-color','#3CF');
			$("#t"+i).attr('a','1');
			tab=tab+1;
			tnum=$("#tnum").val();
			if(tnum == ""){
				$("#tab").val(tab);
				$("#tnum").val(i);
			}else{
				tnum=tnum+','+i;
				$("#tab").val(tab);
				$("#tnum").val(tnum);
			}
		}
	}
</script>
<style>
	#button{
		width:100%;
		height:50px;
		font-size:35px;
		background-color:#39F;
	}
	#big{
		width: 50%;
		background-color:#FFF;
		border:#000 solid 3px;
		text-align: center;
	}
	.small{
		display: inline-block;
		border: 1px solid #000;
		width: 150px;
		height: 100px;
		margin: 20px;
		margin-right: 100px;
	}
	.small5{
		display: inline-block;
		border: 1px solid #000;
		width: 150px;
		height: 100px;
		margin: 20px;
		margin-right: 100px;
	}
	.small6{
		display: inline-block;
		border: 1px solid #000;
		width: 150px;
		height: 100px;
		margin: 20px;
		margin-left: 100px;
	}
</style>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 -- 選擇桌號<p/>
        
        <div id="big">
        	<?=$day?>
			<div>
            	<?php
				$table=array();
				$aa=$mysql->query("select * from `eat` where `day`='$day' and `tp`='$tp'");
                while($a=mysqli_fetch_array($aa)){
					$t=explode(',',$a['tnum']);
					foreach($t as $tt){
						$table[]=$tt;
					}
				}
				?>
            	<div id="t1" class="small" onClick="c(1)">1號桌<br/><label id="text1"><?php if(in_array('1', $table)){echo "已訂";}else{echo"空";}?></label> </div>
				<div id="t2" class="small" onClick="c(2)">2號桌<br/><label id="text2"><?php if(in_array('2', $table)){echo "已訂";}else{echo"空";}?></label> </div>
                <div id="t3" class="small" onClick="c(3)">3號桌<br/><label id="text3"><?php if(in_array('3', $table)){echo "已訂";}else{echo"空";}?></label> </div>
                <div id="t4" class="small" onClick="c(4)">4號桌<br/><label id="text4"><?php if(in_array('4', $table)){echo "已訂";}else{echo"空";}?></label> </div><br/>
                <div id="t5" class="small5" onClick="c(5)">5號桌<br/><label id="text5"><?php if(in_array('5', $table)){echo "已訂";}else{echo"空";}?></label> </div>
                <div id="t6" class="small6" onClick="c(6)">6號桌<br/><label id="text6"><?php if(in_array('6', $table)){echo "已訂";}else{echo"空";}?></label> </div><br/>
                <div id="t7" class="small" onClick="c(7)">7號桌<br/><label id="text7"><?php if(in_array('7', $table)){echo "已訂";}else{echo"空";}?></label> </div>
                <div id="t8" class="small" onClick="c(8)">8號桌<br/><label id="text8"><?php if(in_array('8', $table)){echo "已訂";}else{echo"空";}?></label>  </div>
                <div id="t9" class="small" onClick="c(9)">9號桌<br/><label id="text9"><?php if(in_array('9', $table)){echo "已訂";}else{echo"空";}?></label> </div>
                <div id="t10" class="small" onClick="c(10)">10號桌<br/><label id="text10"><?php if(in_array('10', $table)){echo "已訂";}else{echo"空";}?></label> </div>
			</div>
		</div>
        
        <form method="post" action="index.php">
        	<input type="hidden" id="tab" name="tab">
        	<input type="hidden" id="tnum" name="tnum">
            <input type="hidden" name="number" value="<?=$number?>">
            <input type="hidden" name="quan" value="<?=$quan?>">
            <input type="hidden" name="day" value="<?=$day?>">
            <input type="hidden" name="tp" value="<?=$ttp?>">
			<input type="hidden" name="menu" value="<?=$menu?>">
            <input type="hidden" name="aaa" value="<?=$aaa?>">
        	<input type="submit" value="確定選取" name="ok">
        </form>
        
        <input type="button" value="取消選取" onClick="location.href='ttable.php?day=<?=$day?>&tp=<?=$ttp?>&d=<?=$d?>&number=<?=$number?>&quan=<?=$quan?>&menu=<?=$menu?>&aaa=<?=$aaa?>'">
        <input type="button" value="放棄離開" onClick="location.href='index.php'">
    </h1></center>
    
</body>
</html>