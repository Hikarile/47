<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['name']==''){
			echo'<script>alert("姓名未填")</script>';
		}else if($_POST['number']==''){
			echo'<script>alert("試卷編號未填")</script>';
		}else{
			$number=$_POST['number'];
			$name=$_POST['name'];
			$t=$mysql->query("SELECT * FROM `text` where `text_number` = '$number'");
			if($text=mysqli_fetch_array($t)){
				if($text['test']==''){
					echo'<script>alert("此試卷還未開放")</script>';
				}else if($text['test']=='開始作答'){
					echo'<script>alert("此試卷已開始作答")</script>';
				}else{
					$mysql->query("INSERT INTO `name` (`text_id`, `text_number`, `name`) VALUES ('".$text['id']."', '".$_POST['number']."', '".$_POST['name']."')");
					$id=mysqli_insert_id($mysql);
					
					$_SESSION['id']=$id;
					$_SESSION['name']=$name;
					$_SESSION['textid']=$text['id'];
					$_SESSION['number']=$number;
					
					$_SESSION['time1']=$text['time1'];
					$_SESSION['time2']=$text['time2'];
					header("location:wait1.php");
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
		top:20px;
		right:20px;
	}
	.box2{
		width:500px;
		height:300px;
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
    	互動評分系統<p/>
        <div class="box1"><input class="out" type="button" value="老師登入" onClick="location.href='admin.php'"></div>
        
        <div class="box2">
        	<form method="post">
            	姓名:<input type="text" name="name" value="<?=$_POST['name']?>"><p/>
                角色:<input type="text" disabled value="學生"><p/>
                試卷編號:<input type="tel" pattern="[0-9]+" name="number" value="<?=$_POST['number']?>"><p/>
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
       	</div>
        
    </h1></center>
</body>
</html>