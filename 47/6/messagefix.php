<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	$bb=$mysql->query("SELECT * FROM `png` where `mid` = '$id'");
	$b=mysqli_fetch_array($bb);
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$py=$_POST['py'];
		$email=$_POST['email'];
		$ey=$_POST['ey'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		function aa($name,$phone,$email,$text,$number){
			if($name==''||$phone==''||$email==''||$text==''||$number==''){
				return '<script>alert("未填寫完成")</script>';
			}else{return'';}
		}$a=aa($name,$phone,$email,$text,$number);
		if($a==''){
			$time=date("Y-m-d h:i:s");
			$mysql->query("UPDATE `message` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text', `number` = '$number', `py` = '$py', `ey` = '$ey', `ftime` = '$time' WHERE `id` = '$id'");
			if($_FILES['png']['name']!=''){
				$id=mysqli_insert_id($mysql);
				move_uploaded_file($_FILES['png']['tmp_name'],'file/'.$_FILES['png']['name']);
				$mysql->query("INSERT INTO `png` (`mid`, `pan`, `png`) VALUES ('$id', '$id', '".$_FILES['png']['name']."')");
			}
			header("location:message.php");
			exit;
		}else{echo $a;}
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	修改留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data">
        	<table width="40%">
            	<tr>
                	<th bgcolor="#999999" width="50%">姓名:</th>
                    <td><input type="text" name="name" value="<?=$a['name']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">電話:</th>
                    <td>
                    	<input type="tel" name="phone" pattern="[0]{1}[/-][0-9]{9}|[09]{2}[0-9]{8}" value="<?=$a['phone']?>">
                    	<input type="checkbox" name="py" value="1"<?php if($a['py']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">E_MAIL:</th>
                    <td>
                    	<input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$" value="<?=$a['email']?>">
                    	<input type="checkbox" name="ey" value="1"<?php if($a['ey']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <tr>
                	<?php
                    if($b['png']==''){
					?>
                    <th bgcolor="#999999" width="50%">圖片:</th>
                    <td><input type="file" name="png"></td>
					<?php
					}else{
						echo'<th><img width="50%" src="file/'.$b['png'].'">
							<input type="button" value="刪除" onClick="location.href=\'pngd.php?id='.$id.'\'">
							</th>';
					}
					?>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">內容:</th>
                    <td><input type="text" name="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">序號:</th>
                    <td><input type="tel" name="number" pattern="[A-Za-z]{3}[0-9]{3}" value="<?=$a['number']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                        <input type="reset" value="重置">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></h1>
    
</body>
</html>