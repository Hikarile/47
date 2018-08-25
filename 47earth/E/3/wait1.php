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
		header('location:index.php');
	}
?>
<style>
	.box1{
		position:absolute;
		top:50px;
		right:100px;
	}
	.box2{
		width:400px;
		border: #F93 solid 3px;
    	background-color: #FC6;
		padding:30px;
	}
	.text{
		width:200px;
		height:25px;
		font-size:20px;
	}
	.out{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FFFF99;
		font-size:20px;
	}
	.sub{
		border:#36F solid 4px;
		background-color:#69F;
		width:100px;
		height:50px;
		font-size:20px;
		border-radius:20px;
	}
	.out:hover{
		background-color:#C63;
	}
	.sub:hover{
		background-color:#6CF;
	}
	.text{
		padding:15px;
		border:#F30 solid 3px;
		background-color:#F93;
		width:400px;
		height:200px;
		font-size:30px;
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
				var dd=da.split('----');
				if(dd[0]=='start'){
					location.href='wait2.php';
				}else{
					$(".name").html(dd[1]);
				}
			}
		})
		setTimeout("time()",1000);
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	準備開始作答</p>
        <div class="box1"><form method="post"><input type="submit" name="out" value="離開試卷" class="out"></form></div>
        
        <div class="text">
        	每1題都會有<samp style="color:#00F;"><?=$_SESSION['time1']?></samp>秒的作答時間，送出答案或時間到後將會統計所有作答者答案，並以統計圖的方式顯示出來，並在<samp style="color:#00F;"><?=$_SESSION['time2']?></samp>秒後進入下一題。<p/>
        </div></p>
        <div class="name"></div>
        
    </h1></center>
</body>
</html>