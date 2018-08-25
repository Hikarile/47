<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	$id=$_GET['id'];
	
	$te=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=$te->fetch_array();
	
	$aa=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
?>
<style>
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	.add{
		border:#FC6 solid 3px;
		background-color:#F90;
		font-size:20px;
		width:150px;
		height:50px;	
	}
	.add:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	form input[type=submit]{
		width:100px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	form input[type=submit]:hover{
		background-color:#6CF;
	}
	
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$text['text_number']?>
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="返回" onClick="location.href='menu.php'">
        </div><p>&nbsp;<p/>
        
        <?php
		$n=$mysql->query("SELECT * FROM `name` where `text_number` = '".$text['text_number']."' ORDER BY `yes_text` DESC");
		while($name=$n->fetch_array()){
		?>
		<table width="50%" height="200px" border="1" bgcolor="#6699FF">
        	<tr>
            	<th width="30%"><?=$name['name']?></th>
                <td>
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