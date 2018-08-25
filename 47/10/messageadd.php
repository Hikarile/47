<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$ey=$_POST['ey'];
		$py=$_POST['py'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		
		function aa($name,$email,$phone,$text,$number){
			if($name==''||$email==''||$phone==''||$text==''||$number==''){
				return '<script>alert("未填寫完成")</script>';
			}else{return '';}
		}$a=aa($name,$email,$phone,$text,$number);
		if($a==''){
			$time=date("Y/m/d h:i:s");
			$mysqli->query("INSERT INTO `message` (`name`, `email`, `phone`, `ey`, `py`, `text`, `number`, `time`) VALUES ('$name', '$email', '$phone', '$ey', '$py', '$text', '$number', '$time')");
			
			if($_FILES['png']['name']!=''){
				$id=mysqli_insert_id($mysqli);
				move_uploaded_file($_FILES['png']['tmp_name'],"file/".$_FILES['png']['name']);
				$mysqli->query("INSERT INTO `png` (`mid`, `png`) VALUES ('$id', '".$_FILES['png']['name']."')");
			}
			header("location:message.php");
		}else{
			echo $a;
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	新增留言<input type="button"  value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data">
        	<table width="30%">
            	<tr>
                	<th width="50%" bgcolor="#999999">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">電話</th>
                    <td>
                    	<input type="tel" name="phone" pattern="[09]{2}[0-9]{8}|[0]{1}[0-9]{1}[/-][0-9]{8}">
                        <input type="checkbox" name="py" value="1">顯示
                    </td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">E_MAIL</th>
                    <td>
                    	<input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$">
                         <input type="checkbox" name="ey" value="1">顯示
                    </td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">圖片</th>
                    <td><input type="file" name="png"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">內容</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">留言序號</th>
                    <td><input type="tel" name="number" pattern="[A-Za-z]{3}[0-9]{3}"></td>
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