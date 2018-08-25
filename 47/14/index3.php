<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			if($("#name").val()==''){
				alert("姓名未填");
				return false;
			}if($("#email").val()==''){
				alert("E_MAIL未填");
				return false;
			}if($("#phone").val()==''){
				alert("電話未填");
				return false;
			}if($("#text").val()==''){
				alert("備註未填");
				return false;
			}
		})
	})
</script>
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$day=$_POST['day'];
		$mon=$_POST['mon'];
		$tp=$_POST['tp'];
		$quan=$_POST['quan'];
		$menu=$_POST['menu'];
		$tab=$_POST['tab'];
		$tnum=$_POST['tnum'];
		$money=preg_replace('/[^\d]/','',$_POST['money']);
		$moneymoney=preg_replace('/[^\d]/','',$_POST['moneymoney']);
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		$dd=$_POST['dd'];
		
		$new=date("Ymd");
		$aa=$mysql->query("SELECT Max(number) as 'dd' FROM `eat` where `new` = '$new' ");
		if($a=mysqli_fetch_array($aa)){
			if($a['dd']==''){
				$sa=str_pad(1,4,'0',STR_PAD_LEFT);
				$number=$new.$sa;
			}else{
				$number=$a['dd']+1;
			}
		}
		$mysql->query("INSERT INTO `eat` (`number`, `new`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `email`, `phone`, `text`,`dd`) VALUES ('$number', '$new', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney', '$name', '$email', '$phone', '$text','$dd')");
		$id=mysqli_insert_id($mysql);
		header('location:end.php?id='.$id);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 填寫聯絡方式<p/>
        
        <form method="post" id="su">
        	<input type="hidden" name="day" value="<?=$_GET['day']?>">
            <input type="hidden" name="mon" value="<?=$_GET['mon']?>">
            <input type="hidden" name="tp" value="<?=$_GET['tp']?>">
            <input type="hidden" name="quan" value="<?=$_GET['quan']?>">
            <input type="hidden" name="menu" value="<?=$_GET['menu']?>">
            <input type="hidden" name="tab" value="<?=$_GET['tab']?>">
            <input type="hidden" name="tnum" value="<?=$_GET['tnum']?>">
            <input type="hidden" name="money" value="<?=$_GET['money']?>">
            <input type="hidden" name="moneymoney" value="<?=$_GET['moneymoney']?>">
            <input type="hidden" name="dd" value="<?=$_GET['dd']?>">
        	<table width="30%">
            	<tr>
                	<th width="50%" bgcolor="#CCCCCC">姓名</th>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">E_MAIL</th>
                    <td><input type="text" name="email" id="email"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">電話</th>
                    <td><input type="text" name="phone" id="phone"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">備註</th>
                    <td><input type="text" name="text" id="text"></td>
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