<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['name']==''){
			echo '<script>alert("姓名未填")</script>';
		}else if($_POST['number']==''){
			echo '<script>alert("試題編號未填")</script>';
		}else{
			$t=$mysql->query("SELECT * FROM `text` where `text_number` = '".$_POST['number']."'");
			if($text=mysqli_fetch_array($t)){
				if($text['status']=='考試完成'){
					echo'<script>alert("此試卷已結束作答")</script>';
				}else{
					if($text['test'] == ''){
						echo'<script>alert("此試卷還未可以登入")</script>';
					}else if($text['test'] == '開始作答'){
						echo'<script>alert("此試卷已開始作答")</script>';
					}else{
						$mysql->query("INSERT INTO `name` (`text_id`,`text_number`,`name`) VALUES ('".$text['id']."','".$_POST['number']."','".$_POST['name']."')");
						$id=mysqli_insert_id($mysql);
						
						$_SESSION['id']=$id;
						$_SESSION['name']=$_POST['name'];
						$_SESSION['textid']=$text['id'];
						$_SESSION['number']=$_POST['number'];
						
						$_SESSION['time1']=$text['time1'];
						$_SESSION['time2']=$text['time2'];
						
						header('location:wait1.php');
					}
				}
			}else{
				echo'<script>alert("無此試卷")</script>';
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
    	互動評分系統<p/>
        
        <div class="box1"><input class="out" type="button" value="管理者登入" onClick="location='admin.php'"></div><p/>
        
        <div class="box2">
        	<form method="post">
            	姓名:<input class="text" type="text" name="name" value="<?=$_POST['name']?>"><p/>
                角色:<input class="text" type="text" value="學生" disabled><p/>
                試題編號:<input class="text" type="tel" pattern="[0-9]+" name="number" value="<?=$_POST['number']?>"><p/>
                <input class="sub" type="submit" name="ok" value="確定">
            </form>
        </div>
        
    </h1></center>
</body>
</html>