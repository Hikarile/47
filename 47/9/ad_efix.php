<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
?>
<body bgcolor="#6699FF">
	<center><h1>
   		修改訂餐<input type="button" value="返回" onClick="location.href='ad_e.php'"><p/>
    	<form method="post">
        	<table>
            	<tr>
                	<th></th>
                </tr>
            </table>
        </form>
    </h1></center>
</body>
</html>