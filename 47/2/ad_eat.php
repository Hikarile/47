<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("include.php");
	if($_SESSION['dnlu']==""){
		header("location:admin.php");
	}
?>
<body bgcolor="#6699FF">
	
    <center><h2>
    	訂餐管理<br/>
        <input type="button" value="登出" onClick="location.href='out.php'">
        <input type="button" value="留言管理" onClick="location.href='ad_mess.php'">
        <input type="button" value="訂餐管理" onClick="location.href='ad_eat.php'"><p/>
        
        <table width="100%" border="">
        	<tr bgcolor="#CCCCCC">
            	<th>訂餐編號</th>
                <th>用餐日期</th>
                <th>用餐時段</th>
                <th>套餐種類</th>
                <th>套餐數量</th>
                <th>桌數</th>
                <th>桌號</th>
                <th>姓名</th>
                <th>電話</th>
                <th>E_MAIL</th>
                <th>備註</th>
                <th>總金額</th>
                <th>需付訂金</th>
                <th>編輯</th>
            </tr>
            <?php
            $aa=$mysql->query("SELECT * FROM `eat`");
			while($a=mysqli_fetch_array($aa)){
			?>
            <tr bgcolor="#66CCFF">
            	<th><?=$a['number']?></th>
                <th><?=$a['day']?></th>
                <th><?=$a['tp']?></th>
                <th><?=$a['menu']?></th>
                <th><?=$a['quan']?></th>
                <th><?=$a['tab']?></th>
                <th><?=$a['tnum']?></th>
                <th><?=$a['name']?></th>
                <th><?=$a['phone']?></th>
                <th><?=$a['email']?></th>
                <th><?=$a['text']?></th>
                <th><?=$a['money']?></th>
                <th><?=$a['moneymoney']?></th>
                <th>
                	<input type="button" value="刪除" onClick="location.href='ed.php?id=<?=$a['id']?>'">
                    <input type="button" value="修改" onClick="location.href=''">
                </th>
            </tr>
            <?php
			}
			?>
        </table>
        
    </h2></center>
    
</body>
</html>