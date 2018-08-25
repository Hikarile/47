<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	if($_SESSION['id']!=''){
		session_destroy();
	}
	
	if($_POST['ok']){
		if($_POST['name']==''){
			echo'<script>alert("姓名未填")</script>';
		}else if($_POST['number']==''){
			echo'<script>alert("試卷編號未填")</script>';
		}else{
			$t=$mysql->query("SELECT * FROM `text` where `text_number` = '".$_POST['number']."'");
			if($text=mysqli_fetch_array($t)){
				if($text['test']==''){
					echo'<script>alert("此試卷還未開放")</script>';
				}else if($text['test']=='開始作答'){
					echo'<script>alert("此試卷已開始作答")</script>';
				}else{
					$mysql->query("INSERT INTO `name` (`text_id`, `text_number`, `name`) VALUES ('".$text['id']."', '".$_POST['number']."', '".$_POST['name']."')");
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
</style>
</head>

<body bgcolor="#FFFF99">
	<div class="box1"><input type="button" value="老師登入" onClick="location.href='admin.php'" class="out"></div><br/>
	<center><h1>
        互動式頻分系統<p/>
        
        <div class="box2"><p/>
        	<form method="post">
            	姓名:<input type="text" name="name" class="t"><p/>
                角色:<input type="text" name="type" class="t" disabled value="學生"><p/>
                試卷編號:<input type="tel" pattern="[0-9]+" name="number" class="t"><p/>
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
        </div>
        
    </h1></center>
</body>
</html>