<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<style>
	.box1{
		width:400px;
		height:250px;
		border:#F60 solid 3px;
		background-color:#F93;
		margin:20px;
		padding:20px;
	}
	.text{
		width:150px;
		height:30px;
		font-size:23px;
	}
	.out{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#FF9;
		border-radius:20px;
		font-size:20px;
	}
	.out:hover{
		background-color:#F90;
	}
	.sub{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:20px;
	}
	.sub:hover{
		background-color:#39F;
	}
	.btn{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#F90;
		border-radius:20px;
		font-size:20px;
	}
	.btn:hover{
		background-color:#F63;
	}
</style>
<?php
	include("cd.php");
	include("login.php");
	
	$_SESSION['count']=0;
	
?>
<script src="jquery.js"></script>
<script>
	$(function(){
		
	})
	function add(count){
		
	}
	function d(count){
		
	}
	function topic(){
		$.ajax({
			url:"topic.php",
			success: function(da){
				$("#p").before(da);
			}
		})
		$(".time").removeAttr('hidden');
		$(".ok").removeAttr('hidden');
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<div><input type="button" value="登出" onClick="location.href='out.php'" class="out"></div>
    <center><h1>
    	<samp>新增問卷<p/></samp>
        
        <input type="button" value="新增題目" onClick="topic()" class="btn">
        <form method="post" action="add.php">
        	<input type="hidden" name="p" id="p" value="<?=$_SESSION['count']?>"><p/>
            
            <label class="time" hidden>作答時間<input type="number" class="text" id="time1" name="time1" value="20" min="10" max="60">秒</label><br/>
            <label class="time" hidden>統計觀看時間<input type="number" class="text" id="time2" name="time2" value="20" min="10" max="60">秒</label><br/>
            
            <input type="submit" name="ok" value="稍後編輯" class="sub" hidden>
            <input type="submit" name="ok" value="編輯完成" class="sub" hidden>
        </form>
    </h1></center>
</body>
</html>