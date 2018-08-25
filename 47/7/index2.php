<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>

</script>
</head>
<?php
	include("cd.php");
	$d=explode(' ',$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	
	$dd=date("Ymd");
	$_SESSION['save']=$_SESSION['save']+1;
	$save=$_SESSION['save'];
	$sa=str_pad($save,4,'0',STR_PAD_LEFT);
	$number=$dd.$sa;
	
	
	if($_POST['ok']){
		$number=$_POST['number'];
		$day=$_POST['day'];
		$mon=$_POST['mon'];
		$tp=$_POST['tp'];
		$quan=$_POST['quan'];
		$menu=$_POST['menu'];
		$tab=$_POST['tab'];
		$tnum=$_POST['tnum'];
		$money=$_POST['money'];
		$moneymoney=$_POST['moneymoney'];
		$mysql->query("INSERT INTO `eat` (`number`, `day`,`mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
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
                	<th bgcolor="#999999" width="50%">訂餐編號</th>
                    <td><input type="text" name="number" value="<?=$number?>" readonly></td>
                </tr>
            	<tr>
                	<th bgcolor="#999999" width="50%">日期</th>
                    <td><input type="text" name="day" value="<?=$d[0]?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">星期</th>
                    <td><input type="text" name="mon" value="<?=$d[1]?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">時段</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">訂餐桌數</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">總金額</th>
                    <td><input type="text" name="money" value="<?=$money?>" readonly></td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="50%">需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly></td>
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