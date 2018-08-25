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
		}else{
			echo '<script>alert("登入失敗")</script>';
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	網頁管理
    	<table width="80%" height="60px" border="1">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px" type="button" value="網頁管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="background-color:#6C9; width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="background-color:#6C9; width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        <p/>
        
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<input style="width:200px; height:130px; font-size:50px;" type="button" value="登出" onClick="location.href='out.php'">
		<?php	
		}else{
		?>
		<form method="post">
        	帳號:<input type="text" name="ac"><br/>
            密碼:<input type="text" name="ps"><br/>
            <input type="submit" name="ok" value="確定">
        </form>
		<?php	
		}
		?>
        
    </h1></center>
</body>
</html>