<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	$lo=$mysql->query("SELECT * FROM `login` where `id` = '$id'");
	$login=mysqli_fetch_array($lo);
	
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		$type=$_POST['type'];
		
		if($ac == ''){
			echo '<script>alert("帳號未填")</script>';
		}else if($ps == ''){
			echo '<script>alert("密碼未填")</script>';
		}else{
			$mysql->query("SELECT * FROM `login` where `type` = '$type' and `ac` = '$ac'");
			if($login=mysqli_fetch_array($lo)){
				echo '<script>alert("此帳號有人用")</script>';
			}else{
				$mysql->query("UPDATE `login` SET `type` = '$type', `ac` = '$ac', `ps` = '$ps' WHERE `id` = '$id'");
				echo '<script>';
				echo 'alert("修改成功");';
				echo 'location.href="teacher.php"';
				echo '</script>';
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
	<input type="button" value="登出" onClick="location.href='teacher.php'" class="out">
    <center><h1>
    	
        修改管理者<p/>
        
        <div class="box1">
        	<form method="post">
            	帳號:<input type="text" name="ac" class="text" value="<?=$login['ac']?>"><p/>
                密碼:<input type="text" name="ps" class="text" value="<?=$login['ps']?>"><p/>
                角色:
                <select class="text" name="type">
                	<option value="老師" <?php if($login['type'] == '老師'){echo'selected';}?>>老師</option>
                    <option value="管理者" <?php if($login['type'] == '管理者'){echo'selected';}?>>管理者</option>
                </select><p/>
                <input type="submit" name="ok" value="確定" class="sub">
            </form>
        </div>
        
    </h1></center>
</body>
</html>