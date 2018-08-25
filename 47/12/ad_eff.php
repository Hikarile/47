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
	
	if($_GET['oo']){
		header("location:ad_efff.php?day=".$_GET['day']."&mon=".$_GET['mon']."&tp=".$_GET['tp']."&quan=".$_GET['quan']."&menu=".$_GET['menu']."&tab=".$_GET['tab']."&tnum=".$_GET['tnum']."&money=".$_GET['money']."&moneymoney=".$_GET['moneymoney']."&dd=".$_GET['dd']."&id=".$_GET['id']);
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐 - 以選擇訂餐資訊在確認<p/>
        
        <form method="get">
        	<table width="30%">
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
                    <td><input type="text" name="money" value="<?=$money?>" readonly></td>
                </tr>
                <tr>
                	<th width="50%" bgcolor="#CCCCCC">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="hidden" name="dd" value="<?=$_POST['dd']?>">
                        <input type="hidden" name="id" value="<?=$_POST['id']?>">
                    	<input type="submit" name="oo" value="確定">
                        <input type="button" value="取消" onClick="location.href='ad_ef.php?id=<?=$_POST['id']?>'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>