<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			if(
				$("[name='name']").val()=='' ||
				$("[name='email']").val()=='' ||
				$("[name='phone']").val()=='' ||
				$("[name='text']").val()==''
			){
				alert("未填寫完成");
				return false;
			}
		})
	})
</script>
</head>
<?php
	include("cd.php");
	$id=$_GET['id'];
	if($_POST['ok']){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		$mysql->query("UPDATE `eat` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `id` = '$id'");
		header("location:index.php");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="su">
        	<table width="30%">
            	<tr>
                	<th width="50%" bgcolor="#999999">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">E_MAIL</th>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">電話</th>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">備註</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                        <input type="reset" value="重設">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>