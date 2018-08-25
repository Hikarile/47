<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("include.php");
	
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		if($ac=="admin" && $ps=='1234'){
			$_SESSION['dnlu']='tt';
			header("location:ad_mess.php");
			exit;
		}else{
			echo"<script>alert('登入失敗')</script>";
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
        <table border="1" width="80%" height="70px">
            <tr>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="管理頁面" onClick="location.href='admin.php'"></th>
            </tr>
        </table><p/>
        
        <form method="post">
            <table>
                <tr>
                    <th>帳號:</th>
                    <th><input type="text" name="ac"></th>
                </tr>
                <tr>
                    <th>密碼:</th>
                    <th><input type="text" name="ps"></th>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" name="ok" value="確定">
                    </th>
                </tr>
            </table>
        </form>
	</h1></center>
</body>
</html>