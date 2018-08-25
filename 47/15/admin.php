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
		if($_POST['ac']=='admin'&&$_POST['ps']=='1234'){
			$_SESSION['dnlu']='t';
		}else{
			echo'<script>alert("登入失敗")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	網站管理
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
        
        <?php
        if($_SESSION['dnlu']==''){
		?>
        <form method="post">
        	帳號:<input type="text" name="ac"><br/>
            密碼:<input type="password" name="ps"><br/>
            <input type="submit" name="ok" value="確定">
        </form>
        <?php
		}else{
		?><input type="button" value="登出" onClick="location.href='out.php'"><?php	
		}
		?>
    </h1></center>
</body>
</html>