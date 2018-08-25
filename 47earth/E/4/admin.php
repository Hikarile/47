<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['ac']==''){
			echo'<script>alert("帳號未填")</script>';
		}else if($_POST['ps']==''){
			echo'<script>alert("密碼未填")</script>';
		}else{
			$ac=$_POST['ac'];
			$ps=$_POST['ps'];
			$l=$mysql->query("SELECT * FROM `login` where `ac` = '$ac' and `ps` = '$ps'");
			if(mysqli_fetch_array($l)){
				$_SESSION['login']='login';
				header("location:menu.php");
			}else{
				echo'<script>alert("登入失敗")</script>';
			}
		}
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
		height:250px;
		border:#F96 solid 3px;
		background-color:#FC6;
		padding-top:20px;
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
		width:100px;
		height:50px;
		font-size:20px;
		background-color:#69F;
		border-radius:15px;
	}
	.btn{
		width:100px;
		height:50px;
		border:#F93 solid 5px;
		background-color: #FC3;
		font-size:20px;
	}
	.btn:hover{
		background-color:#06F;
	}
	.sub:hover{
		background-color:#06F;
	}
	.out:hover{
		background-color:#F93
	}
</style>
<script src="jquery.js"></script>
<script></script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	教師登入<p/>
        <div class="box1"><input class="out" type="button" value="返回" onClick="location.href='index.php'"></div>
        
        <div class="box2">
        	<form method="post">
            	帳號:<input type="text" name="ac" value="<?=$_POST['ac']?>"><p/>
                密碼:<input type="password" name="ps"><p/>
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
       	</div>
        
    </h1></center>
</body>
</html>