<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<link type="text/css" href="css.php" rel="stylesheet">
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '".$_GET['id']."'");
	$a=mysqli_fetch_array($aa);
?>
<body bgcolor="#6699FF">
	<center><h1>
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
		?>
        <p>&nbsp;</p>
        
        您的訂餐編號為<?=$a['number']?>
        
    </h1></center>
</body>
</html>