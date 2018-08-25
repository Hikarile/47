<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['fix']){
		$id=$_POST['id'];
		header("location:fixtext.php?id=".$id);
	}
	if($_POST['d']){
		$id=$_POST['id'];
		$mysql->query("DELETE FROM `text` WHERE `id` = '$id'");
		$mysql->query("DELETE FROM `qa` WHERE `textid` = '$id'");
		$mysql->query("DELETE FROM `name` WHERE `textid` = '$id'");
		$mysql->query("DELETE FROM `count` WHERE `textid` = '$id'");
		header("location:menu.php");
	}
	if($_POST['copy']){
		$id=$_POST['id'];
		header("location:copy.php?id=".$id);
	}
	
	if($_POST['see']){
		$id=$_POST['id'];
		header("location:see.php?id=".$id);
	}
	if($_POST['count']){
		$id=$_POST['id'];
		header("location:count.php?id=".$id);
	}
	
	if($_POST['b1']){
		$id=$_POST['id'];
		$mysql->query("UPDATE `text` SET `text` = '啟動登入' WHERE `id` = '$id'");
		header("location:menu.php");
	}
	if($_POST['b2']){
		$id=$_POST['id'];
		$ms=explode(' ',microtime("now"));
		$time=$ms[1]+$ms[0];
		
		$i=0;
		$time1='';
		$time2='';
		$q=$mysql->query("SELECT * FROM `qa` where `textid` = '$id'");
		while($qa=mysqli_fetch_array($q)){
			$i++;
			$time1=$time+$qa['t1']*$i+$qa['t2']*($i-1);
			$time2=$time+$qa['t1']*$i+$qa['t2']*$i;
			$mysql->query("UPDATE `qa` SET `time1` = '$time1', `time2` = '$time2' WHERE `id` = '".$qa['id']."'");
			$time1='';
			$time2='';
		}
		
		$mysql->query("UPDATE `text` SET `status` = '考試中', `text` = '".$_POST['b2']."',`time` = '$time' WHERE `id` = '$id'");
		header("location:menu.php");
	}
	
?>
<style>
	.box1{
		width:400px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
		margin:20px;
	}
	.sub{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.sub:hover{
		background-color:#36F;
	}
	.out{
		width:150px;
		height:60px;
		border:#F63 solid 3px;
		background-color:#FF9;
		font-size:23px;
	}
	.out:hover{
		background-color:#F90;
	}
	.btn{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.btn:hover{
		background-color:#39F;
	}
	.text{
		width:150px;
		height:30px;
		font-size:23px;
	}
</style>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<input type="button" value="登出" onClick="location.href='out.php'" class="out">
    <center><h1>
    	
        試卷管理<p/>
        
        <input type="button" value="新增試卷" onClick="location.href='addtext.php'" class="btn">
        <?php
        if($_SESSION['type'] == '管理者'){
		?>
		<input type="button" value="管理管理者" onClick="location.href='teacher.php'" class="btn">
		<?php
		}
        ?>
        
        <table width="90%" border="1">
        	<tr bgcolor="#6699FF">
            	<th>試卷編號</th>
                <th>狀態</th>
                <th>編輯</th>
                <th>檢視</th>
                <th>考試</th>
            </tr>
            <?php
            $t=$mysql->query("SELECT * FROM `text` where `teacherid` = '".$_SESSION['id']."'");
			while($text=mysqli_fetch_array($t)){
			?>
			<tr bgcolor="#CCCCCC">
            	<th><?=$text['number']?></th>
                <th><?=$text['status']?></th>
                <th>
                    <form method="post">
                    	<input type="hidden" value="<?=$text['id']?>" name="id" class="btn">
                        <?php
						//if($text['status'] != '考試完成' && $text['status']!='考試中' && $text['text']!='啟動登入'){
						?>
                        <input type="submit" value="修改" name="fix" class="btn">
                        <input type="submit" value="刪除" name="d" class="btn">
                        <?php
						//}
						?>
                        <input type="submit" value="複製" name="copy" class="btn">
                    </form>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" value="<?=$text['id']?>" name="id" class="btn">
                        <?php
						if($text['status'] != '已考完' && $text['text']!='啟動登入' && $text['text']!='考試中'){
							
						}
						?>
                    	<input type="submit" value="預覽" name="see" class="btn">
                        <input type="submit" value="統計" name="count" class="btn">
                    </form>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" value="<?=$text['id']?>" name="id" class="btn">
						<?php
                        if($text['status'] !='編輯中'){
                            if($text['text']==''){
                            ?><input type="submit" value="啟動登入" name="b1" class="btn"><?php
                            }else if($text['text']=='啟動登入'){
                            ?><input type="submit" value="開始作答" name="b2" class="btn"><?php
                            }
                        }else{
                            echo '編輯中';
                        }
                        ?>
                    </form>
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>