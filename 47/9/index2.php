<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$d=explode(" ",$_POST['day']);
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
		$money=$_POST['money'];
		$moneymoney=$_POST['moneymoney'];
		$mysql->query("INSERT INTO `eat` (`day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 以選擇訂餐再確認<p/>
        <form method="post">
        <table  width="30%">
        	<tr>
            	<th width="50%" bgcolor="#999999">日期</th>
                <td width="50%"><input type="text" name="day" value="<?=$d[0]?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">星期</th>
                <td width="50%"><input type="text" name="mon" value="<?=$d[1]?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">時段</th>
                <td width="50%"><input type="text" name="tp" value="<?=$_POST['tp']?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">訂餐數量</th>
                <td width="50%"><input type="text" name="quan" value="<?=$_POST['quan']?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">套餐名稱</th>
                <td width="50%"><input type="text" name="menu" value="<?=$_POST['menu']?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">訂餐桌數</th>
                <td width="50%"><input type="text" name="tab" value="<?=$_POST['tab']?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">桌號</th>
                <td width="50%"><input type="text" name="tnum" value="<?=$_POST['tnum']?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">日期</th>
                <td width="50%"><input type="text" name="day" value="<?=$d[0]?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">總金額</th>
                <td width="50%"><input type="text" name="money" value="<?=$money?>"></td>
            </tr>
            <tr>
            	<th width="50%" bgcolor="#999999">需付訂金</th>
                <td width="50%"><input type="text" name="moneymoney" value="<?=$moneymoney?>"></td>
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