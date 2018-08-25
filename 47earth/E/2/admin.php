<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		
		if($ac==''){
			echo'<script>alert("帳號未填")</script>';
		}else if($ps==''){
			echo'<script>alert("密碼未填")</script>';
		}else{
			$aa=$mysql->query("SELECT * FROM `login` where `ac` = '$ac' and `ps` = '$ps'");
			if(mysqli_fetch_array($aa)){
				$_SESSION['dnlu']='true';
				header("location:menu.php");
			}else{
				echo'<script>alert("登入失敗")</script>';
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
		height:200px;
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
		width:100px;
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
    	管理者登入<p/>
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="返回" onClick="location.href='index.php'">
        </div>
        
        <div class="index">
        	<form method="post">
                <label>帳號:</label>
                <input type="text" name="ac" value="<?=$_POST['ac']?>"><p/>
                
                <label>密碼:</label>
                <input type="password" name="ps"><p/>
                
                <input type="submit" name="ok" value="確定">
			</form>
        </div>
        
    </h1></center>
</body>
</html>