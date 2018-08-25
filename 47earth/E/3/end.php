<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	$mysql->query("UPDATE `text` SET `status` = '考試完成' WHERE `id` = '".$_SESSION['textid']."'");
	
	$mysql->query("UPDATE `name` SET `all_text` = '".$_SESSION['count']."', `yes_text` = '".$_SESSION['yes_text']."', `no_text` = '".$_SESSION['no_text']."', `null_text` = '".$_SESSION['null_text']."' WHERE `id` = '".$_SESSION['id']."'");
?>
<style>
	.btn{
		width:150px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	.btn:hover{
		background-color:#6CF;
	}
	
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
        <input class="btn" type="button" value="離開此問卷" onClick="location.href='index.php'">
        <p>&nbsp;</p>
        
        <table border="1" bgcolor="#6699FF" width="350px" height="200px">
        	<tr>
            	<th colspan="2">全部共<samp style="color:#000"><?=$_SESSION['count']?></samp>題</th>
            </tr>
            <tr>
            	<th width="70%">答對題數</th>
                <th bgcolor="#FFFFFF"><samp style="color:#000"><?=$_SESSION['yes_text']?></samp></th>
            </tr>
            <tr>
            	<th width="70%">答錯題數</th>
                <th bgcolor="#FFFFFF"><samp style="color:#000"><?=$_SESSION['no_text']?></samp></th>
            </tr>
            <tr>
            	<th width="70%">沒答題數</th>
                <th bgcolor="#FFFFFF"><samp style="color:#000"><?=$_SESSION['null_text']?></samp></th>
            </tr>
        </table>
        <p>&nbsp;</p>
        
        <?php
		$n=$mysql->query("SELECT * FROM `name` where `text_number` = '".$_SESSION['number']."' ORDER BY `yes_text` DESC");
		while($name=$n->fetch_array()){
		?>
		<table width="50%" height="200px" border="1" bgcolor="#6699FF">
        	<tr>
            	<th width="30%"><?=$name['name']?></th>
                <td<?php if($_SESSION['name'] == $name['name']){echo ' style="background-color:#FFF"';}?>>
                    答對題數:<?=$name['yes_text']?><br/>
                    答錯題數:<?=$name['no_text']?><br/>
                    沒答題數:<?=$name['null_text']?><br/>
                </td>
            </tr>
        </table>
		<?php
		}
		?>
        
        
    </h1></center>
</body>
</html>