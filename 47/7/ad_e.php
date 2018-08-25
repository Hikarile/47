<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `eat`");
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訂餐管理
    	<table width="80%" height="60px" border="1">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="網頁管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="background-color:#6C9; width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="background-color:#6C9; width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table><p/>
        
        <form method="post">
        	<input type="date" name="s">到
            <input type="date" name="e">
            <input type="submit" name="ok" value="確定"><p/>
        </form>
        
        <table border="1" width="125%">
        	<tr bgcolor="#3366FF">
            	<th>訂餐編號</th>
                <th>日期</th>
                <th>時段</th>
                <th>訂餐數輛</th>
                <th>套餐種類</th>
                <th>訂餐桌數</th>
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
			while($a=mysqli_fetch_array($aa)){
			?>
			<tr bgcolor="#999999">	
            	<th><?=$a['number']?></th>	
                <th><?=$a['day'].$a['mon']?></th>
                <th><?=$a['tp']?></th>
                <th><?=$a['quan']?></th>
                <th><?=$a['menu']?></th>
                <th><?=$a['tab']?></th>
                <th><?=$a['tnum']?></th>
                <th><?=$a['name']?></th>
                <th><?=$a['phone']?></th>
                <th><?=$a['email']?></th>
                <th><?=$a['text']?></th>
                <th><?=$a['money']?></th>
                <th><?=$a['moneymoney']?></th>
                <th>
                	<input type="button" value="刪除" onClick="location.href='ad_ed.php?id=<?=$a['id']?>'">
                    <input type="button" value="編輯" onClick="location.href=''">
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
        
	</h1></center>
</body>
</html>