<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	if($_POST['out']){
		$mysql->query("DELETE FROM `name` WHERE `id` = '".$_SESSION['id']."'");
		session_destroy();
		header("location:index.php");
	}
?>
<style>
	
	.box2{
		width:450px;
		height:200px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
	}
	.box3{
		width:450px;
		height:450px;
		border:#F60 solid 3px;
		background-color:#F90;
		overflow:auto;
	}
	.out{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FF9;
		font-size:25px;
	}
	.sub{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FC3;
		font-size:25px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:70px;
		border:#36F solid 3px;
		background-color:#69F;
		font-size:25px;
		border-radius:20px;
	}
	.btn:hover{
		background-color:#06F;
	}
	.sub:hover{
		background-color:#F96;
	}
	.out:hover{
		background-color:#F90;
	}
	
	.t{
		width:200px;
		height:30px;
		font-size:23px;
	}
</style>
<script src="jquery.js"></script>
<script>
	$(function(){
		time();
	})
	function time(){
		$.ajax({
			url:"name.php",
			success: function(da){
				d=da.split('-----');
				if(d[0]=='start'){
					location.href='wait2.php';
				}else{
					$(".box3").html(d[1])
				}
			}
		})
		setTimeout("time()",1000);
	}
</script>
</head>

<body bgcolor="#FFFF99">
	 <div class="box1"><form method="post"><input type="submit" name="out" value="離開試卷" onClick="location.href='admin.php'" class="out"></form></div>
	<center><h1>
        準備開始考試<p>&nbsp;<p/>
        
        <div class="box2">
        	每一題都有<samp style="color:#F00;"><?=$_SESSION['time1']?></samp>秒的時間可以作答，時間到後會有<samp style="color:#F00;"><?=$_SESSION['time2']?></samp>秒的時間觀看作答結果，之後會在進入下一題。
        </div><p/>
        <div class="box3">
        	
        </div>
        
    </h1></center>
</body>
</html>