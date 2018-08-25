
<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$emall=$_POST['emall'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		$png=$_FILES['png']['name'];
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
								$day=date("Y/m/d H:i:s");
								$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text',`png`='$png', `number` = '$number', `ey` = '$ey', `py` = '$py', `fixday` = '$day' WHERE `id` = '$id'");
								header("location:message.php");
							}else{
								if($png == ""){
									$day=date("Y/m/d H:i:s");
									$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text', `number` = '$number', `ey` = '$ey', `py` = '$py', `fixday` = '$day' WHERE `id` = '$id'");
									header("location:message.php");
								}else{
									move_uploaded_file($_FILES['png']['tmp_name'],'file/'.$_FILES['png']['name']);//複製檔案
									$day=date("Y/m/d H:i:s");
									$mysql->query("UPDATE `message` SET `name` = '$name', `emall` = '$emall', `phone` = '$phone', `text` = '$text',`png`='$png', `number` = '$number', `ey` = '$ey', `py` = '$py', `fixday` = '$day' WHERE `id` = '$id'");
									header("location:message.php");
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
<script src="jquery.js" type="text/javascript"></script>
<script>
	
</script>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	修改留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
		<form method="post" enctype="multipart/form-data" id="sub">
        	姓名:
            <input type="text" name="name" value="<?=$a['name']?>"><br/>
            
            E-mall:
            <input id="email" type="email" name="emall" value="<?=$a['emall']?>">&nbsp;&nbsp;<input type="checkbox" name="ey" value="1"<?php if($a['ey'] == 1){echo"checked";}?>>顯示<br/>
            
            電話:
            <input type="tel" name="phone" pattern="^[02]{2}[\-]\d{8}|[0]{1}[0-9]{9}$" value="<?=$a['phone']?>">&nbsp;&nbsp;<input type="checkbox" name="py" value="1"<?php if($a['py'] == 1){echo"checked";}?>>顯示<br/>
            
            內容:
            <textarea name="text"><?=$a['text']?></textarea><br/>
            
            圖片:
            <input type="file" name="png" value="file/<?=$a['png']?>"><br/>
            
            留言序號:
            <input type="tel" pattern="[A-Za-z]{3}[0-9]{3}" name="number" value="<?=$a['number']?>"><br/>
            
            <input type="submit" name="ok" value="確定">
        </form>
        <input type="button" value="重設" onClick="location.href='messadd.php'">
    </h1></center>
    
    <script>
    	$(function(){
			$("#sub").submit(function(){
				var email=$("#email").val();
				if (email.search(/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/)!=-1) {
				} else {
					alert("Email格式錯誤");
					return false;
				}
			});
		});
    </script>
</body>
</html>