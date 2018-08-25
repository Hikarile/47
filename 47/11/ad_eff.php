<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$d=explode(' ',$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	echo $id=$_POST['id'];
	
	if($_POST['ok']){
		$new=date("Ymd");
		$day=$_POST['day'];
		$mon=$_POST['mon'];
		$tp=$_POST['tp'];
		$quan=$_POST['quan'];
		$menu=$_POST['menu'];
		$tab=$_POST['tab'];
		$tnum=$_POST['tnum'];
		$money=$_POST['money'];
		$session=$_POST['session'];
		$moneymoney=$_POST['moneymoney'];
		$c=$_POST['c'];
		
		$mysql->query("UPDATE `eat` SET `day` = '$day', `mon` = '$mon', `session` = '$session', `tp` = '$tp', `quan` = '$quan', `menu` = '$menu', `tab` = '$tab', `tnum` = '$tnum', `money` = '$money', `moneymoney` = '$moneymoney', `c` = '$c' WHERE `id` = '$id'");
		$id=mysqli_insert_id($mysql);
		header("location:ad_e.php");
	}
	
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px;" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px;" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        
    	訪客訂餐 - 以選擇訂餐資訊在確認<p/>
    	<form method="post">
        	<table border="1" width="35%">
            	<tr>
                	<th width="50%" bgcolor="#999999">日期</th>
                    <td><input type="text" name="day" value="<?=$d[0]?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">星期</th>
                    <td><input type="text" name="mon" value="<?=$d[1]?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">時段</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">訂餐桌數</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">總金額</th>
                    <td><input type="text" name="money" value="<?=$money?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#999999">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="hidden" name="c" value="<?=$_POST['c']?>">
                    	<input type="hidden" name="session" value="<?=$_SESSION['a']?>">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
    </h1></center>
</body>
</html>