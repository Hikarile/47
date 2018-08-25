<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	if($_SESSION['id'] != ''){
		session_destroy();
	}
	
	if($_POST['ok']){
		if($_POST['name']==''){
			echo'<script>alert("姓名未填")</script>';
		}else if($_POST['number']==''){
			echo'<script>alert("試卷編號未填")</script>';
		}else{
			$t=$mysql->query("SELECT * FROM `text` where `number` = '".$_POST['number']."'");
			if($text=mysqli_fetch_array($t)){
				if($text['text']==''){
					echo'<script>alert("此試卷還未開放")</script>';
				}else if($text['text']=='開始作答'){
					echo'<script>alert("此試卷已開始作答")</script>';
				}else{
					$mysql->query("INSERT INTO `name` (`textid`, `number`, `name`) VALUES ('".$text['id']."', '".$_POST['number']."', '".$_POST['name']."')");
					$id=mysqli_insert_id($mysql);
					
					$_SESSION['id']=$id;
					$_SESSION['name']=$_POST['name'];
					$_SESSION['textid']=$text['id'];
					$_SESSION['number']=$_POST['number'];
					
					$_SESSION['time1']=$text['time1'];
					$_SESSION['time2']=$text['time2'];
					
					header("location:wait1.php");
				}
			}else{
				echo'<script>alert("無此此問卷")</script>';
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
	<input type="button" value="教師登入" onClick="location.href='admin.php'" class="out">
    <center><h1>
    	試卷登入<p/>
        
    	<div class="box1">
        	<form method="post">
            	姓名:<input type="text" name="name" class="text"><p/>
                角色:<input type="text" name="type" value="學生" disabled class="text"><p/>
                試卷編號:<input type="text" name="number" class="text"><p/>
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
        </div>
        
    </h1></center>
</body>
</html>