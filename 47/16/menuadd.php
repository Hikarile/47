<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		$menu=$_POST['menu'];
		$money=$_POST['money'];
		if($menu==''||$money==''){
			echo'<script>alert("未填寫")</script>';
		}else{
			$mysql->query("INSERT INTO `menu` (`menu`, `money`) VALUES ('$menu', '$money')");
			header("location:menu.php");
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
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
		?><p/>新增套餐</p>
        
        <form method="post">
        	<table width="30%">
           		<tr>
                	<th bgcolor="#CCCCCC">套餐名稱</th>
                    <td><input type="text" name="menu"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC">價錢</th>
                    <td><input type="number" name="money"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                    </th>
                </tr>
            </table>
        </form>
        
    </center></h1>
</body>
</html>