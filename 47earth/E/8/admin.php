<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		$type=$_POST['type'];
		
		if($ac == ''){
			echo '<script>alert("帳號未填")</script>';
		}else if($ps == ''){
			echo '<script>alert("密碼未填")</script>';
		}else{
			$lo=$mysql->query("SELECT * FROM `login` where `type` = '$type' and `ac` = '$ac' and `ps` = '$ps'");
			if($login=mysqli_fetch_array($lo)){
				$_SESSION['login']='login';
				$_SESSION['type']=$type;
				$_SESSION['id']=$login['id'];
				header("location:menu.php");
			}else{
				echo '<script>alert("登入失敗")</script>';
			}
		}
	}
?>
<style>
	.box1{
		width:400px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
		margin:20px;
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
	
</script>
</head>

<body bgcolor="#FFFF99">
	<input type="button" value="返回" onClick="location.href='index.php'" class="out">
    <center><h1>
    	教師登入<p/>
        
    	<div class="box1">
        	<form method="post">
            	帳號:<input type="text" name="ac" class="text"><p/>
                密碼:<input type="password" name="ps" class="text"><p/>
                角色:
                <select class="text" name="type">
                	<option value="老師">老師</option>
                    <option value="管理者">管理者</option>
                </select><p/>
               
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
        </div>
        
    </h1></center>
</body>
</html>