<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$id=$_GET['id'];
	
	if($_POST['ok']){
		if($_POST['reply']!=''){
			$mysql->query("INSERT INTO `reply` (`mid`, `reply`) VALUES ('$id', '".$_POST['reply']."')");
			header("location:ad_m.php");
		}else{
			echo'<script>alert("未填寫完成")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	回覆:<input type="button" value="返回" onClick="location.href='ad_m.php'"><p/>
        <form method="post">
        	<textarea style="width:25%; height:200px;" name="reply"></textarea><br/>
            <input type="submit" name="ok" value="確定">
        </form>
    </h1></center>
</body>
</html>