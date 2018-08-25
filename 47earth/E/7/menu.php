<!doctype html>
<html><head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	
	if($_POST['fix']){
		$id=$_POST['id'];
		header("location:fix_text.php?id=".$id);
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
		
		$i=0;
		$time1='';
		$time2='';
		$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
		while($qa=mysqli_fetch_array($q)){
			$i++;
			$time1=$time+$qa['t1']*$i+$qa['t2']*($i-1);
			$time2=$time+$qa['t1']*$i+$qa['t2']*$i;
			$mysql->query("UPDATE `qa` SET `time1` = '$time1', `time2` = '$time2' WHERE `id` = '".$qa['id']."'");
			$time1='';
			$time2='';
		}
		
		$mysql->query("UPDATE `text` SET `status` = '考試中', `test` = '".$_POST['b2']."',`time` = '$time' WHERE `id` = '$id'");
		header("location:menu.php");
	}
	
?>
<style>
	.box1{
		display: inline-block;
	}
	.box2{
		width:450px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
	}
	.out{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FF9;
		font-size:25px;
	}
	.sub{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FC3;
		font-size:25px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:70px;
		border:#36F solid 3px;
		background-color:#69F;
		font-size:25px;
		border-radius:20px;
	}
	.btn:hover{
		background-color:#06F;
	}
	.sub:hover{
		background-color:#F96;
	}
	.out:hover{
		background-color:#F90;
	}
	
	.t{
		width:200px;
		height:30px;
		font-size:23px;
	}
	@media screen and (max-width: 600px){
		input[type="submit"]{
			width: 80px;
			height: 40px;
			font-size: 50%;
		}
	}
</style>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><input type="button" name="out" value="登出" onClick="location.href='out.php'" class="out"></div>
	<center><h1>
		<div style="text-align:center;">
			<span>試卷管理</span><p/>
			
			<input type="button" value="新增試卷" onClick="location.href='add_text.php'" class="sub">
            <?php
            if($_SESSION['type']=='管理者'){
			?>
            <input type="button" value="管理管理者" onClick="location.href='teacher.php'" class="sub">
            <?php
			}
			?><p/>
        </div>
        <table width="90%" border="1" bgcolor="#6699FF">
        	<tr>
            	<th width="10%">編號</th>
                <th width="10%">狀態</th>
                <th width="30%">編輯</th>
                <th width="20%">檢視</th>
                <th width="10%">考試</th>
            </tr>
            <?php
			$t=$mysql->query("SELECT * FROM `text` where `type` = '".$_SESSION['id']."'");
			while($text=mysqli_fetch_array($t)){
			?>
			<tr bgcolor="#CCCCCC">
            	<th><?=$text['text_number']?></th>
                <th><?=$text['status']?></th>
                <th>
                    <form method="post">
                    	<input type="hidden" value="<?=$text['id']?>" name="id" class="btn">
                        <?php
						if($text['status'] != '考試完成' && $text['status']!='考試中' && $text['test']!='啟動登入'){
						?>
                        <input type="submit" value="修改" name="fix" class="btn">
                        <input type="submit" value="刪除" name="d" class="btn">
                        <?php
						}
						?>
                        <input type="submit" value="複製" name="copy" class="btn">
                    </form>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" value="<?=$text['id']?>" name="id" class="btn">
                        <?php
						if($text['status'] != '已考完' && $text['test']!='啟動登入' && $text['test']!='考試中'){
							
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
                            if($text['test']==''){
                            ?><input type="submit" value="啟動登入" name="b1" class="btn"><?php
                            }else if($text['test']=='啟動登入'){
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