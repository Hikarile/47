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
			echo '<script>alert("帳號未填");</script>';
		}else if($ps==''){
			echo '<script>alert("密碼未填");</script>';
		}else{
			$aaa=$mysqli->query("SELECT * FROM `login` where `ac` = '$ac'");
			if(mysqli_fetch_array($aaa)){
				echo '<script>alert("此帳號已被使用");</script>';
			}else{
				$bbb=$mysqli->query("SELECT * FROM `login` where `ps` = '$ps'");
				if(mysqli_fetch_array($bbb)){
					echo '<script>alert("此密碼已被使用");</script>';
				}else{
					$mysqli->query("INSERT INTO `login` (`ac`, `ps`) VALUES ('$ac', '$ps')");
					echo '<script>';
					echo 'alert("註冊成功");';
					echo 'location.href="admin.php";';
					echo '</script>';
				}
			}
		}
	}
?>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<div><input type="button" value="返回" onClick="location.href='admin.php'" class="out"></div>
    <center><h1>
    	<samp>教師註冊<p/></samp>
    	<div class="box1">
        	<form method="post">
            	帳號:<input type="text" class="text" name="ac"><p/>
                密碼:<input type="text" class="text" name="ps"><p/>
                <input class="sub" type="submit" name="ok" value="確定"><p/>
            </form>
        </div>
    </h1></center>
</body>
</html>