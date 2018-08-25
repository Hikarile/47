<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("include.php");
	
	$id=$_GET['id'];
	if($_POST['ok']){
		$text=$_POST['text'];
		$time=date("Y-m-d h:i:s");
		$mysql->query("INSERT INTO `reply` (`mid`, `text`, `time`) VALUES ('$id', '$text', '$time')");
		header("location:ad_mess.php");
	}
	
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	回覆留言<input type="button" value="返回" onClick="location.href='ad_mess.php'"><p/>
        
        回覆:
        <form method="post">
        	<textarea name="text" style="width:20%; height:150px;"></textarea><br/>
            <input type="submit" name="ok" value="確定">	
        </form>
        
    </h1></center>
    
</body>
</html>