<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	
	$id=$_GET['id'];
	
	$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($t);
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
	.correct{
		width:40px;
		height:40px;
		font-size:15px;
	}
</style>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<input type="button" value="離開" onClick="location.href='index.php'" class="out">
    <center><h1>
    	
        <?=$text['number']?><p/>
        
        <?php
		$n=$mysql->query("SELECT * FROM `name` where `textid` = '".$_SESSION['textid']."' ORDER BY `yestext` DESC");
		while($name=mysqli_fetch_array($n)){
		?>
		<table border="1" width="500px" bgcolor="#FF9933">
        	<tr>
            	<th width="15%"><?=$name['name']?></th>
                <th>
                	正確:<?=$name['yestext']?><br/>
                    錯誤:<?=$name['notext']?><br/>
                    未填寫:<?=$name['nulltext']?><br/>
                </th>
                <th>
                	<?=$name['yestext']?>/<?=$name['alltext']?>
                </th>
            </tr>
        </table>
		<?php
		}
		?>
        
    </h1></center>
</body>
</html>