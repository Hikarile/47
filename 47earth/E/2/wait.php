<!doctype html>
<html><head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	
	if($_POST['out']){
		$mysql->query("DELETE FROM `name` WHERE `id` = '".$_SESSION['id']."'");
		session_destroy();
		header('location:index.php');
	}
?>
<style>
	.index{
		border:#F93 solid 3px;
		background-color:#FC6;
		padding:20px;
		width:400px;
		height:250px;
	}
	
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	label{
		display: inline-block;
		width:150px;
		text-align: right;
		padding-right:5px;
		font-weight:bold;
	}
	.text{
		font-size:22px;
		word-wrap:break-word;
	}
	
	.name{
		position:absolute;
		left:100px;
		width:300px;
		height:300px;
		border:#06F solid 3px;
		background-color:#69F;
		overflow:auto;
	}
	
	.blue{
		color:#39F;
		display:inline-block;
	}
	.red{
		color:#F00;
		display:inline-block;
	}
	
	.time{
		font-size:80px;
		border:#000 solid 2px;
		border-radius:50px;
		width:100px;
		height:100px;
	}
	
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		time();
	})
	
	function time(){
		$.ajax({
			url:"name.php",
			success: function(da){
				ddaa=da.split('________________');
				if(ddaa[0] !=''){
					location.href='wait.php';
				}else{
					$(".name").html(ddaa[1]);
				}
			}
		})
		setTimeout("time()",500);
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	準備開始作答<p/>
        <div style="position:absolute; top:30px; right:60px;">
        	<form method="post"><input class="btn" type="submit" name="out" value="離開試卷"></form>
        </div>
        
        <div class="name"></div>
        
        <div class="index">
        	測試前的小叮嚀<p/>
            <div class="text">
                每1題都會有<samp class="blue"><?=$_SESSION['time1']?></samp>秒的作答時間，送出答案或時間到後將會統計所有作答者答案，並以統計圖的方式顯示出來，並在<samp class="blue"><?=$_SESSION['time1']?></samp>秒後進入下一題。<p/>
                
                <div class="red">時間內未作答完成將會自動送出答案，一樣會納入統計資料中。</div>
            </div>
        </div>
    </h1></center>
</body>
</html>