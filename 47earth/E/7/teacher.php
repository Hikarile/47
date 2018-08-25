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
			
			$aa=$mysql->query("SELECT * FROM `login` where `ac` = '$ac'");
			if(mysqli_fetch_array($aa)){
				echo'<script>alert("此帳號已有人使用")</script>';
			}else{
				$pp=$mysql->query("SELECT * FROM `login` where `ps` = '$ps'");
				if(mysqli_fetch_array($pp)){
					echo'<script>alert("此密碼已有人使用")</script>';
				}else{
					$mysql->query("INSERT INTO `login` (`ac`, `ps`) VALUES ('$ac', '$ps')");
					echo'<script>';
					echo'alert("註冊成功");';
					echo'location.href="admin.php"';
					echo'</script>';
				}
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
<div class="box1"><input type="button" value="返回" onClick="location.href='menu.php'" class="out"></div>
	<center><h1>
        管理管理者<p/>
        <input type="button" value="新增管理者" class="sub" onClick="location.href='addt.php'">
        <table width="800px" border="1">
        	<tr bgcolor="#6699FF">
            	<th>角色</th>
                <th>帳號</th>
                <th>密碼</th>
                <th>編輯</th>
            </tr>
            <?php
            $lo=$mysql->query("SELECT * FROM `login`");
			while($login=mysqli_fetch_array($lo)){
			?>
			<tr bgcolor="#CCCCCC">
            	<th><?=$login['type']?></th>
                <th><?=$login['ac']?></th>
                <th><?=$login['ps']?></th>
                <th>
                    <input type="button" value="修改" class="btn" onClick="location.href='fixt.php?id=<?=$login['id']?>'">
                    <input type="button" value="刪除" class="btn" onClick="location.href='dt.php?id=<?=$login['id']?>'">
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>