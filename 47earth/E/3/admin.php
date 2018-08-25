<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		if($ac == ''){
			echo '<script>alert("帳號未填")</script>';
			return false;
		}else if($ps == ''){
			echo '<script>alert("密碼未填")</script>';
			return false;
		}else{
			$lo=$mysql->query("SELECT * FROM `login` where `ac` = '$ac' and `ps` = '$ps'");
			if(mysqli_fetch_array($lo)){
				$_SESSION['login']='true';
				header("location:menu.php");
			}else{
				echo '<script>alert("登入失敗")</script>';
				return false;
			}
		}
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
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	教師登入<p/>
        
        <div class="box1"><input class="out" type="button" value="返回" onClick="location='index.php'"></div><p/>
        
        <div class="box2">
        	<form method="post">
            	帳號:<input class="text" type="text" name="ac"><p/>
                密碼:<input class="text" type="password" name="ps"><p/>
                <input class="sub" type="submit" name="ok" value="確定">
            </form>
        </div>
        
    </h1></center>
</body>
</html>