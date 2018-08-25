<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
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
	<input type="button" value="返回" onClick="location.href='menu.php'" class="out">
    <center><h1>
    	
        管理管理者<p/>
        
        <input type="button" value="新增管理者" onClick="location.href='addt.php'" class="btn"><p/>
        
        <table width="1000px" border="1">
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
                    <input type="button" value="修改" onClick="location.href='fixt.php?id=<?=$login['id']?>'" class="btn">
                    <input type="button" value="刪除" onClick="location.href='dt.php?id=<?=$login['id']?>'" class="btn">
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>