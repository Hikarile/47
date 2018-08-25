<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.d0{
		width:80%;
		height:200px;
	}
	.d1{
		width:20%;
		height:100px;
		border-radius:20px;
		background-color:#6C9;
		border:#000 solid 1px;
		float:left;
	}
	.d2{
		width:50%;
		height:100px;
		border-radius:20px;
		border:#000 solid 1px;
		float:left;
		background-color:#FFF;
	}
	.d3{
		width:10%;
		height:100px;
		border-radius:20px;
		border:#000 solid 1px;
		float:left;
		background-color:#FFF;
	}
	.d4{
		width:19.4%;
		height:150px;
		padding-top:50px;
		border-radius:20px;
		border:#000 solid 1px;
		float:right;
		background-color:#FFF;
	}
	.d5{
		width:80.3%;
		height:48px;
		border-radius:20px;
		border:#000 solid 1px;
		float:left;
		background-color:#FFF;
	}
	.d6{
		width:80.3%;
		height:48px;
		border-radius:20px;
		border:#000 solid 1px;
		float:left;
		background-color:#FFF;
	}
	.reply{
		width:80%;
		background-color:#6C9;
		text-align:left;
	}
</style>
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` DESC,`id` DESC");
	
	if($_POST['d']){
		if($_POST['da']==$_POST['number']){
			$time=date("Y-m-d h:i:s");
			$mysql->query("UPDATE `message` SET `dtime` = '$time' WHERE `id` = '".$_POST['id']."'");
			header("location:message.php");
			exit;
		}else{
			echo"<script>alert('輸入錯誤')</script>";
		}
	}
	if($_POST['f']){
		if($_POST['da']==$_POST['number']){
			header("location:messagefix.php?id=".$_POST['id']);
			exit;
		}else{
			echo"<script>alert('輸入錯誤')</script>";
		}
	}
	
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客留言
        <table width="80%" height="60px" border="1">
        	<tr>
            	<th><input style="width:100%;height:60px;font-size:40px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%;height:60px;font-size:40px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%;height:60px;font-size:40px;" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        
        <input type="button" value="新增留言" onClick="location.href='messageadd.php'"><p/>
        
        <?php
        while($a=mysqli_fetch_array($aa)){
			$dd=$mysql->query("SELECT * FROM `png` where `mid` = '".$a['id']."'");
			$d=mysqli_fetch_array($dd);
		?>
        <div class="d0">
        	<div class="d1">
            	<?=$a['name']?>
            </div>
            <div class="d2">
            	<?php
                if($a['dtime']==''){
					echo $a['text'];
				}
				?>
            </div>
            <div class="d3">
            	<?php
                if($a['dtime']==''){
					if($d['png']!=''){
						echo '<img width="90%" src="file/'.$d['pan'].$d['png'].'">';
					}
				}
				?>
            </div>
            <div class="d4">
            	<?php
                if($a['dtime']==''){
				?>
				<form method="post">
                	<input type="text" name="number"><p/>
                    <input type="hidden" name="da" value="<?=$a['number']?>">
                    <input type="hidden" name="id" value="<?=$a['id']?>">
                    <input style="width:30%; height:60px; font-size:20px;" type="submit" name="d" value="刪除">
                    <input style="width:30%; height:60px; font-size:20px;" type="submit" name="f" value="修改">
                </form>
				<?php	
				}else{echo'已刪除';}
				?>
            </div>
            <div class="d5">
            	發表於<?=$a['time']?>
				<?php
				if($a['dtime']==''){
					if($a['ftime']!=''){
						echo '修改於'.$a['ftime'];
					}
				}else{
					echo '刪除於'.$a['dtime'];
				}
                ?>
            </div>
            <div class="d6">
            	<?php
                if($a['dtime']==''){
					if($a['ey']==1){
						echo"E_MAIL:".$a['email'];
					}
					if($a['py']){
						echo"電話:".$a['phone'];
					}
				}
				?>
            </div>
        </div>
        <?php
        $cc=$mysql->query("SELECT * FROM `reply` where `mid` = '$id'");
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