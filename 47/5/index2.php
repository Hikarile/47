<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$_SESSION['save']=$_SESSION['save']+1;
	$d=explode(" ",$_POST['day']);
	$money=$_POST['quan']*300;
	$moneymoney=$money/10;
	$nu=str_pad($_SESSION['save'],4,'0',STR_PAD_LEFT);
	$dd=date("Ymd");
	$number=$dd.$nu;
	
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
		$mysql->query("INSERT INTO `eat` (`number`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`) VALUES ('$number', '$day', '$mon', '$tp', '$quan', '$menu', '$tab', '$tnum', '$money', '$moneymoney')");
		$id=mysqli_insert_id($mysql);
		header("location:index3.php?id=".$id);
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
        訪客訂餐 - 以選擇訂餐資訊確認<p/>
        
        <form method="post">
        	<table border="1" width="30%">
            	<tr>
                	<th>訂餐編號</th>
                    <td><input type="text" name="number" value="<?=$number?>"></td>
                </tr>
            	<tr>
                	<th>日期</th>
                    <td><input type="text" name="day" value="<?=$d[0]?>"></td>
                </tr>
                <tr>
                	<th>星期</th>
                    <td><input type="text" name="mon" value="<?=$d[1]?>"></td>
                </tr>
                <tr>
                	<th>時段</th>
                    <td><input type="text" name="tp" value="<?=$_POST['tp']?>"></td>
                </tr>
                <tr>
                	<th>訂餐數量</th>
                    <td><input type="text" name="quan" value="<?=$_POST['quan']?>"></td>
                </tr>
                <tr>
                	<th>套餐名稱</th>
                    <td><input type="text" name="menu" value="<?=$_POST['menu']?>"></td>
                </tr>
                <tr>
                	<th>訂餐桌數</th>
                    <td><input type="text" name="tab" value="<?=$_POST['tab']?>"></td>
                </tr>
                <tr>
                	<th>桌號</th>
                    <td><input type="text" name="tnum" value="<?=$_POST['tnum']?>"></td>
                </tr>
                <tr>
                	<th>總金額</th>
                    <td><input type="text" name="money" value="<?=$money?>"></td>
                </tr>
                <tr>
                	<th>需付訂金</th>
                    <td><input type="text" name="moneymoney" value="<?=$moneymoney?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定訂餐">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
    
</body>
</html>