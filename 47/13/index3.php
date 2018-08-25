<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
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
		$money=preg_replace('/[^\d]/','',$_GET['money']);
		$moneymoney=preg_replace('/[^\d]/','',$_GET['moneymoney']);
		$dd=$_GET['dd'];
		
		$new=date("Ymd");
			
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		
		
		$aa=$mysqli->query("SELECT MAX(number) as 'dd' FROM `eat` where `new` = '$new'");
		$a=mysqli_fetch_array($aa);
		if($a['dd']==''){
			$sa=str_pad(1,4,'0',STR_PAD_LEFT);
			$number=$new.$sa;
		}else{
			$number=$a['dd']+1;
		}
		
		$mysqli->query("INSERT INTO `eat` ( `number`,`new`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `email`, `phone`, `text`, `dd`) VALUES ('$number','$new', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney', '$name', '$email', '$phone', '$text', '$dd')");
		$id=mysqli_insert_id($mysqli);
		
		header("location:end.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post">
        	<table width="30%">
            	<tr>
                	<th width="50%" bgcolor="#CCCCCC">姓名</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">E_MAIL</th>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">電話</th>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">備註</th>
                    <td><input type="text" name="text"><td>
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