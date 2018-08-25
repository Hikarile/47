<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("include.php");
	$money=$_GET['quan']*300;
	$moneymoney=$money/10;
	
	$day=$_GET['day'];
	$dd=explode(' ',$day);
	if($_POST['ok']){
		$day=$_POST['day'];
		$d=explode('-',$day);
		$_SESSION['save']++;
		$sa=$_SESSION['save'];
		$save=str_pad($sa,4,'0',STR_PAD_LEFT);
		$number=$d[0].$d[1].$d[2].$d[3].$save;
		
		$mysql->query("INSERT INTO `eat` (`number`,`day`,`mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number','$day', '".$_POST['mon']."', '".$_POST['tp']."', '".$_POST['quan']."', '".$_POST['menu']."', '".$_POST['tab']."', '".$_POST['tnum']."', '".$_POST['money']."', '".$_POST['moneymoney']."')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	
        訪客訂餐 - 已選擇訂餐資訊再確認<p/>
        
        <form method="post">
            <table width="40%" border="">
                <tr>
                    <th width="50%" bgcolor="#999999">日期</th>
                    <td><input type="text" name="day" value="<?=$dd[0]?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">星期</th>
                    <td><input type="text" name="mon" value="<?=$dd[1]?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">時段</th>
                    <td><input type="text" name="tp" value="<?=$_GET['tp']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_GET['quan']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_GET['menu']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐桌數</th>
                    <td><input type="text" name="tab" value="<?=$_GET['tab']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_GET['tnum']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">總金額</th>
                    <td><input type="text" name="money" value="<?=$money?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly><br/>(需付總金額之10%)</td>
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