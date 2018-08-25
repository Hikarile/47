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
	if($_SESSION['dnlu']==""){	
		header("location:admin.php");
	}
	
	if($_POST['d']){
		$id=$_POST['id'];
		$mysql->query("DELETE FROM `message` WHERE `id` = '$id'");
		$mysql->query("DELETE FROM `png` WHERE `mid` = '$id'");
		$mysql->query("DELETE FROM `reply` WHERE `mid` = '$id'");
	}
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` DESC, `id` DESC");
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	留言管理<br/>
        <input type="button" value="登出" onClick="location.href='out.php'">
        <input type="button" value="留言管理" onClick="location.href='ad_mess.php'">
        <input type="button" value="訂餐管理" onClick="location.href='ad_eat.php'"><p/>
        
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
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$a['id']?>">
                        <input style="width:30%; height:80px; font-size:30px;" type="submit" name="d" value="刪除">
                        <input style="width:30%; height:80px; font-size:30px;" type="button" value="修改" onClick="location.href='amf.php?id=<?=$a['id']?>'">
                        <input style="width:30%; height:80px; font-size:30px;" type="button" value="回覆" onClick="location.href='reply.php?id=<?=$a['id']?>'">
                    </form>
                    
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