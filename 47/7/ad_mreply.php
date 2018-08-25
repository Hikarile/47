<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$mysql->query("INSERT INTO `reply` (`mid`, `reply`) VALUES ('".$_GET['id']."', '".$_POST['reply']."')");
		header("location:ad_m.php");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	回覆留言<input type="button" value="返回" onClick="location.href='ad_m.php'"><p/>
        <form  method="post">
        	回復:<br/>
            <textarea name="reply" style="width:250px; height:200px;"></textarea><br/>
            <input type="submit" name="ok" value="確定">
        </form>
    </h1></center>
</body>
</html>