<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<?php
	include('cd.php');
	if($_SESSION['dnlu']!='true'){
		header('location:admin.php');
	}
	unset($_SESSION['amount']);
	
	if($_POST['fix']){//??
		header('location:fix_text.php?id='.$_POST['id']);
	}
	if($_POST['delete']){//??
		$mysql->query("DELETE FROM `text` WHERE `id` = ".$_POST['id']);
		$mysql->query("DELETE FROM `qa` WHERE `text_id` = ".$_POST['id']);
		$mysql->query("DELETE FROM `name` WHERE `text_id` = ".$_POST['id']);
		header('location:menu.php');
	}
	if($_POST['see']){//??
		header('location:see.php?id='.$_POST['id']);
	}
	
	
	if($_POST['count']){//??
		$id=$_POST['id'];
		header('location:count.php?id='.$id);
	}
	if($_POST['copy']){//??
		$id=$_POST['id'];
		header('location:copy.php?id='.$id);
	}
	
	
	if($_POST['login']){//????
		$id=$_POST['id'];
		$mysql->query("UPDATE `text` SET `test` = '".$_POST['login']."' WHERE `id` = '".$id."'");
		header('location:menu.php');
		
	}
	if($_POST['start']){//????
		$id=$_POST['id'];
		
		$ms=explode(' ', microtime("now"));
		$time=$ms[1]+$ms[0];
		
		$mysql->query("UPDATE `text` SET `test` = '".$_POST['start']."',`status` = 'ËÄÉË©¶‰∏≠',`time` = '".$time."' WHERE `id` = '".$id."'");
		
		$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
		$text=mysqli_fetch_array($t);
		
		$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '".$id."'");
		$time1=$time;
		$time2=$time;
		$i=0;
		while($qa=mysqli_fetch_array($q)){
			$i++;
			$time1=$time1+$text['time1']*$i+$text['time2']*($i-1);
			$time2=$time2+$text['time1']*$i+$text['time2']*$i;
			$mysql->query("UPDATE `qa` SET `time1` = '".$time1."', `time2` = '".$time2."' WHERE `id` = '".$qa['id']."'");
			$time1=$time;
			$time2=$time;
		}
		
		$_SESSION['start']='ok';
		header('location:menu.php');
	}
?>
<style>
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	.add{
		border:#FC6 solid 3px;
		background-color:#F90;
		font-size:20px;
		width:150px;
		height:50px;	
	}
	.add:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	form input[type=submit]{
		width:100px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	form input[type=submit]:hover{
		background-color:#6CF;
	}
	
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	????êÜ<p/>
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="??" onClick="location.href='out.php'">
        </div>
        
        <input class="add" type="button" value="????" onClick="location.href='add_test.php'"><p/>
        
        <table width="90%" border="1">
        	<tr bgcolor="#3366FF">
            	<th>??</th>
                <th>??</th>
                <th>??</th>
                <th>??</th>
            	<th>??</th>
            </tr>
            <?php
			$aa=$mysql->query('SELECT * FROM `text`');
            while($a=mysqli_fetch_array($aa)){	
			?>
			<tr bgcolor="#66CCCC" height="70px">
            	<th><?=$a['text_number']?></th>
                <th><?=$a['status']?></th>
                <th>
					<form method="post">
                    	<input type="hidden" name="id" value="<?=$a['id']?>">
						<?php if($a['status'] != '????'){ ?>
                            <input type="submit" name="fix" value="??">
                            <input type="submit" name="delete" value="??">
                        <?php } ?>
                        <input type="submit" name="see" value="??">
                    </form>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$a['id']?>">
                        <input type="submit" name="count" value="??" <?php if($a['status']!='????'){echo 'disabled';}?>>
                        <input type="submit" name="copy" value="??">
                    </form>
                </th>
                <th width="15%">
                	<?php if($a['status'] != '???'){ ?>
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$a['id']?>">
                        <?php
                        if($a['test']==''){
						?><input type="submit" name="login" value="????"><?php
						}else if($a['test']=='????'){
						?><input type="submit" name="start" value="????"><?php
						}
						?>
                    </form>
                     <?php }else{echo'???';} ?>
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>