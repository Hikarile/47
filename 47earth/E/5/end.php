<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	
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
<div class="box1"><input type="button" value="離開試卷" onClick="location.href='index.php'" class="out"></div>
	<center><h1>
		<?=$_SESSION['number']?><p/>
        
        <?php
        $n=$mysql->query("SELECT * FROM `name` where `text_id` = '".$_SESSION['textid']."'");
		while($name=mysqli_fetch_array($n)){
		?>
		<table border="1" width="400px" bgcolor="#FF9933">
        	<tr>
            	<th width="15%"><?=$name['name']?></th>
                <th>
                	正確:<?=$name['yes_text']?><br/>
                    錯誤:<?=$name['no_text']?><br/>
                    未填寫:<?=$name['null_text']?><br/>
                </th>
            </tr>
        </table>
		<?php
		}
		?>
        
    </h1></center>
</body>
</html>