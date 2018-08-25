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
	
	if($_POST['f']){
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$text=$_POST['text'];
		$mysql->query("UPDATE `eat` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `id` = '$id'");
		
		header("location:index.php");
		
	}
	
?>
<body bgcolor="#6699FF">
    <center><h1>
    	訪客訂餐 - 填寫絡方式<p/>
        
        <form method="post" id="su">
        	<table width="25%" border="1">
            	<tr>
                	<th bgcolor="#999999">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">電話</th>
                    <td><input type="tel" name="phone"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">E_MMAIL</th>
                    <td><input type="tel" name="email"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">內容</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="f" value="送出">
                        <input type="reset" value="重置">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
    
</body>
</html>