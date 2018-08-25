<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	$_SESSION['number'];
	
	$day=$_POST['day'];
	$tp=$_POST['tp'];
	$number=$_POST['number'];
	$tab=$_POST['tab'];
	$tnum=$_POST['tnum'];
	$quan=$_POST['quan'];
	$menu=$_POST['menu'];
	$aaa=$_POST['aaa'];
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	#button{
		width:100%;
		height:50px;
		font-size:35px;
		background-color:#39F;
	}
	.te{
		border:#63F solid 3px;
		background-color:#FFF;
	}
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function (){   //一進網頁跳日期
		$.ajax({
			url:"day.php",
			data:{aa:0},
			type:"POST",
			success: function(d){
				$('hr').after(d);
			}
		});
		$("#<?=$aaa?>").css('background-color','#FFF');
	});
	function before(){//下一週
		$.ajax({
			url:"day.php",
			data:{aa:1},
			type:"POST",
			success: function(d){
				$("#big1").remove();
				$("#big2").remove();
				$('hr').after(d);
			}
		});
	}
	function after(){//上一週	
		$.ajax({
			url:"day.php",
			data:{aa:2},
			type:"POST",
			success: function(d){
				$("#big1").remove();
				$("#big2").remove();
				$('hr').after(d);
			}
		});
	}
	function a(tp,day,obj){//點選日期
		$(".a").css('background-color','#6699FF');
		$(obj).css('background-color','#FFF');
		
		$("#dayday").val(day);
		$("#tptp").val(tp);
		
		d=day.split('-');
		$("#d").val(d[2]);
		$("#number").val(d[0]+d[1]+d[2]);
		
		aaa=$(obj).attr('id');
		$("#aaa").val(aaa);
	}
	function auto(){//自動產生桌號
		var day = $('[name="day"]').val();
		var tp = $('[name="tp"]').val();
		if(day != ""){
			$.ajax({
				url: 'table.php?day='+day+'&tp='+tp,
				success: function(num){
					$('[name="tab"]').val(1);
					$('[name="tnum"]').val(num);
				}
			})
		}
		else{
			alert("請選擇日期與時段");
		}
	}
	function choose(){//選擇桌號
		var day = $('[name="day"]').val();
		var tp = $('[name="tp"]').val();
		var d = $('[name="d"]').val();
		var number = $('[name="number"]').val();
		var quan = $('[name="quan"]').val();
		var menu = $('[name="menu"]').val();
		var aaa = $('[name="aaa"]').val();
		if(day != ""){
			location.href='ttable.php?day='+day+'&tp='+tp+'&d='+d+'&number='+number+'&quan='+quan+'&menu='+menu+'&aaa='+aaa;
		}
		else{
			alert("請選擇日期與時段");
		}
	}
</script>
</head>
	
<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐<p/>
        <table border="1" width="90%">
        	<tr height="50px">
            	<th><input  id="button" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input  id="button" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input  id="button" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        
        <hr>
        
        <form method="post" action="index2.php">
        	日期:<input id="dayday" name="day" type="text" value="<?=$day?>" readonly><br/>
            <input type="hidden" id="number" name="number" value="<?=$number?>">
            <input type="hidden" id="aaa" name="aaa" value="<?=$aaa?>">
            
            時段:
            <select id="tptp" name="tp" disabled>
            	<option value="1"<?php if($tp == 1){echo"selected";}?>>午餐</option>
                <option value="2"<?php if($tp == 2){echo"selected";}?>>下午茶</option>
                <option value="3"<?php if($tp == 3){echo"selected";}?>>晚餐</option>
            </select><br/>
            
            訂餐數量:<input name="quan" type="number" value="<?php if($quan==""){echo '1';}else{echo $quan;}?>"><br/>
            
            套餐名稱
             <select name="menu">
            	<option value="Food01"<?php if($menu == "Food01"){echo"selected";}?>>Food01</option>
                <option value="Food02"<?php if($menu == "Food02"){echo"selected";}?>>Food02</option>
                <option value="Food03"<?php if($menu == "Food03"){echo"selected";}?>>Food03</option>
                <option value="Food04"<?php if($menu == "Food04"){echo"selected";}?>>Food04</option>
                <option value="Food05"<?php if($menu == "Food05"){echo"selected";}?>>Food05</option>
                <option value="Food06"<?php if($menu == "Food06"){echo"selected";}?>>Food06</option>
            </select><br/>
            
            訂餐桌數:<input name="tab" type="text" value="<?=$tab?>" readonly><br/>
            
            桌號:<input name="tnum" type="text" value="<?=$tnum?>" readonly>
            
            <input type="button" value="自動產生桌號" onClick="auto()">
            <input type="button" value="選擇桌號" onClick="choose()"><br/>
            
            <input name="ok" type="submit" value="確定訂餐">
            <input type="reset" value="取消">
        </form>
        
    </h1></center>
    
</body>
</html>