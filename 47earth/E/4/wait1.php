<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['out']){
		$mysql->query("DELETE FROM `name` WHERE `id` = '".$_SESSION['id']."'");
		session_destroy();
		header("location:index.php");
	}
	
?>
<style>
	.box1{
		position:absolute;
		top:20px;
		right:20px;
	}
	.box2{
		width:500px;
		height:150px;
		border:#F96 solid 3px;
		background-color:#FC6;
		padding-top:25px;
	}
	.box3{
		width:500px;
		height:500px;
		background-color:#FC6;
		overflow:auto;
	}
	.out{
		border:#F90 solid 3px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#FFFF99;
	}
	.sub{
		border:#36F solid 2px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#69F;
		border-radius:15px;
	}
	.btn{
		width:130px;
		height:50px;
		border:#F93 solid 5px;
		background-color: #FC3;
		font-size:20px;
	}
	.btn:hover{
		background-color:#F60;
	}
	.sub:hover{
		background-color:#06F;
	}
	.out:hover{
		background-color:#F93
	}
	.name{
		width:100%;
		height:50px;
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
				var d=da.split('-----');
				if(d[0]=='start'){
					location.href='wait2.php'
				}else{
					$(".box3").html(d[1]);
				}
			}
		})
		setTimeout("time()",1000);
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	準備開始測試<p/>
        <div class="box1"><form method="post"><input class="out" type="submit" name="out" value="離開試卷"></form></div>
        
        <div class="box2">
        	每一題都有<samp style="color:#00F"><?=$_SESSION['time1']?></samp>秒的作答時間，之後會有<samp style="color:#00F"><?=$_SESSION['time2']?></samp>秒的時間觀看統計畫面，結束後繼續進入下一題。
        </div>
        <div class="box3"></div>
        
    </h1></center>
</body>
</html>