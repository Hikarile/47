<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	unset($_SESSION['amount']);
?>
<style>
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		background-color:#C63;
	}
	
	form input[type=submit]{
		width:130px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	form input[type=submit]:hover{
		background-color:#6CF;
	}
	
	.q{
		max-width:90%;
		max-height:70px;
		width:90%;
		height:70px;
		font-size:20px;
	}
	.okda{
		width:50px;
		height:35px;
		font-size:20px;
	}
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$(document).on('click','input[type="radio"]',function(){
			var date=$(this).attr('date');
			var top=$(this).attr('top');
			for(i=1;i<=4;i++){
				$("#div"+i+top).attr('hidden','hidden');
			}
			
			if(date == 'r1'){
				$("#type"+top).val('1');
				$("#div1"+top).removeAttr('hidden');
			}
			if(date == 'r2'){
				for(j=1;j<=4;j++){
					$("#n"+top+"2"+j).val('');
				}
				
				$("#type"+top).val('2');
				$("#div2"+top).removeAttr('hidden');
			}
			if(date == 'r3'){
				$("#number"+top).val('4');
				for(j=1;j<=8;j++){
					$("#"+top+j).remove();
				}
				for(j=1;j<=4;j++){
					var da='<label id="'+top+j+'">'+j+'.<input type="text" id="n'+top+"3"+j+'" name="n'+top+'3['+j+']">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確解答<input class="okda" id="okda'+top+'3'+j+'" type="checkbox" name="okda'+top+'3['+j+']" vlaue="'+j+'"><br/></label>';
					$("#number"+top).before(da);
				}
				
				$("#type"+top).val('3');
				$("#div3"+top).removeAttr('hidden');
			}
		})
		
		$("#sub").submit(function(){
			var ppp=$("#ppp").val();
			for(i=1;i<=ppp;i++){
				var ok='';
				
				if($("#type"+i).prop('checked')==true){
					alert('你第'+i+'題的擇題目類型未選');
					return false;
				}
				if($("#q"+i).val() == ''){
					alert('你第'+i+'題的題目沒填');
					return false;
				}
				if($("#type"+i).val() == '2'){
					for(j=1;j<=4;j++){
						if($("#n"+i+"2"+j).val() == ''){
							alert('你第'+i+'題的第'+j+'個答案沒填');
							return false;
						}
					}
				}
				if($("#type"+i).val() == '3'){
					var number=$("#number"+i).val();
					for(j=1;j<=number;j++){
						if($("#n"+i+"3"+j).val() == ''){
							alert('你第'+i+'題的第'+j+'個答案沒填');
							return false;
						}
						if($("#okda"+i+"3"+j).prop('checked')==true){
							ok++;
						}
					}
					if(ok == ''){
						alert('你第'+i+'題的正確答案未選擇');
						return false;
					}
				}
			}
			if($("#time1").val()==''){
				alert("作答時間未填");
				return false;
			}if($("#time2").val()==''){
				alert("統計觀看時間未填");
				return false;
			}
		})
	})
	
	function topic(){//新增題目
		var ppp=$("#ppp").val();
		ppp++;
		$("#ppp").val(ppp);
		
		$.ajax({
			url:"topic.php",
			success: function(da){
				$(".ok").removeAttr('hidden');
				$(".t").removeAttr('hidden');
				$("#p").before(da);
			}
		})
	}
	
	function add(top){//新增答案
		var val=$("#number"+top).val();
		if(val < 8){
			val++;
			da='<label id="'+top+val+'">'+val+'.<input type="text" id="n'+top+'3'+val+'" name="n'+top+'3['+val+']">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確解答<input class="okda" id="okda'+top+'3'+val+'" type="checkbox" name="okda'+top+'3['+val+']" vlaue="'+val+'"><br/></label>';
			$("#number"+top).before(da);
			$("#number"+top).val(val);
		}
	}
	function d(top){//刪除答案
		var val=$("#number"+top).val();
		if(val > 2){
			$("#"+top+val).remove();
			val--;
			$("#number"+top).val(val);
		}
	}
	
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	新增試卷<p/>
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="返回" onClick="location.href='menu.php'">
        </div>
        
        <input class="btn" style="background-color:#C63;" type="button" value="新增題目" onClick="topic()"><p/>
        
        <form method="post" id="sub" action="add.php">
            <p id="p">&nbsp;</p>
            <input type="hidden" name="ppp" id="ppp" value="0">
            
            <label class="t" hidden>作答時間:<input type="number" id="time1" name="time1" max="60" min="10" value="20">秒</label><br/>
            <label class="t" hidden>統計觀看時間:<input type="number" id="time2" name="time2" max="60" min="10" value="20">秒</label><p/>
            
            <input class="ok" type="submit" name="ok" value="稍後再編輯" hidden>
            <input class="ok" type="submit" name="ok" value="編輯完成" hidden>
        </form>
        
    </h1></center>
</body>
</html>