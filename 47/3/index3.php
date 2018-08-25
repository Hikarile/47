<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#sub").submit(function(){
			var name=$('[name=name]').val();
			var phone=$('[name=phone]').val();
			var email=$('[name=email]').val();
			var text=$('[name=text]').val();
			if(name=='' || phone=='' || email=='' || text==''){
				alert('未填寫完成');
				return false;
			}
		})
	})
</script>
</head>
<?php
	include('cd.php');
	$id=$_GET['id'];
	
	if($_POST['oo']){
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
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="sub">
            <table width="40%">
                <tr>
                    <th bgcolor="#999999" width="50%">姓名:</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">電話:</th>
                    <td><input type="tel" name="phone" pattern="[0]{1}[0-9]{9}|[02]{2}[/-][0-9]{8}"></td>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">E_MAIL:</th>
                    <td><input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$"></td>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">備註:</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th colspan="2"><input type="submit" name="oo" value="確定"></th>
                </tr>
            </table>
        </form>
        
    </h1></center>
    
</body>
</html>