<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	
	if($_POST['ok']){
		$aa=$mysql->query("SELECT * FROM `text` where `text_number` = '".$_POST['text_number']."'");
		$a=mysqli_fetch_array($aa);
		
		if($a['status'] == '考試完成'){
			echo'<script>alert("此試卷已結束作答")</script>';
		}else{
			if($a['test'] == ''){
				echo'<script>alert("此試卷還未可以登入")</script>';
			}else if($a['test'] == '開始作答'){
				echo'<script>alert("此試卷已開始作答")</script>';
			}else{
				$mysql->query("INSERT INTO `name` (`text_id`,`text_number`, `name`) VALUES ('".$a['id']."','".$_POST['text_number']."', '".$_POST['name']."')");
				$id=mysqli_insert_id($mysql);
				
				$_SESSION['id']=$id;
				$_SESSION['text_id']=$a['id'];
				$_SESSION['number']=$_POST['text_number'];
				$_SESSION['name']=$_POST['name'];
				
				$_SESSION['time1']=$a['time1'];
				$_SESSION['time2']=$a['time2'];
				
				header('location:wait.php');
			}
		}
	}
?>
<style>
	.index{
		border:#F93 solid 3px;
		background-color:#FC6;
		padding:20px;
		width:400px;
		height:250px;
	}
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	label{
		display: inline-block;
		width:150px;
		text-align: right;
		padding-right:5px;
		font-weight:bold;
	}
	
	form input[type=submit]{
		width:100px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	form input[type=submit]:hover{
		background-color:#6CF;
	}
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	互動評分系統<p/>
        
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="管理者登入" onClick="location.href='admin.php'">
        </div>
        
        <div class="index">
        	<form method="post">
            	<label>名字:</label>
                <input id="name" type="tel" name="name" value="<?=$_POST['name']?>"><p/>
               	
                <label>角色:</label>
                <input type="text" name="role" value="學生" disabled><p/>
                
                <label>試卷編號:</label>
                <input type="text" name="text_number" pattern="[0-9]+" value="<?=$_POST['text_number']?>"><p/>
                
                <input type="submit" name="ok" value="確定">
            </form>
        </div>
    </h1></center>
</body>
</html>