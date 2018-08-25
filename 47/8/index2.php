<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>

</head>
<?php
	include("cd.php");
	$da=explode(" ",$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	$_SESSION['save']=$_SESSION['save']+1;
	$sa=str_pad($_SESSION['save'],4,'0',STR_PAD_LEFT);
	$d=date("Ymd");
	$number=$d.$sa;
	
	if($_POST['ok']){
		$number=$_POST['number'];
		$day=$_POST['day'];
		$mon=$_POST['day'];
		$tp=$_POST['day'];
		$quan=$_POST['day'];
		$menu=$_POST['day'];
		$tab=$_POST['day'];
		$tnum=$_POST['day'];
		$money=$_POST['money'];
		$moneymoney=$_POST['moneymoney'];
		$mysql->query("INSERT INTO `eat` (`number`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 以選擇訂餐資訊再確認<p/>
        
        <form method="post">
        	<table width="30%">
            	<tr>
                    <th width="50%" bgcolor="#999999">訂餐編號</th>
                    <td><input type="text" name="number" value="<?=$number?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">日期</th>
                    <td><input type="text" name="day" value="<?=$da[0]?>"></td>
                </tr>
            	<tr>
                    <th width="50%" bgcolor="#999999">星期</th>
                    <td><input type="text" name="day" value="<?=$da[1]?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">時段</th>
                    <td><input type="text" name="day" value="<?=$_POST['tp']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐數量</th>
                    <td><input type="text" name="day" value="<?=$_POST['quan']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">套餐名稱</th>
                    <td><input type="text" name="day" value="<?=$_POST['menu']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐桌數</th>
                    <td><input type="text" name="day" value="<?=$_POST['tab']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">桌號</th>
                    <td><input type="text" name="day" value="<?=$_POST['tnum']?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">總金額</th>
                    <td><input type="text" name="money" value="<?=$money?>"></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>"></td>
                </tr>
                <tr>
                    <th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>