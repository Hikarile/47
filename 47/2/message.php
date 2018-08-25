<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.div{
		width:80%;
		height:200px;
		border-radius:20px;
		background-color:#FFF;
	}
	.d1{
		width:25%;
		height:100px;
		float:left;
		background-color:#69F;
		border:#000 solid 1px;
		border-radius:20px;
	}
	.d2{
		width:50%;
		height:100px;
		float:left;
		border:#000 solid 1px;
		border-radius:20px;
		text-align:left;
	}
	.d3{
		width:24.5%;
		height:150px;
		padding-top:50px;
		float:right;
		border:#000 solid 1px;
		border-radius:20px;
	}
	.d4{
		width:75%;
		height:48px;
		float:left;
		border:#000 solid 1px;
		border-radius:20px;
		text-align:left;
	}
	.d5{
		width:75%;
		height:48px;
		float:left;
		border:#000 solid 1px;
		border-radius:20px;
		text-align:left;
	}
	.png{
		width:80%;
		height:130px;
		background-color:#FFF;
	}
	.reply{
		width:80%;
		background-color:#396;
		text-align:left;
	}
</style>
</head>
<?php
	include("include.php");
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` DESC, `id` DESC");
	
	if($_POST['f']){
		$number=$_POST['number'];
		$da=$_POST['da'];
		$id=$_POST['id'];
		if($number == $da){
			header("location:messagefix.php?id=".$id);
			exit;
		}
	}
	if($_POST['d']){
		$number=$_POST['number'];
		$da=$_POST['da'];
		$id=$_POST['id'];
		if($number == $da){
			$time=date("Y-m-d h:i:s");
			$mysql->query("UPDATE `message` SET `dtime` = '$time' WHERE `id` = '$id'");
			header("location:message.php");
			exit;
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
        </table>
        
        <input type="button" value="新增留言" onClick="location.href='messageadd.php'"><p/>
        
        <?php
        while($a=mysqli_fetch_array($aa)){
		?>
            <div class="div">
                <div class="d1">
                	<?=$a['name']?>
                </div>
                <div class="d2">
                	<?php
                    if($a['dtime']==""){
						echo $a['text'];
					}
					?>
                </div>
                <div class="d3">
                	<?php
                    if($a['dtime']==""){
					?>
					<form method="post">
                    	輸入序號:<input type="text" name="number">
                        <input type="hidden" name="da" value="<?=$a['number']?>">
                        <input type="hidden" name="id" value="<?=$a['id']?>">
                        <input type="submit" style="width:100px; height:60px; font-size:25px;" name="f" value="修改">
                        <input type="submit" style="width:100px; height:60px; font-size:25px;" name="d" value="刪除">
                    </form>
					<?php
					}else{
						echo "已刪除";
					}
					?>
                </div>
                <div class="d4">
                	<?php
                    if($a['dtime']==""){
						if($a['ey']==1){
							echo "E_mail:".$a['email'];
						}
						if($a['py']==1){
							echo "電話:".$a['phone'];
						}
					}
					?>
                </div>
                <div class="d5">
                	<?php
                    if($a['dtime']==""){
						echo "發表於".$a['time'];
						if($a['ftime']!=""){
							echo "修改於".$a['ftime'];
						}
					}else{
						echo "發表於".$a['time'];
						echo "刪除於".$a['dtime'];
					}
					?>
                </div>
            </div>
            <div class="png">
            	<?php
                $bb=$mysql->query("SELECT * FROM `png` where `mid` = '".$a['id']."'");
				while($b=mysqli_fetch_array($bb)){
					if($a['dtime']==""){
				?>
                <img width="12%" src="file/<?=$b['png']?>">
                <?php
                	}
				}
				?>
            </div>
            <?php
            $cc=$mysql->query("SELECT * FROM `reply` where `mid` = '".$a['id']."'");
			while($c=mysqli_fetch_array($cc)){
			?>
            <div class="reply">
            	回覆:<?=$c['text']?>
            </div>
            <?php
            }
			?><p/>
        <?php
		}
		?>

    </h1></center>
    
</body>
</html>