<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['ok']){
		if($_POST['ac']=='' && $_POST['ps']=='' && $_POST['type']==''){
			echo'<script>alert("未填寫完成")</script>';
		}else{
			$ac=$_POST['ac'];
			$ps=$_POST['ps'];
			$type=$_POST['type'];
			
			$aa=$mysql->query("SELECT * FROM `login` where `ac` = '$ac'");
			if(mysqli_fetch_array($aa)){
				echo'<script>alert("此帳號已有人使用")</script>';
			}else{
				$mysql->query("UPDATE `login` SET `type` = '$type', `ac` = '$ac', `ps` = '$ps' WHERE `id` = '".$_GET['id']."'");
				echo'<script>';
				echo'alert("修改成功");';
				echo'location.href="teacher.php"';
				echo'</script>';
			}
		}
	}
?>
<style>
	.box1{
		display: inline-block;
	}
	.box2{
		width:500px;
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
	.teacher{
		font-size:18px;
	}
</style>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><input type="button" value="返回" onClick="location.href='teacher.php'" class="out"></div>
	<center><h1>
        修改管理者<p/>
        
        <div class="box2"><p/>
        	<?php
            $lo=$mysql->query("SELECT * FROM `login` where `id` = '".$_GET['id']."'");
			$login=mysqli_fetch_array($lo);
			?>
        	<form method="post">
            	帳號:<input type="text" name="ac" class="t" value="<?=$login['ac']?>"><p/>
                密碼:<input type="text" name="ps" class="t" value="<?=$login['ps']?>"><p/>
                角色:
                <select name="type" class="t">
                	<option value="老師" <?php if($login['type'] == '老師'){echo'selected';}?>>老師</option>
                    <option value="管理者" <?php if($login['type'] == '管理者'){echo'selected';}?>>管理者</option>
                </select><p/>
                <input type="submit" name="ok" value="確定" class="sub"><br/>
            </form>
        </div> 	
    </h1></center>
</body>
</html>