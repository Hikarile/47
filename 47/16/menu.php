<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	$mm=$mysql->query("SELECT * FROM `menu`");
	
	if($_POST['d']){
		$id=$_POST['id'];
		$mysql->query("DELETE FROM `menu` WHERE `menu`.`id` = '$id'");
		header("location:menu.php");
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	套餐管理
        <table border="1" width="80%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='f.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="套餐管理" onClick="location.href='menu.php'"></th>
            </tr>
        </table>
		<?php
		}
		?><p/><input type="button" value="新增套餐" onClick="location.href='menuadd.php'">
        
        <table border="1" width="35%">
            <tr bgcolor="#999999">
                <th>套餐名稱</th>
                <th>價錢</th>
                <th>編輯</th>
            </tr>
            <?php
            while($m=mysqli_fetch_array($mm)){
            ?>
            <tr bgcolor="#FFFFFF">
                <th><?=$m['menu']?></th>
                <th><?=$m['money']?></th>
                <th>
            <form method="post">
                <input type="hidden" name="id" value="<?=$m['id']?>">
                <input type="button" value="修改" onClick="location.href='menufix.php?id=<?=$m['id']?>'">
                <input type="submit" name="d" value="刪除">
            </form>
                </th>
            </tr>
            <?php
            }
            ?>
        </table>
        
    </center></h1>
</body>
</html>