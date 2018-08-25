<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	$id=$_GET['id'];
	
	if($_POST['ok']){
		$reply=$_POST['reply'];
		if($reply !=""){
				$mysql->query("INSERT INTO `mrepoly` (`mid`, `text`) VALUES ('$id', '$reply')");
				header("location:mess-manage.php");
		}else{
			echo "<script>alert('未填寫完成')</script>";
		}
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body bgcolor="#6699FF">
	
    	<center><h1>
        	管理者回覆<input type="button" value="返回" onClick="location.href='mess-manage.php'"><p/>
            
            <form method="post">
            	回覆:<br/>
                <textarea style="width:250px; height:100px;" name="reply"></textarea><p/>
                <input type="submit" name="ok" value="確定">
            </form>
        </h1></center>

</body>
</html>