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
		$phone=$_POST['phone'];
		$py=$_POST['py'];
		$email=$_POST['email'];
		$ey=$_POST['ey'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		function aa($name,$phone,$email,$text,$number){
			if($name=="" ||$phone=="" ||$email=="" ||$text=="" ||$number==""){
				return '<script>alert("未填寫完成")</script>';
			}
		}$a=aa($name,$phone,$email,$text,$number);
		if($a==''){
			$time=date("Y-m-d h:i:s");
			$mysql->query("INSERT INTO `message` (`name`, `email`, `phone`, `text`, `number`, `py`, `ey`, `time`) VALUES ('$name', '$email', '$phone', '$text', '$number', '$py', '$ey', '$time')");
			if($_FILES['png']['name']!=''){
				$id=mysqli_insert_id($mysql);
				move_uploaded_file($_FILES['png']['tmp_name'],'file/'.$id.$_FILES['png']['name']);
				$mysql->query("INSERT INTO `png` (`mid`, `pan`, `png`) VALUES ('$id', '$id','".$_FILES['png']['name']."')");
			}
			header("location:message.php");
		}else{
			echo $a;
		}
		
	}
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	新增留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data">
        	<table  width="40%">
            	<tr>
                	<th bgcolor="#999999" width="50%">姓名:</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">電話:</th>
                    <td>
                    	<input type="tel" name="phone" pattern="^[02]{2}[/-][0-9]{8}|[0]{1}[0-9]{9}$">
                        <input type="checkbox" name="py" value="1" checked>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">EMAIL:</th>
                    <td>
                    	<input type="tel" name="email" pattern="^[\w]+@[\w]+.+[\w]+$">
                    	<input type="checkbox" name="ey" value="1" checked>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">圖片:</th>
                    <td><input type="file" name="png"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">內容:</th>
                    <td><input type="text" name="text"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">序號:</th>
                    <td><input type="tel" name="number" pattern="^[A-Za-z]{3}[0-9]{3}$"></td>
                </tr>
                <tr>
                	<th colspan="3">
                    	<input type="submit" name="ok" value="確定">
                        <input type="reset" value="重置">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
    
</body>
</html>