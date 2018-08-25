<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$id=$_GET['id'];
	$da=date("Ymd");
	$aa=$mysql->query("SELECT COUNT(id) as `dd` FROM `eat` where `new`= '$da'");
	$a=mysqli_fetch_array($aa);
	$sa=str_pad($a['dd'],4,'0',STR_PAD_LEFT);
	$number=$da.$sa;
	$mysql->query("UPDATE `eat` SET `number` = '$number' WHERE `eat`.`id` = '$id'");
?>
<body bgcolor="#6699FF">
	<center><h1>
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px;" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px;" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        <p/>
        您的訂餐編號為<?=$number?>
        
    </h1></center>
</body>
</html>