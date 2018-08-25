<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#s").submit(function(){
			name=$("[name=name]").val();
			email=$("[name=email]").val();
			phone=$("[name=phone]").val();
			text=$("[name=text]").val();
			if(name=='' || email=='' || phone=='' || text==''){
				alert("未填寫完成");
			}
		})
	})
	
</script>
</head>
<?php
	include("include.php");
	$id=$_GET['id'];
	
	if($_POST['ok']){
		$mysql->query("UPDATE `eat` SET `name` = '".$_POST['name']."', `email` = '".$_POST['email']."', `phone` = '".$_POST['phone']."', `text` = '".$_POST['text']."' WHERE `id` = '$id'");
		header("location:index.php");
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="s">
        	<table width="30%">
            	<tr>
                	<th width="50%" bgcolor="#999999">姓名:</th>
                    <td><input type="text" name="name" value="<?=$_POST['name']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">E_MAIL:</th>
                    <td><input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$" value="<?=$_POST['email']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">電話:</th>
                    <td><input type="tel" name="phone" pattern="^[09]{2}[0-9]{8}|[02]{2}[/-][0-9]{8}$" value="<?=$_POST['phone']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999">備註:</th>
                    <td><input type="text" name="text" value="<?=$_POST['text']?>"></td>
                </tr>
                <tr>
                	<th colspan="2"><input type="submit" name="ok" value="確定"></th>
                </tr>
            </table>
        </form>
        
    </h1></center>
    
</body>
</html>