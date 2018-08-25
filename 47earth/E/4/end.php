<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		session_destroy();
		header("location:index.php");
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
		height:300px;
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
		width:100px;
		height:50px;
		font-size:20px;
		background-color:#69F;
		border-radius:15px;
	}
	.btn{
		width:100px;
		height:50px;
		border:#F93 solid 5px;
		background-color: #FC3;
		font-size:20px;
	}
	.btn:hover{
		background-color:#06F;
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
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	統計<p/>
        <div class="box1"><form method="post"><input type="submit" name="ok" value="離開" class="out"></form></div>
        
        <table width="400px" bgcolor="#FF9933" border="1">
        	<tr>
            	<th>正確</th>
                <th bgcolor="#CCCCCC" width="70%"><?=$_SESSION['yes_text']?></th>
            </tr>
            <tr>
            	<th>錯誤</th>
                <th bgcolor="#CCCCCC"><?=$_SESSION['no_text']?></th>
            </tr>
            <tr>
            	<th>未填寫</th>
                <th bgcolor="#CCCCCC"><?=$_SESSION['null_text']?></th>
            </tr>
        </table>
        
        <p>&nbsp;</p>
        
        <?php
        $n=$mysql->query("SELECT * FROM `name` where `text_id` = '".$_SESSION['textid']."'");
		while($name=mysqli_fetch_array($n)){
		?>
        <table width="400px" bgcolor="#6699FF" border="1">
        	<tr>
            	<th><?=$name['name']?></th>
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