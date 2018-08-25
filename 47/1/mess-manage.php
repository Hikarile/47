
<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	if($_POST['up']){
		$id=$_POST['id'];
		$bb=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
		$b=mysqli_fetch_array($bb);
		if($b['up'] == ""){
			$mysql->query("UPDATE `message` SET `up` = '1' WHERE `id` = '$id'");
			header("location:mess-manage.php");
		}else{
			$up=$b['up']+1;
			$mysql->query("UPDATE `message` SET `up` = '$up' WHERE `id` = '$id'");
			header("location:mess-manage.php");
		}
	}	
	
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `id` DESC");
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
	#div{
		width:80%;
		height:150px;
		border:#000 solid 1px;
		background-color:#FFF;
	}
	.b1{
		width:25%;
		height:75px;
		border:#000 solid 1px;
		background-color:#6CF;
		border-radius:30px;
		float:left;
		font-size:50px;
	}
	.b2{
		width:35%;
		height:75px;
		border:#000 solid 1px;
		border-radius:30px;
		font-size:40px;
		float:left;
	}
	.b3{
		width:60%;
		height:35px;
		border:#000 solid 1px;
		border-radius:10px;
		float:left;
		text-align:left;
	}
	.b4{
		width:60%;
		height:35px;
		border:#000 solid 1px;
		border-radius:10px;
		float:left;
		text-align:left;
	}
	.b5{
		width:25%;
		height:150px;
		border:#000 solid 1px;
		border-radius:30px;
		float:right;
	}
	.b6{
		width:14%;
		height:145px;
		border:#000 solid 1px;
		border-radius:30px;
		float:right;
	}
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	function d(id){
		if(confirm("確定要刪除")){
			location.href='md.php?id='+id;
		}else{
			alert("取消成功");
		}
	}
</script>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
        
        <input type="button" value="留言管理" onClick="location.href='mess-manage.php'">
        <input type="button" value="訂餐管理" onClick="location.href='eat-manage.php'">
        <input type="button" value="登出" onClick="location.href='admin.php'"><p/>
        留言管理<p/>
        
         <?php
        while($a=mysqli_fetch_array($aa)){
		?>
        <div id="div">
            <div class="b1">
            	<?=$a['name']?>
            </div>
            <div class="b5">
            	<br/>
				<input style="width:80px; height:50px; font-size:25px;" type="button" name="fix" value="編輯" onClick="location.href='mf.php?id=<?=$a['id']?>'">
				<input style="width:80px; height:50px; font-size:25px;" type="button" name="d" value="刪除" onClick="d(<?=$a['id']?>)">
                <input style="width:80px; height:50px; font-size:25px;" type="button" name="repoly" value="回覆" onClick="location.href='mrepoly.php?id=<?=$a['id']?>'">
                <form method="post">
                	<input type="hidden" name="id" value="<?=$a['id']?>">
                	<input type="submit" name="up" value="至頂">
                </form>
            </div>
            <div class="b2">
            	<?php
                if($a['dday'] != ""){
					echo "";
				}else{
					echo $a['text'];
				}
				?>
            </div>
            <div class="b6">
            	<?php
                if($a['dday'] != ""){
					echo "";
				}else{
					if($a['png'] ==""){
						echo "";
					}else{
						echo "<img width='150px' height='100px' src='file/".$a['png']."'>";
					}
				}
				?>
            </div>
            <div class="b3">
            	發表於:<?=$a['day']?>
                <?php
				if($a['dday'] != ""){
					echo "&nbsp;&nbsp;&nbsp;刪除於:".$a['dday'];
				}else{
					if($a['fixday']!=""){
						echo "&nbsp;&nbsp;&nbsp;修改於:".$a['fixday'];
					}
				}
				?>
            </div>
            <div class="b4">
            	<?php
				if($a['dday'] != ""){
					echo "";
				}else{
					if($a['ey'] == 1){
					?>
					E-mail:<?=$a['emall']?>
					<?php
					}
					if($a['py'] == 1){
					?>
					電話:<?=$a['phone']?>
					<?php
					}
				}
				?>
            </div>
        </div><p/>
        <?php
		}
		?>
    </h1></center>
    
</body>
</html>