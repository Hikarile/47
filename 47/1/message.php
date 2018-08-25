
<?php
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	
	if($_POST['fix']){
		$number=$_POST['number'];
		$da=$_POST['da'];
		$id=$_POST['id'];
		if($number == $da){
			header("location:messfix.php?id=".$id);
		}else{
			echo "<script>alert('序號輸入錯誤')</script>";
		}
	}
	if($_POST['d']){
		$number=$_POST['number'];
		$da=$_POST['da'];
		$id=$_POST['id'];
		if($number == $da){
			$dday=date("Y/m/d H:i:s");
			$mysql->query("UPDATE `message` SET `dday` = '$dday' WHERE `id` = '$id'");
			header("location:message.php");
		}else{
			echo "<script>alert('序號輸入錯誤')</script>";
		}
	}
	
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` DESC, `id` DESC");
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
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客留言<p/>
        <table border="1" width="90%">
        	<tr height="50px">
            	<th><input id="button" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input id="button" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input id="button" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        
        <input type="button" value="新增留言" onClick="location.href='messadd.php'"><p/>
        
        <?php
        while($a=mysqli_fetch_array($aa)){
		?>
        <div id="div">
        	
            <div class="b1">
            	<?=$a['name']?>
            </div>
            <div class="b5">
            	<?php
                if($a['dday']!=""){
					echo "已刪除";
				}else{
				?>
                &nbsp;</br>
                <form method="post">
                	留言序號:<input type="text" name="number"><br/>
                    <input type="hidden" name="da" value="<?=$a['number']?>">
                    <input type="hidden" name="id" value="<?=$a['id']?>">
                    <input style="width:80px; height:50px; font-size:25px;" type="submit" name="fix" value="編輯">
                    <input style="width:80px; height:50px; font-size:25px;" type="submit" name="d" value="刪除">
                </form>
                <?php
				}
				?>
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
        </div>
        
        <?php
        $bb=$mysql->query("SELECT * FROM `mrepoly` where `mid` = '".$a['id']."'");
		while($b=mysqli_fetch_array($bb)){
		?>
        <div style="width:80%; height:80px; border:#000 solid 1px; background-color:#0CC;">
           回復:<?=$b['text']?>
        </div>
        <?php
		}
		?>
        
        <p>&nbsp;</p>
        <?php
		}
		?>
        
    </h1></center>
    
</body>
</html>