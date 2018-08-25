<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$mm=$mysql->query("SELECT * FROM `menu` where `menu` = '".$_POST['menu']."'");
	$m=mysqli_fetch_array($mm);
	$money=$_POST['quan']*$m['money'];
	$moneymoney=$money/10;
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
        
        <form method="post" action="fff.php">
        	<table width="30%">
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
                <tr>
                	<th colspan="2">
                    	<input type="hidden" name="dd" value="<?=$_POST['dd']?>">
                    	<input type="submit"  value="確定">
                        <input type="button" value="取消" onClick="location.href='f.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>