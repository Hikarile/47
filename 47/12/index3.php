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
				$("[name='name']").val()==''||
				$("[name='phone']").val()==''||
				$("[name='email']").val()==''||
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
	if($_POST['ok']){
		
		$day=$_GET['day'];
		$mon=$_GET['mon'];
		$tp=$_GET['tp'];
		$quan=$_GET['quan'];
		$menu=$_GET['menu'];
		$tab=$_GET['tab'];
		$tnum=$_GET['tnum'];
		$money=$_GET['money'];
		$moneymoney=$_GET['moneymoney'];
		$dd=$_GET['dd'];
		
		$new=date("Ymd");
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$text=$_POST['text'];
		$mysql->query("INSERT INTO `eat` (`day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `phone`, `email`, `text`,`new`,`dd`) VALUES ('$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney', '$name', '$phone', '$email', '$text' ,'$new','$dd')");
		$id=mysqli_insert_id($mysql);
		header("location:end.php?id=".$id);
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
    	<form method="post" id="su">
        	<table width="30%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">電話</th>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">E_MAIL</th>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">備註</th>
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