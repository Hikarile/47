<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	if($_POST['ok']){
		if($_POST['ac']=='admin' && $_POST['ps']=='1234'){
			$_SESSION['dnlu']='tt';
			header("location:admin.php");
		}else{
			echo'<script>alert("登入失敗")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	網站管理
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
        <?php
        if($_SESSION['dnlu']==''){
		?>
        <form method="post">
        	帳號:<input type="text" name="ac"><br/>
            密碼:<input type="text" name="ps"><br/>
            <input type="submit"  name="ok" value="確定">
        </form>
        <?php
		}else{
			echo '<input type="button" value="登出" onClick="location.href=\'out.php\'">';
		}
		?>
    </h1></center>
</body>
</html>