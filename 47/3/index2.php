<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	function out(){
		if(confirm("確定要取消嗎?")){
			location.href='index.php';
		}else{
			alert("取消成功");
		}
	}
</script>
</head>
<?php
	include("cd.php");
	$d=explode(' ',$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	
	if($_POST['ok']){
		echo "<script>alert('')</script>";
		$day=$_POST['day'];
		$mon=$_POST['mon'];
		$tp=$_POST['tp'];
		$quan=$_POST['quan'];
		$menu=$_POST['menu'];
		$tab=$_POST['tab'];
		$tnum=$_POST['tnum'];
		
		$_SESSION['save']++;
		$save=str_pad($_SESSION['save'],4,'0',STR_PAD_LEFT);
		$dd=date("Ymd");
		$number=$dd.$save;
		
		$mysql->query("INSERT INTO `eat` (`number`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '".$_POST['money']."', '".$_POST['moneymoney']."')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	
        訪客訂餐 - 以選擇訂餐資訊在確認<p/>
        <form method="post">
        	<table width="40%" border="1">
                <tr>
                    <th width="50%" bgcolor="#999999">日期:</th>
                    <td><input type="text" name="day" value="<?=$d[0]?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">星期:</th>
                    <td><input type="text" name="mon" value="<?=$d[1]?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">時段:</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐數量:</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">套餐名稱:</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">訂餐桌數:</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">桌號:</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">總金額:</th>
                    <td><input type="text" name="money" value="<?=$money?>" readonly></td>
                </tr>
                <tr>
                    <th width="50%" bgcolor="#999999">需付訂金:</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>" readonly></td>
                </tr>
                <tr>	
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="取消" onClick="out()">
                    </th>
                </tr>
            </table>
        </form>
        
        
    </h1></center>
    
</body>
</html>