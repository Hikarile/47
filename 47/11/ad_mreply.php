<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	$id=$_GET['id'];
	
	if($_POST['ok']){
		if($_POST['reply']!=''){
			$mysql->query("INSERT INTO `reply` (`mid`, `reply`) VALUES ('$id', '".$_POST['reply']."');");
			header("location:ad_m.php");
		}else{
			echo'<script>alert("未填寫完成")</script>';
		}
	}
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
        回覆留言<input type="button" value="返回" onClick="location.href='ad_m.php'"><p/>
        
        <form method="post">
        	<textarea name="reply" style="width:200px; height:130px;"></textarea><br/>
            <input type="submit" name="ok" value="送出">
        </form>
        
    </h1></center>
</body>
</html>