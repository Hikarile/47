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
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        <p/>
        
        <table border="" width="80%">
        	<tr bgcolor="#3366FF">
            	<th>訂餐編號</th>
                <th>日期</th>
                <th>時段</th>
                <th>訂餐數量</th>
                <th>套餐名稱</th>
                <th>訂餐桌數</th>
                <th>桌號</th>
            </tr>
            <tr bgcolor="#3366FF">
            	<th>總金額</th>
                <th>訂金</th>
            	<th>姓名</th>
                <th>電話</th>
                <th>E_MAIL</th>
                <th>備註</th>
                <th>編輯</th>
            </tr>
            <?php
            while($a=mysqli_fetch_array($aa)){
			?>	
            <tr bgcolor="#CCCCCC">
            	<th><?=$a['number']?></th>
                <th><?=$a['day'].' '.$a['mon']?></th>
                <th><?=$a['tp']?></th>
                <th><?=$a['quan']?></th>
                <th><?=$a['menu']?></th>
                <th><?=$a['tab']?></th>
                <th><?=$a['tnum']?></th>
            </tr>
            <tr bgcolor="#CCCCCC">
            	<th><?=$a['money']?></th>
                <th><?=$a['moneymoney']?></th>
                <th><?=$a['name']?></th>
                <th><?=$a['phone']?></th>
                <th><?=$a['email']?></th>
                <th><?=$a['text']?></th>
                <th>
                	<input type="button" value="編輯" onClick="location.href='ad_efix.php?id=<?=$a['id']?>'">
                    <input type="button" value="刪除" onClick="location.href='ad_ed.php?id=<?=$a['id']?>'">
                </th>
            </tr>
            <tr>
            	<th  bgcolor="#000000" colspan="7" height="8px"></th>
            </tr>
			<?php
			}
			?>
        </table>
        
        
    </h1></center>
</body>
</html>