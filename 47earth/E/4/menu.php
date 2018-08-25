<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['fix']){
		$id=$_POST['id'];
		header("location:fix_test.php?id=".$id);
	}
	if($_POST['d']){
		$id=$_POST['id'];
		$mysql->query("DELETE FROM `text` WHERE `id` = '$id'");
		$mysql->query("DELETE FROM `qa` WHERE `text_id` = '$id'");
		$mysql->query("DELETE FROM `name` WHERE `text_id` = '$id'");
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
		$mysql->query("UPDATE `text` SET `test` = '".$_POST['b1']."' WHERE `id` = '$id'");
		header("location:menu.php");
	}
	if($_POST['b2']){
		$id=$_POST['id'];
		
		$ms=explode(' ',microtime("now"));
		$time=$ms[1]+$ms[0];
		$mysql->query("UPDATE `text` SET `status` = '考試中', `test` = '".$_POST['b2']."', `time` = '$time' WHERE `id` = '$id'");
		
		$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
		$text=mysqli_fetch_array($t);
		
		$i=0;
		$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
		while($qa=mysqli_fetch_array($q)){
			$i++;
			$time1=$time+$text['time1']*$i+$text['time2']*($i-1);
			$time2=$time+$text['time1']*$i+$text['time2']*$i;
			$mysql->query("UPDATE `qa` SET `time1` = '$time1', `time2` = '$time2' WHERE `id` = '".$qa['id']."'");
			$time1='';
			$time2='';
		}
		header("location:menu.php");
	}
?>
<style>
	.box1{
		position:absolute;
		top:20px;
		right:20px;
	}
	.box2{
		width:500px;
		height:250px;
		border:#F96 solid 3px;
		background-color:#FC6;
		padding-top:20px;
	}
	.out{
		border:#F90 solid 3px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#FFFF99;
	}
	.sub{
		border:#36F solid 2px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#69F;
		border-radius:15px;
	}
	.btn{
		width:130px;
		height:50px;
		border:#F93 solid 5px;
		background-color: #FC3;
		font-size:20px;
	}
	.btn:hover{
		background-color:#F60;
	}
	.sub:hover{
		background-color:#06F;
	}
	.out:hover{
		background-color:#F93
	}
</style>
<script src="jquery.js"></script>
<script></script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	試卷管理<p/>
        <div class="box1"><input type="button" value="登出" onClick="location.href='out.php'" class="out"></div>
        
        <input type="button" value="新增試卷" onClick="location.href='add_test.php'" class="btn"><p/>
        
        <table border="1" width="80%" bgcolor="#6699FF">
        	<tr>
            	<th width="10%">編號</th>
                <th width="10%">狀態</th>
                <th width="30%">編輯</th>
                <th width="20%">檢視</th>
                <th width="10%">考試</th>
            </tr>
            <?php
			$t=$mysql->query("SELECT * FROM `text`");
            while($text=mysqli_fetch_array($t)){
			?>
            <tr bgcolor="#CCCCCC">
            	<th><?=$text['text_number']?></th>
                <th><?=$text['status']?></th>
                <th>
					<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                        <?php
                        //if($text['status'] != '考試中' && $text['status']!='考試完成' && $text['test']!='啟動登入'){
						?>
						<input type="submit" name="fix" value="修改" class="sub">
                        <input type="submit" name="d" value="刪除" class="sub">
						<?php
						//}
						?>
                        <input type="submit" name="copy" value="複製" class="sub">
                    </form>
                </th>
                <th>
					<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                    	<input type="submit" name="see" value="檢視" class="sub">
                        <input type="submit" name="count" value="統計" class="sub">
                    </form>
                </th>
                <th>
					<form method="post">
                    	<input type="hidden" name="id" value="<?=$text['id']?>">
                        <?php
						if($text['status'] != '編輯中'){
							if($text['test']==''){
							?><input type="submit" name="b1" value="啟動登入" class="sub"><?php
							}else if($text['test']=='啟動登入'){
							?><input type="submit" name="b2" value="開始作答" class="sub"><?php
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