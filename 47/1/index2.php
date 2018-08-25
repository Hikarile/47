<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	if($_POST['day'] == ""){
		header("location:index.php");
	}else{
		if($_POST['tnum'] == ""){
			header("location:index.php");
		}
	}
	
	$day=$_GET['day'];
	$total=$_POST['quan']*300;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	
</script>
<style>
	#button{
		width:100%;
		height:50px;
		font-size:35px;
		background-color:#39F;
	}
</style>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐 - 已選擇訂餐資訊再確認<p/>
        <table border="1" width="90%">
        	<tr height="50px">
            	<th><input  id="button" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input  id="button" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input  id="button" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table><p/>
        
        <form method="post" action="add.php">
			<table border="2">
				<tr>
					<td>日期</td>
					<td><input type="text" name="day" value="<?= $_POST['day'] ?>" readonly></td>
				</tr>
				<tr>
					<td>時段</td>
					<td><input type="text" name="tp" value="<?php
					if($_POST['tp'] == 1){
						echo "午餐";
					}else if($_POST['tp'] == 2){
						echo "下午茶";
					}else{
						echo "晚餐";
					}
					?>" readonly></td>
				</tr>
				<tr>
					<td>訂餐數量</td>
					<td><input type="text" name="quan" value="<?= $_POST['quan'] ?>客" readonly></td>
				</tr>
				<tr>
					<td>套餐名稱</td>
					<td><input type="text" name="menu" value="<?= $_POST['menu'] ?>" readonly></td>
				</tr>
				<tr>
					<td>訂餐桌數</td>
					<td><input type="text" name="tab" value="<?= $_POST['tab'] ?>桌" readonly></td>
				</tr>
				<tr>
					<td>桌號</td>
					<td><input type="text" name="tnum" value="<?= $_POST['tnum'] ?>" readonly></td>
				</tr>
				<tr>
					<td>總金額</td>
					<td><input type="text" name="money" value="<?= $total ?>元" readonly></td>
				</tr>
				<tr>
					<td>需付討金</td>
					<td><input type="text" name="moneymoney" value="<?= $total/10?>元" readonly>(總金額之10%)</td>
				</tr>
				<tr>
					<th colspan="2">
                        <input type="hidden" name="number" value="<?= $_POST['number'] ?>">
						<input type="submit" value="確定訂餐">
						<input type="button" value="取消" onclick="location.href='index.php'">
					</th>
				</tr>
			</table>
		</form>
        
    </h1></center>
    
</body>
</html>