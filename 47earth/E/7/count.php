<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	$id=$_GET['id'];
	
	if($_POST['ok']){
		$id=$_POST['id'];
		$number=$_POST['number'];
		
		$mysql->query("DELETE FROM `name` WHERE `id` = '$id' and `text_number` = '$number'");
		$c=$mysql->query("SELECT * FROM `count` where `nameid` = '$id'");
		while($count=mysqli_fetch_array($c)){
			$mysql->query("DELETE FROM `count` WHERE `id` = ".$count['id']."");
		}
		header("location:count.php?id=".$_GET['id']);
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
	
	.correct{
		width:45px;
		height:35px;
		font-size:23px;
	}
</style>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><input type="button" value="返回" onClick="location.href='menu.php'" class="out"></div>
	<center><h1>
        <?php
		$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
		$text=mysqli_fetch_array($t);
		
		$n=$mysql->query("SELECT * FROM `name` where `text_id` = '$id'");
		while($name=mysqli_fetch_array($n)){
		?>
		<table border="1" width="700px" bgcolor="#FF9933">
        	<tr>
            	<th width="15%"><?=$name['name']?></th>
                <th>
                	正確:<?=$name['yes_text']?><br/>
                    錯誤:<?=$name['no_text']?><br/>
                    未填寫:<?=$name['null_text']?><br/>
                </th>
                <th>
                	<form method="post">
                    	<input type="hidden" name="number" value="<?=$text['text_number']?>">
                    	<input type="hidden" name="id" value="<?=$name['id']?>">
                    	<input type="submit" name="ok" value="刪除" class="btn">
                    </form>
                </th>
            </tr>
        </table><p/>
		<?php
		}
		?>
        <?php
        $q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
		$i=0;
		while($qa=mysqli_fetch_array($q)){
		$i++;
		?>
        <?=$i?>.<br/>
		<img src="img/png1.php?textid=<?=$id?>&qaid=<?=$qa['id']?>" width="300px" height="300px">
        <img src="img/png2.php?textid=<?=$id?>&qaid=<?=$qa['id']?>" width="300px" height="300px">
        <img src="img/png3.php?textid=<?=$id?>&qaid=<?=$qa['id']?>" width="300px" height="300px">
        <p/>
		<?php
		}
		?>
    </h1></center>
</body>
</html>