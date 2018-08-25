
<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names utf8`");
	
	if($_SESSION['dnlu'] != ""){
		unset($_SESSION['dnlu']);
	}
	
	if($_POST['ok']){
		$ac=$_POST['ac'];
		$ps=$_POST['ps'];
		if($ac!=""){
			if($ps!=""){
				$aa=$mysql->query("SELECT * FROM `one` where `ac` = '$ac' and `ps` = '$ps'");
				if(mysqli_fetch_array($aa)){
					$_SESSION['dnlu']="tt";
					header("location:mess-manage.php");
				}
			}else{
				echo "<script>alert('未填寫完成')</script>";
			}
		}else{
			echo "<script>alert('未填寫完成')</script>";
		}
	}
	
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	#button{
		width:100%;
		height:50px;
		font-size:35px;
		background-color:#39F;
	}
	#ta{
		background-color:#FFF;
		width:350px;
		height:150px;
		padding-top:50px;
	}
</style>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	網站管理<p/>
        <table border="1" width="90%">
        	<tr height="50px">
            	<th><input  id="button" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input  id="button" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input  id="button" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table><p/>
        
        <div id="ta">
			<form method="post">
                帳號:<input type="text" name="ac"><br/>
                密碼:<input type="password" name="ps"><br/>
                <input type="submit" name="ok" value="確定">
            </form>

        </div>
        
    </h1></center>
    
</body>
</html>