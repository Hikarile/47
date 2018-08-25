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
		width:50%;
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
</style>
<?php
	include("cd.php");
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		if($ac==''){
			echo '<script>alert("帳號未填")</script>';
		}else if($ps==''){
			echo '<script>alert("密碼未填")</script>';
		}else{
			$lo=$mysqli->query("SELECT * FROM `login` where `ac` = '$ac' and `ps` = '$ps'");
			if($login=mysqli_fetch_array($lo)){
				$_SESSION['login']='login';
				$_SESSION['id']=$login['id'];
				header("location:menu.php");
			}else{
				echo '<script>alert("登入失敗")</script>';
			}
		}
	}
?>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<div><input type="button" value="返回" onClick="location.href='index.php'" class="out"></div>
    <center><h1>
    	<samp>教師登入<p/></samp>
    	<div class="box1">
        	<form method="post">
            	帳號:<input type="text" class="text" name="ac" value="<?=$_POST['name']?>"><p/>
                密碼:<input type="password" class="text" name="ps"><p/>
                <input class="sub" type="submit" name="ok" value="確定"><p/>
                <a href="teacher.php">教師註冊</a>
            </form>
        </div>
    </h1></center>
</body>
</html>