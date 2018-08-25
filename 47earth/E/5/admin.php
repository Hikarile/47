<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['ac']==''){
			echo'<script>alert("帳號未填")</script>';
		}else if($_POST['ps']==''){
			echo'<script>alert("密碼未填")</script>';
		}else{
			$log=$mysql->query("SELECT * FROM `login` where `ac` = '".$_POST['ac']."' and `ps` = '".$_POST['ps']."'");
			if($login=mysqli_fetch_array($log)){
				$_SESSION['login']='start';
				$_SESSION['id']=$login['id'];
				header("location:menu.php");
			}else{
				echo'<script>alert("登入失敗")</script>';
			}
		}
	}
?>
<style>
	.box1{
		display: inline-block;
	}
	.box2{
		width:450px;
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
<div class="box1"><input type="button" value="返回" onClick="location.href='index.php'" class="out"></div>
	<center><h1>
        老師登入<p/>
        
        <div class="box2"><p/>
        	<form method="post">
            	帳號:<input type="text" name="ac" class="t" value="<?=$_POST['ac']?>"><p/>
                密碼:<input type="password" name="ps" class="t"><p/>
                <input type="submit" name="ok" value="確定" class="sub"><br/>
                <a class="teacher" href="teacher.php">教師註冊</a>
            </form>
        </div>
        
    </h1></center>
</body>
</html>