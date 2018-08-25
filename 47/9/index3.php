<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			if($("[name='name']").val()==''||$("[name='phone']").val()==''||$("[name='email']").val()==''||$("[name='text']").val()==''){
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
	
	$_SESSION['save']+=1;
	$sa=str_pad($_SESSION['save'],4,'0',STR_PAD_LEFT);
	$da=date("Ymd");
	$number=$da.$sa;
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		
		$mysql->query("UPDATE `eat` SET `number` = '$number',`name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `eat`.`id` = '$id'");
		header("location:index.php");
	}
	
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="su">
        	<table width="30%">
            	<tr>
                	<th colspan="2">訂餐編號<input type="text" name="number" value="<?=$number?>" readonly></th>
                </tr>
            	<tr>
                	<th width="50%" bgcolor="#999999">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">電話</th>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">E_MAIL</th>
                    <td><input type="text" name="email"></td>
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