<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	if($_POST['ok']){
		if($_POST['reply']){
			$mysql->query("INSERT INTO `reply` (`mid`, `reply`) VALUES ('".$_GET['id']."', '".$_POST['reply']."')");
			header("location:ad_m.php");
		}else{
			echo'<script>alert("未填寫")</script>';
		}
	}
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
		?><p/>
        
        留言回覆:<p/>
        <form method="post">
        	<textarea name="reply" style="width:300px; height:150px;"></textarea><br/>
            <input type="submit" name="ok" value="確定">
        </form>
        
    </h1></center>
</body>
</html>