<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<style>
	.box1{
		width:400px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F93;
		margin:20px;
		padding:20px;
	}
	.text{
		width:50%;
		height:30px;
		font-size:23px;
	}
	.out{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#FF9;
		border-radius:20px;
		font-size:20px;
	}
	.out:hover{
		background-color:#F90;
	}
	.sub{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:20px;
	}
	.sub:hover{
		background-color:#39F;
	}
</style>
<?php
	include("cd.php");
?>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<div><input type="button" value="教師登入" onClick="location.href='admin.php'" class="out"></div>
    <center><h1>
    	<samp>試卷登入<p/></samp>
    	<div class="box1">
        	<form method="post">
            	姓名:<input type="text" class="text" name="name" value="<?=$_POST['name']?>"><p/>
                角色:<input type="text" class="text" value="學生" disabled><p/>
                試卷編號:<input type="text" class="text" name="number"><p/>
                <input class="sub" type="submit" name="ok" value="確定">
            </form>
        </div>
    </h1></center>
</body>
</html>