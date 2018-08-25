<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<link type="text/css" href="css.php" rel="stylesheet">
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$s=$_POST['s'];
		$e=$_POST['e'];
		$aa=$mysql->query("SELECT * FROM `eat` where `day`BETWEEN '$s' and '$d'");
	}else{
		$aa=$mysql->query("SELECT * FROM `eat`");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h3>
    	訂餐管理
    	<table border="1" width="80%" height="50px">
        	<tr>
            	<th><input type="button" value="訪客留言" onClick="location.href='message.php'" style="width:100%; height:50px; font-size:30px;"></th>
                <th><input type="button" value="訪客訂餐" onClick="location.href='index.php'" style="width:100%; height:50px; font-size:30px;"></th>
                <th><input type="button" value="網站管理" onClick="location.href='admin.php'" style="width:100%; height:50px; font-size:30px;"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input type="button" value="留言管理" onClick="location.href='ad_m.php'" style="width:100%; height:50px; font-size:30px;"></th>
                <th><input type="button" value="訂餐管理" onClick="location.href='ad_e.php'" style="width:100%; height:50px; font-size:30px;"></th>
            </tr>
        </table>
		<?php
		}
		?><p/>
        
        <form method="post">
        	<input type="date" name="s">到<input type="date" name="e"><input type="submit" name="ok" value="確定">
        </form>
        
        <table border="1" width="100%">
        	<tr bgcolor="#FF9900">
            	<th>訂餐編號</th>
                <th>訂餐日期</th>
                <th>時段</th>
                <th>訂餐數量</th>
                <th>套餐名稱</th>
                <th>桌數</th>
                <th>桌號</th>
                <th>姓名</th>
                <th>E_MAIL</th>
                <th>電話</th>
                <th>備註</th>
                <th>總金額</th>
                <th>需付訂金</th>
                <th>編輯</th>
            </tr>
            <?php
            while($a=mysqli_fetch_array($aa)){
			?>
			<tr bgcolor="#CCCCCC">
            	<th><?=$a['number']?></th>
                <th><?=$a['day']?><br/><?=$a['mon']?></th>
                <th><?=$a['tp']?></th>
                <th><?=$a['quan']?></th>
                <th><?=$a['menu']?></th>
                <th><?=$a['tab']?></th>
                <th><?=$a['tnum']?></th>
                <th><?=$a['name']?></th>
                <th><?=$a['email']?></th>
                <th><?=$a['phone']?></th>
                <th><?=$a['text']?></th>
                <th><?=$a['money']?></th>
                <th><?=$a['moneymoney']?></th>
                <th>
                	<input type="button" value="刪除" onClick="location.href='ad_ed.php?id=<?=$a['id']?>'">
                    <input type="button" value="修改" onClick="location.href='ad_ef.php?id=<?=$a['id']?>'">
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h3></center>
</body>
</html>