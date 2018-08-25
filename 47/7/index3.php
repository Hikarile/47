<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			name=$("[name='name']").val();
			phone=$("[name='phone']").val();
			email=$("[name='email']").val();
			text=$("[name='text']").val();
			if(name==''||phone==''||email==''||text==''){
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
		$nama=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		$mysql->query("UPDATE `eat` SET `name` = '$nama', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `id` = '$id'");
		header("location:index.php");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="su">
        	<table width="30%">
            	<tr>
                	<th bgcolor="#999999" width="50%">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">電話</th>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">E_MAIL</th>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">備註</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th colspan="2">
                        <input type="submit" value="送出" name="ok">
                        <input type="reset" value="重設">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>