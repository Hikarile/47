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
		$email=$_POST['email'];
		$ey=$_POST['ey'];
		$py=$_POST['py'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		
		function aa($name,$phone,$email,$text,$number){
			if($name==''||$phone==''||$email==''||$text==''||$number==''){
				return '<script>alert("未填寫完成")</script>';
			}else{return '';}
		}$a=aa($name,$phone,$email,$text,$number);
		
		if($a==''){
			$time=date("Y/m/d h:i:s");
			$mysql->query("UPDATE `message` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `ey` = '$ey', `py` = '$py', `text` = '$text', `number` = '$number', `ftime` = '$text' WHERE `id` = '$id'");
			
			if($_FILES['png']['name']!=''){
				move_uploaded_file($_FILES['png']['tmp_name'],"file/".$_FILES['png']['name']);
				$mysql->query("INSERT INTO `png` (`mid`, `png`) VALUES ('$id', '".$_FILES['png']['name']."')");
			}
			header("location:ad_m.php");
		}else{
			echo $a;
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	修改留言<input type="button" value="返回" onClick="location.href='ad_m.php'"><p/>
    	
        <form method="post" enctype="multipart/form-data">
        	<table width="30%">
                <tr>
                    <th width="50%" bgcolor="#CCCCCC">姓名</th>
                    <td><input type="text" name="name" value="<?=$a['name']?>"></td>
                </tr>
            	<tr>
                    <th width="50%" bgcolor="#CCCCCC">電話</th>
                    <td><input type="tel" name="phone" pattern="[0]{1}[0-9]{1}[/-][0-9]{8}|[09]{2}[0-9]{8}" value="<?=$a['phone']?>"><input type="checkbox" name="py" value="1" <?php if($a['py']==1){echo'checked';}?>>顯示</td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#CCCCCC">E_MAIL</th>
                    <td><input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]$" value="<?=$a['email']?>"><input type="checkbox" name="ey" value="1" <?php if($a['ey']==1){echo'checked';}?>>顯示</td>
                </tr>
                <tr>
                	<?php
                    if($b['png']==''){
						echo'<th width="50%" bgcolor="#CCCCCC">圖片</th>
                   			 <td><input type="file" name="png"></td>';
					}else{
					?>
                    <th>
                    	<img width="30%" src="file/<?=$b['png']?>">
                        <input type="button" value="刪除" onClick="location.href='pngd.php?id=<?=$id?>'">
                    </th>
					<?php
					}
					?>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#CCCCCC">內容</th>
                    <td><input type="text" name="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#CCCCCC">留言序號</th>
                    <td><input type="tel" name="number" pattern="[A-Za-z]{3}[0-9]{3}" value="<?=$a['number']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="送出">
                        <input type="reset" value="重設">
                    </th>
                </tr>
            </table>
        </form>        
        
    </h1></center>
</body>
</html>