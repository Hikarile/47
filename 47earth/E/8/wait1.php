<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
?>
<style>
	.box1{
		width:400px;
		height:500px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
		margin:20px;
		overflow:auto;
	}
	.sub{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.sub:hover{
		background-color:#36F;
	}
	.out{
		width:150px;
		height:60px;
		border:#F63 solid 3px;
		background-color:#FF9;
		font-size:23px;
	}
	.out:hover{
		background-color:#F90;
	}
	.btn{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.btn:hover{
		background-color:#39F;
	}
	.text{
		width:150px;
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
				var d=da.split('-----');
				if(d[0]!=''){
					location.href='wait2.php';
				}else{
					$(".box1").html(d[1]);
				}
			}
		})
		setTimeout("time()",1000);
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<input type="button" value="離開試卷" onClick="location.href='over.php'" class="out">
    <center><h1>
    	準備開始<p/>
        
    	<div class="box1">
        	
        </div>
        
    </h1></center>
</body>
</html>