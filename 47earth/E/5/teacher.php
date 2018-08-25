<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['ac']=='' && $_POST['ps']=='' && $_POST['type']==''){
			echo'<script>alert("未填寫完成")</script>';
		}else{
			$ac=$_POST['ac'];
			$ps=$_POST['ps'];
			
			$aa=$mysql->query("SELECT * FROM `login` where `ac` = '$ac'");
			if(mysqli_fetch_array($aa)){
				echo'<script>alert("此帳號已有人使用")</script>';
			}else{
				$pp=$mysql->query("SELECT * FROM `login` where `ps` = '$ps'");
				if(mysqli_fetch_array($pp)){
					echo'<script>alert("此密碼已有人使用")</script>';
				}else{
					$mysql->query("INSERT INTO `login` (`ac`, `ps`) VALUES ('$ac', '$ps')");
					echo'<script>';
					echo'alert("註冊成功");';
					echo'location.href="admin.php"';
					echo'</script>';
				}
			}
		}
	}
?>
<style>
	.box1{
		display: inline-block;
	}
	.box2{
		width:500px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
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
	.teacher{
		font-size:18px;
	}
</style>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><input type="button" value="返回" onClick="location.href='admin.php'" class="out"></div>
	<center><h1>
        老師註冊<p/>
        
        <div class="box2"><p/>
        	<form method="post">
            	帳號:<input type="text" name="ac" class="t"><p/>
                密碼:<input type="text" name="ps" class="t"><p/>
                <input type="submit" name="ok" value="確定" class="sub"><br/>
            </form>
        </div>
        
    </h1></center>
</body>
</html>