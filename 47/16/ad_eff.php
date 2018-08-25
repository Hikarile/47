<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$id=$_POST['id'];
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	$mm=$mysql->query("SELECT * FROM `menu` where `menu` = '".$_POST['menu']."'");
	$m=mysqli_fetch_array($mm);
	$money=$_POST['quan']*$m['money'];
	$moneymoney=$money/10;
	
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
		$id=$_POST['id'];
		$d=explode(' ',$day);
		
		$mysql->query("UPDATE `eat` SET `day` = '".$d[0]."', `mon` = '".$d[1]."', `tp` = '$tp', `quan` = '$quan', `menu` = '$menu', `tab` = '$tab', `tnum` = '$tnum', `money` = '$money', `moneymoney` = '$moneymoney', `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text', `dd` = '$dd' WHERE `eat`.`id` = '$id'");
		$id=mysqli_insert_id($mysql);
		header("location:ad_e.php");
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
        
        <form method="post">
        	<table width="30%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">訂餐編號</th>
                    <td><input type="text" name="day" value="<?=$a['number']?>" readonly></td>
                </tr>
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">日期</th>
                    <td><input type="text" name="day" value="<?=$_POST['day']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">時段</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">桌數</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">總金額</th>
                    <td><input type="text" name="money" value="$<?=$money?>元"readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="$<?=$moneymoney?>元"readonly><br/>(總金額之10%)</td>
                </tr>
			</table>
            <hr>
            <table width="30%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">姓名</th>
                    <td><input type="text" name="name" id="name" value="<?=$a['name']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">E_MAIL</th>
                    <td><input type="text" name="email" id="email" value="<?=$a['email']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">電話</th>
                    <td><input type="text" name="phone" id="phone" value="<?=$a['phone']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">備註</th>
                    <td><input type="text" name="text" id="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="hidden" name="dd" value="<?=$_POST['dd']?>">
                        <input type="hidden" name="id" value="<?=$_POST['id']?>">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="取消" onClick="location.href='ad_ef.php?id=<?=$_POST['id']?>'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>