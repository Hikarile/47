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
		background-color:#6C9;
		height:100px;
		border: #000 solid 1px;
		float:left;
		border-radius:20px;
	}
	.d2{
		width:50%;
		background-color:#FFF;
		height:100px;
		border: #000 solid 1px;
		float:left;
		border-radius:20px;
	}
	.d3{
		width:10%;
		background-color:#FFF;
		height:100px;
		border: #000 solid 1px;
		float:left;
		border-radius:20px;
	}
	.d4{
		width:19.3%;
		background-color:#FFF;
		height:205px;
		border: #000 solid 1px;
		float:right;
		border-radius:20px;
	}
	.d5{
		width:80%;
		background-color:#FFF;
		height:50px;
		border: #000 solid 1px;
		float:left;
		border-radius:20px;
	}
	.d6{
		width:80%;
		background-color:#FFF;
		height:50px;
		border: #000 solid 1px;
		float:left;
		border-radius:20px;
	}
</style>
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `message` ORDER by `up` DESC,`id` DESC");
	
	if($_POST['d']){
		if($_POST['da']==$_POST['number']){
			$time=date("Y/m/d h:i:s");
			$mysql->query("UPDATE `message` SET `dtime` = '$time' WHERE `id` = '".$_POST['id']."'");
			header("location:message.php");
		}
	}
	if($_POST['f']){
		if($_POST['da']==$_POST['number']){
			header("location:messagefix.php?id=".$_POST['id']);
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客留言
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px;" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px;" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        <input type="button" value="新增留言" onClick="location.href='messageadd.php'"><p/>
        
        <?php
        	while($a=mysqli_fetch_array($aa)){
				$bb=$mysql->query("SELECT * FROM `png` where `mid` = '".$a['id']."'");
				$b=mysqli_fetch_array($bb);
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
                if($a['dtime']==''){
					if($b['png']!=''){
						echo'<img width="90%" src="file/'.$b['png'].'">';
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
                    <input type="hidden" name="da" value="<?=$a['number']?>">
                   	輸入留言序號:<br/>
                    <input type="text" name="number"><br/>
                    <input type="submit" name="f"  value="修改">
                    <input type="submit" name="d"  value="刪除">
                </form>
				<?php
				}else{
					echo'已刪除';
				}
				?>
            </div>
            <div class="d5">
            	<?php
                if($a['dtime']==''){
					echo '發表於'.$a['time'];
					if($a['ftime']){
						echo '修改於'.$a['ftime'];
					}
				}else{
					echo '發表於'.$a['time'];
					echo '刪除於'.$a['dtime'];
				}
				?>
            </div>
            <div class="d6">
            	<?php
                if($a['dtime']==''){
					if($a['ey']==1){
						echo 'E_MAIL:'.$a['email'];
					}
					if($a['py']==1){
						echo '電話:'.$a['phone'];
					}
				}
				?>
            </div>
        </div>
        <?php
        while($c=mysqli_fetch_array($cc)){
		?>
		<div style="width:80%; height:50px; background-color:#6C9; font-size:30px; text-align:left;">
        	管理者回覆:<?=$c['reply']?>
        </div>
		<?php
		}
		?>
        <p/>
		<?php }?>
        
    </h1></center>
</body>
</html>