<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	$day=$_POST['day'];
	$tp=$_POST['tp'];
	$quan=$_POST['quan'];
	$menu=$_POST['menu'];
	$tab=$_POST['tab'];
	$tnum=$_POST['tnum'];
	$d=explode(' ',$day);
	$money=$quan*300;
	$moneymoney=$money/10;
	$_SESSION['save']=$_SESSION['save']+1;
	$nu=str_pad($_SESSION['save'],4,'0',STR_PAD_LEFT);
	$da=date("Ymd");
	$number=$da.$nu;
	
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
		$mysql->query("INSERT INTO `eat` (`number`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
        訪客訂餐 - 以選擇訂餐資訊在確認<p/>
        
        <form method="post">
        	<table width="40%">
            	<tr>
                    <th bgcolor="#999999" width="50%">訂餐編號</th>
                    <th><input type="text" name="number" value="<?=$number?>" readonly></th>
                </tr>
            	<tr>
                    <th bgcolor="#999999" width="50%">日期</th>
                    <th><input type="text" name="day" value="<?=$d[0]?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">星期</th>
                    <th><input type="text" name="mon" value="<?=$d[1]?>" readonly></th>
                </tr>
            	<tr>
                    <th bgcolor="#999999" width="50%">訂餐數量</th>
                    <th><input type="text" name="quan" value="<?=$quan?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">套餐名稱</th>
                    <th><input type="text" name="menu" value="<?=$menu?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">訂餐桌數</th>
                    <th><input type="text" name="tab" value="<?=$tab?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">桌號</th>
                    <th><input type="text" name="tnum" value="<?=$tnum?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">總金額</th>
                    <th><input type="text" name="money" value="<?=$money?>" readonly></th>
                </tr>
                <tr>
                    <th bgcolor="#999999" width="50%">需付訂金</th>
                    <th><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly></th>
                </tr>	
                <tr>
                    <th colspan="2">
                    	<input type="submit" value="確定訂餐" name="ok">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
    </h1></center>
    
</body>
</html>