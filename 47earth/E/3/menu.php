<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	include("login.php");
	
	$te=$mysql->query("SELECT * FROM `text`");
	
	if($_POST['fix']){
		$id=$_POST['id'];
		header("location:fix_test.php?id=$id");
	}
	if($_POST['d']){
		$id=$_POST['id'];
		$mysql->query("DELETE FROM `text` WHERE `id` = '$id'");
		$mysql->query("DELETE FROM `qa` WHERE `text_id` = '$id'");
		$mysql->query("DELETE FROM `name` WHERE `text_id` = '$id'");
		$mysql->query("DELETE FROM `count` WHERE `textid` = '$id'");
		header("location:menu.php");
	}
	if($_POST['see']){
		$id=$_POST['id'];
		header("location:see.php?id=".$id);
	}
	
	if($_POST['count']){
		$id=$_POST['id'];
		header("location:count.php?id=".$id);
	}
	if($_POST['copy']){
		$id=$_POST['id'];
		header("location:copy.php?id=".$id);
	}
	
	if($_POST['b1']){
		$id=$_POST['id'];
		$mysql->query("UPDATE `text` SET `test` = '".$_POST['b1']."' WHERE `id` = '$id'");
		header('location:menu.php');
	}
	if($_POST['b2']){
		$id=$_POST['id'];
		
		$ms=explode(" ",microtime("now"));
		$time=$ms[1]+$ms[0];
		
		$mysql->query("UPDATE `text` SET `test` = '".$_POST['b2']."',`status` = '考試中', `time` = '$time' WHERE `id` = '$id'");
		
		$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
		$text=mysqli_fetch_array($t);
		
		$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
		$i=1;
		while($qa=mysqli_fetch_array($q)){
			$time1=$time+$text['time1']*$i+$text['time2']*($i-1);
			$time2=$time+$text['time1']*$i+$text['time2']*$i;
			$mysql->query("UPDATE `qa` SET `time1` = '$time1', `time2` = '$time2' WHERE `id` = '".$qa['id']."'");
			$time1='';
			$time2='';
			$i++;
		}
		header('location:menu.php');
	}
?>
<style>
	.box1{
		position:absolute;
		top:50px;
		right:100px;
	}
	.box2{
		width:400px;
		border: #F93 solid 3px;
    	background-color: #FC6;
		padding:30px;
	}
	.text{
		width:200px;
		height:25px;
		font-size:20px;
	}
	.out{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FFFF99;
		font-size:20px;
	}
	.sub{
		border:#36F solid 4px;
		background-color:#69F;
		width:100px;
		height:50px;
		font-size:20px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FC3;
		font-size:20px;
	}
	.out:hover{
		background-color:#C63;
	}
	.sub:hover{
		background-color:#6CF;
	}
	.btn:hover{
		background-color:#C63;
	}
</style>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	試卷管理<p/>
        <div class="box1"><input class="out" type="button" value="登出" onClick="location.href='out.php'"></div><p/>
        
        <input class="btn" type="button" value="新增題目" onClick="location.href='add_test.php'">
        
        <table width="90%" border="1">
        	<tr bgcolor="#3366FF">
            	<th>編號</th>
                <th>狀態</th>
                <th>編輯</th>
                <th>檢視</th>
                <th>考試</th>
            </tr>
            <?php
            while($text=mysqli_fetch_array($te)){
			?>
			<tr bgcolor="#66CCCC">
            	<th><?=$text['text_number']?></th>
                <th>
					<?=$text['status']?>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                    	<?php
						//if($text['status'] != '考試中' && $text['status'] != '考試完成' && $text['test'] != '啟動登入'){
						?>
                        <input class="sub" type="submit" name="fix" value="修改">
                        <input class="sub" type="submit" name="d" value="刪除">
						<?php
						//}
						?>
                        <input class="sub" type="submit" name="see" value="預覽">
                    </form>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                    	<input class="sub" type="submit" name="count" value="檢視">
                        <input class="sub" type="submit" name="copy" value="複製">
                    </form>
                </th>
                <th>
                	<?php if($text['status'] != '編輯中'){ ?>
                	<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                        <?php
                        if($text['test']==''){
							echo '<input class="sub" type="submit" name="b1" value="啟動登入">';
						}else if($text['test']=='啟動登入'){
							echo '<input class="sub" type="submit" name="b2" value="開始作答">';
						}
						?>
                    </form>
                    <?php }else{echo '編輯中';}?>
                </th>
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>