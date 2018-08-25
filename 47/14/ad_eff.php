<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link type="text/css" href="css.css" rel="stylesheet">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	$id=$_POST['id'];
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	$d=explode(' ',$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	
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
		$dd=$_POST['dd'];
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$text=$_POST['text'];
		
		$mysql->query("UPDATE `eat` SET `day` = '$day', `mon` = '$mon', `tp` = '$tp', `quan` = '$quan', `menu` = '$menu', `tab` = '$tab', `tnum` = '$tnum', `money` = '$money', `moneymoney` = '$moneymoney', `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text', `dd` = '$dd' WHERE `eat`.`id` = '$id'");
		header("location:ad_e.php");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 以選則訂餐資訊確認<p/>
        
        <form method="post">
        	<table width="30%">	
            	<tr>
                	<th width="50%" bgcolor="#CCCCCC">訂餐編號</th>
                    <td><input type="text" name="number" value="<?=$a['number']?>" readonly></td>
                </tr>
            	<tr>
                	<th width="50%" bgcolor="#CCCCCC">日期</th>
                    <td><input type="text" name="day" value="<?=$d[0]?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">星期</th>
                    <td><input type="text" name="mon" value="<?=$d[1]?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">時段</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">訂餐桌數</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">總金額</th>
                    <td><input type="text" name="money" value="$<?=$money?>元" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="$<?=$moneymoney?>元" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">姓名</th>
                    <td><input type="text" name="name" id="name" value="<?=$a['name']?>"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">E_MAIL</th>
                    <td><input type="text" name="email" id="email" value="<?=$a['email']?>"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">電話</th>
                    <td><input type="text" name="phone" id="phone" value="<?=$a['phone']?>"></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">備註</th>
                    <td><input type="text" name="text" id="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="hidden" name="dd" value="<?=$_POST['dd']?>" id="dd">
                        <input type="hidden" name="id" value="<?=$_POST['id']?>" id="id">
                    	<input type="submit" value="確定" name="ok">
                        <input type="button" value="取消" onClick="location.href='ad_e.php?id=<?=$id?>'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>