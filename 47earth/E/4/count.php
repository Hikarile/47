<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	$id=$_GET['id'];
	$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($t);
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
	.da{
		width:30px;
		height:30px;
		font-size:23px;
	}
</style>
<script src="jquery.js"></script>
<script></script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$text['text_number']?><p/>
        <div class="box1"><input class="out" type="button" value="返回" onClick="location.href='menu.php'"></div>
        
        <table width="400px" bgcolor="#6699FF" border="1">
        	<tr bgcolor="#CCCCCC">
            	<th>姓名</th>
            	<th>答題狀況</th>
            </tr>
        <?php
        $n=$mysql->query("SELECT * FROM `name` where `text_id` = '$id'");
		while($name=mysqli_fetch_array($n)){
		?>
        	<tr>
            	<th><?=$name['name']?></th>
            	<th>
                    正確:<?=$name['yes_text']?><br/>
                    錯誤:<?=$name['no_text']?><br/>
                    未填寫:<?=$name['null_text']?><br/>
                </th>
            </tr>
		<?php
		}
		?>
        </table>
        
    </h1></center>
</body>
</html>