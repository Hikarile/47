<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.d0{
		width:80%;
		height:205px;
		border-radius:20px;
		background-color:#FFF;
	}
	.d1{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#6C9;
		float:left;
		word-wrap:break-word;
	}
	.d2{
		width:50%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
		word-wrap:break-word;
	}
	.d3{
		width:10%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
	}
	.d4{
		width:19.3%;
		height:205px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:right;
	}
	.d5{
		width:80%;
		height:50px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
	}
</style>
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` DESC , `id` DESC");
	
	if($_POST['d']){
		if($_POST['da']==$_POST['number']){
			$time=date("Y/m/d H:i:s");
			$mysql->query("UPDATE `message` SET `dtime` = '".$time."' WHERE `message`.`id` = '".$_POST['id']."'");
			header("location:message.php");
		}else{
			echo'<script>alert("輸入錯誤")</script>';
		}
	}
	if($_POST['f']){
		if($_POST['da']==$_POST['number']){
			header("location:messagefix.php?id=".$_POST['id']);
		}else{
			echo'<script>alert("輸入錯誤")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客留言
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
		?><p/>
        <input type="button" value="新增留言" onClick="location.href='messageadd.php'">
        
        <?php
        while($a=mysqli_fetch_array($aa)){
		$o="";
		$bb=$mysql->query("SELECT * FROM `png` where `mid` = '".$a['id']."'");
		while($b=mysqli_fetch_array($bb)){
			$o[]=$b['id'];
		}shuffle($o);
		
		$cc=$mysql->query("SELECT * FROM `reply` where `mid` = '".$a['id']."'");
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
				$pp=$mysql->query("SELECT * FROM `png` where `id` = '".$o[0]."'");
				$p=mysqli_fetch_array($pp);
                if($a['dtime']==''){
					if($p['png']!=''){
						echo'<img height="90px" src="file/'.$p['png'].'">';
					}
				}
				?>
            </div>
            <div class="d4">
            	<?php
                if($a['dtime']==''){
				if($a['up']==1){
					echo'置頂留言';
				}
				?>
				<form method="post">
                	<input type="hidden" name="id" value="<?=$a['id']?>">
                    <input type="hidden" name="number" value="<?=$a['number']?>">
                    輸入留言序號:<br/>
                    <input type="text" name="da"><br/>
                    <input type="submit" name="f" value="修改">
                    <input type="submit" name="d" value="刪除">
                </form>
				<?php
				}else{echo'已刪除';}
				?>
            </div>
            <div class="d5">
            	<?php
                if($a['dtime']==''){
					echo'發表於'.$a['time'];
					if($a['ftime']!=''){
						echo'修改於'.$a['ftime'];
					}
				}else{
					echo'發表於'.$a['time'];
					echo'刪除於'.$a['dtime'];
				}
				?>
            </div>
            <div class="d5">
            	<?php
                if($a['dtime']==''){
					if($a['ey']==1){
						echo'E_MAIL:'.$a['email'];
					}
					echo'&nbsp;&nbsp;&nbsp;';
					if($a['py']==1){
						echo'電話:'.$a['phone'];
					}
				}
				?>
            </div>
        </div>
        <?php
        if($a['dtime']==''){
		while($c=mysqli_fetch_array($cc)){
		?>
		<div style="width:80%; height:50px; font-size:30px; background-color:#6C9; text-align:left;">
        	管理者回覆:<?=$c['reply']?>
        </div>
		<?php	
		}	
		}
		?>
        <p/>
		<?php
		}
		?>
        
    </h1></center>
</body>
</html>