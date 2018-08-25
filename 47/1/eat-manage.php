<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	if($_POST['ok']){
		$sd=$_POST['sd'];
		$ed=$_POST['ed'];
		$aa=$mysql->query("SELECT * FROM `eat` where `day` BETWEEN '$sd' and '$ed'");
	}else{
		$aa=$mysql->query("SELECT * FROM `eat`");
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
        
        <input type="button" value="留言管理" onClick="location.href='mess-manage.php'">
        <input type="button" value="訂餐管理" onClick="location.href='eat-manage.php'">
        <input type="button" value="登出" onClick="location.href='admin.php'"><p/>
        訂餐管理<p/>
        
        <form method="post">
            <input type="date" name="sd">
            <input type="date" name="ed">
            <input type="submit" name="ok" value="確定">
        </form>
        
    </h1></center>
    
    <h2> 
        <table border="2" width="100%">
        	<tr bgcolor="#CCCCCC">
            	<th>訂餐編號</th>
                <th>用餐日期</th>
                <th>用餐時段</th>
                <th>桌數</th>
                <th>桌號</th>
                <th>姓名</th>
                <th>電話</th>
                <th>E_MAIL</th>
                <th>備註</th>
                <th>總金額</th>
                <th>訂金</th>
                <th>編輯</th>
            </tr>
			<?php
            while($a=mysqli_fetch_array($aa)){
            ?>
            <tr height="50px" bgcolor="#FFFFFF">
            	<th><?=$a['number']?></th>
                <th><?=$a['day']?></th>
                <th><?=$a['tp']?></th>
                <th><?=$a['tab']?></th>
                <th><?=$a['tnum']?></th>
                <th><?=$a['name']?></th>
                <th><?=$a['phone']?></th>
                <th><?=$a['email']?></th>
                <th><?=$a['text']?></th>
                <th><?=$a['money']?></th>
                <th><?=$a['moneymoney']?></th>
                <th>
                	<input type="button" value="編輯" onClick="location.href='ef.php?id=<?=$a['id']?>'">
                    <input type="button" value="刪除" onClick="location.href='ed.php?id=<?=$a['id']?>'">
                </th>
            </tr>
            <?php
            }
            ?>
        </table>
	</h2> 
    
</body>
</html>