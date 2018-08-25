<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	$id=$_GET['id'];

	if($_POST['ok']){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		if($name != ""){
			if($email !=""){
				if($phone !=""){
					if($text !=""){
						$mysql->query("UPDATE `eat` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `id` = '$id'");
						header("location:index.php");
					}else{
						echo "<script>alert('備註未填')</script>";
					}
				}else{
					echo "<script>alert('電話未填')</script>";
				}
			}else{
				echo "<script>alert('E_MAIL未填')</script>";
			}
		}else{
			echo "<script>alert('姓名未填')</script>";
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	
</script>
<style>
	#button{
		width:100%;
		height:50px;
		font-size:35px;
		background-color:#39F;
	}
</style>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="sub">
			<table border="2">
            	<tr>
                	<td>姓名</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<td>E_MAIL</td>
                    <td><input id="email" type="email" name="email"></td>
                </tr>
                <tr>
                	<td>電話</td>
                    <td><input type="tel" name="phone" pattern="^[02]{2}[\-]\d{8}|[0]{1}[0-9]{9}$"></td>
                </tr>
                <tr>
                	<td>備註</td>
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
        <script>
        	$(function(){
				$("#sub").submit(function(){
					var email=$("#email").val();
					if (email.search(/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/)!=-1) {
					} else {
						alert("Email 資料錯誤？請重新輸入！");
						return false;
					}
				});
			});
        </script>
    </h1></center>
    
</body>
</html>