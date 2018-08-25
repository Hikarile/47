
<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$emall=$_POST['emall'];
		$phone=$_POST['phone'];
		$png=$_FILES['png']['name'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		$ey=$_POST['ey'];
		$py=$_POST['py'];
		
		if($name!=""){
			if($emall !=""){
				if($phone !=""){
					if($text !=""){
						if($number !=""){
							
							
							if($a['png'] == ""){
								move_uploaded_file($_FILES['png']['tmp_name'],'file/'.$_FILES['png']['name']);//複製檔案
								$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text', `number` = '$number', `ey` = '$ey', `py` = '$py' WHERE `id` = '$id'");
							header("location:mess-manage.php");
							}else{
								if($png == ""){
									$day=date("Y/m/d H:i:s");
									$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text', `number` = '$number', `ey` = '$ey', `py` = '$py' WHERE `id` = '$id'");
							header("location:mess-manage.php");
								}else{
									move_uploaded_file($_FILES['png']['tmp_name'],'file/'.$_FILES['png']['name']);//複製檔案
									$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text', `number` = '$number', `ey` = '$ey', `py` = '$py' WHERE `id` = '$id'");
							header("location:mess-manage.php");
								}
								
							}
							
							
						}else{
							echo "<script>alert('序號未填')</script>";
						}
					}else{
						echo "<script>alert('內容未填')</script>";
					}
				}else{
					echo "<script>alert('電話未填')</script>";
				}
			}else{
				echo "<script>alert('E-mail未填')</script>";
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
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	修改留言<input type="button" value="返回" onClick="location.href='mess-manage.php'"><p/>
        
        <form method="post">
        	姓名:
            <input type="text" name="name" value="<?=$a['name']?>"><br/>
            
            E-mall:
            <input type="email" name="emall" value="<?=$a['emall']?>">&nbsp;&nbsp;<input type="checkbox" name="ey" value="1"<?php if($a['ey']==1){echo"checked";}?>>顯示<br/>
            
            電話:
            <input type="tel" name="phone" value="<?=$a['phone']?>">&nbsp;&nbsp;<input type="checkbox" name="py" value="1"<?php if($a['py']==1){echo"checked";}?>>顯示<br/>
            圖片:
            <input type="file" name="png" value="file/<?=$a['png']?>"><br/>
            
            內容:
            <textarea name="text"><?=$a['text']?></textarea><br/>
            
            留言序號:
            <input type="text" name="number" value="<?=$a['number']?>"><br/>
            
            <input type="submit" name="ok" value="確定">
        </form>
        <input type="button" value="重設" onClick="location.href='mf.php?id=<?=$id?>'">
    </h1></center>
    
</body>
</html>