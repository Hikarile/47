<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.d1{
		width:20%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#6C9;
		float:left;
	}
	.d2{
		width:50%;
		height:100px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
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
		height:180px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:right;
		padding-top:20px;
	}
	.d5{
		width:80%;
		height:50px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
	}
	.d6{
		width:80%;
		height:50px;
		border:#000 solid 1px;
		border-radius:20px;
		background-color:#FFF;
		float:left;
	}
	.bot{
		width:30%;
		height:60px;
		font-size:25px;
	}
</style>
</head>
<?php
	include("cd.php");
	$aa=$mysql->query("SELECT * FROM `message` ORDER BY `up` ASC , `id` DESC");
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	留言管理
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="網頁管理" onClick="location.href='admin.php'"></th>
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
        
        <?php
        while($a=mysqli_fetch_array($aa)){
			$bb=$mysql->query("SELECT * FROM `png` where `mid` = '".$a['id']."'");
			$b=mysqli_fetch_array($bb);
			$cc=$mysql->query("SELECT * FROM `reply` where `mid` = '".$a['id']."'");
			$c=mysqli_fetch_array($cc);
		?>
        <div style="width:80%; height:200px; background-color:#FFF; border-radius:20px;">
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
				<form method="post">
                	<input type="hidden" name="id" value="<?=$a['id']?>">
               		<input class="bot" type="submit" name="up" value="置頂">
                	<input class="bot" type="button" name="reply" value="回覆" onClick="location.href='ad_mreply.php?id=<?=$a['id']?>'"><p/>
                    <input class="bot" type="button" name="f" value="修改" onClick="location.href='ad_mfix.php?id=<?=$a['id']?>'">
                    <input class="bot" type="submit" name="d" value="刪除">
                </form>
            </div>
            <div class="d5">
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
            <div class="d6">
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
        </div><p/>
        <?php
		}
		?>
        
    </h1></center>
</body>
</html>