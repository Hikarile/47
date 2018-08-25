<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			if($("#name").val()==''){
				alert("姓名未填");
				return false;
			}
			if($("#email").val()==''){
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
		
		$d=explode(' ',$day);
		$new=date("Ymd");
		$aa=$mysql->query("SELECT Max(number)as`dd` FROM `eat` where `new` = '$new'");
		$a=mysqli_fetch_array($aa);
		if($a['dd']!=''){
			$number=$a['dd']+1;
		}else{
			$sa=str_pad(1,4,'0',STR_PAD_LEFT);
			$number=$new.$sa;
		}
		$mysql->query("INSERT INTO `eat` (`number`, `new`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `email`, `phone`, `text`, `dd`) VALUES ('$number', '$new', '".$d[0]."', '".$d[1]."', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney', '$name', '$email', '$phone', '$text', '$dd')");
		$id=mysqli_insert_id($mysql);
		header("location:end.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
        <table border="1" width="80%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='f.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="套餐管理" onClick="location.href='menu.php'"></th>
            </tr>
        </table>
		<?php
		}
		?><p/>訪客訂餐 - 以選擇訂餐資訊在確認<p/>
        
        <form method="post" id="su">
        	<table width="30%">
            	<input type="hidden" name="day" value="<?=$_POST['day']?>" readonly>
                <input type="hidden" name="tp" value="<?=$_POST['tp']?>"readonly>
                <input type="hidden" name="quan" value="<?=$_POST['quan']?>"readonly>
                <input type="hidden" name="menu" value="<?=$_POST['menu']?>"readonly>
                <input type="hidden" name="tab" value="<?=$_POST['tab']?>"readonly>
                <input type="hidden" name="tnum" value="<?=$_POST['tnum']?>"readonly>
                <input type="hidden" name="money" value="<?=$_POST['money']?>"readonly>
                <input type="hidden" name="moneymoney" value="<?=$_POST['moneymoney']?>"readonly>
                <input type="hidden" name="dd" value="<?=$_POST['dd']?>"readonly>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">姓名</th>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">E_MAIL</th>
                    <td><input type="text" name="email" id="email"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">電話</th>
                    <td><input type="text" name="phone" id="phone"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">備註</th>
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