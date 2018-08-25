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
			echo'<script>alert("未填寫")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	留言回覆<input type="button" value="返回" onClick="location.href='ad_m.php'"><p/>
        
        <form method="post">
        	<textarea name="reply" style="width:200px; height:130px;"></textarea><p/>
            <input type="submit" name="ok" value="確定">
        </form>
        
    </h1></center>
</body>
</html>