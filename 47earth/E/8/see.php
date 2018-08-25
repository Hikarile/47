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
	<input type="button" value="返回" onClick="location.href='menu.php'" class="out">
    <center><h1>
    	
        <?=$text['number']?><p/>
        
        <?php
        $q=$mysql->query("SELECT * FROM `qa` where `textid` = '$id'");
		$i=0;
		while($qa=mysqli_fetch_array($q)){
			$i++
		?>
		<table width="80%" bgcolor="#FF9900" border="1" height="100px">
        	<tr>
            	<th width="20%"><?=$i?></th>
                <td>
                	<?=$qa['q']?>?
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    if($qa['type']=='1'){
						?>
						<samp style="color:red;">是非題</samp><p/>
                        <input type="radio" name="ok1[<?=$i?>]" class="correct">是
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ok1[<?=$i?>]" class="correct">否
						<?php
					}
					if($qa['type']=='2'){
						$da=explode(',',$qa['da']);
						?>
						<samp style="color:red;">單選題</samp><p/>
                        <input type="radio" name="ok2[<?=$i?>]" class="correct" value="<?=$da[0]?>"><?=$da[0]?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ok2[<?=$i?>]" class="correct" value="<?=$da[1]?>"><?=$da[1]?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ok2[<?=$i?>]" class="correct" value="<?=$da[2]?>"><?=$da[2]?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ok2[<?=$i?>]" class="correct" value="<?=$da[3]?>"><?=$da[3]?>
						<?php
					}
					if($qa['type']=='3'){
						$da=explode(',',$qa['da']);
						?>
						<samp style="color:red;">多選題</samp><p/>
						<?php
						foreach($da as $key=>$val){
							if($val!=''){
							?>
							<input type="checkbox" name="ok3[<?=$i?>]" class="correct" value="<?=$val?>"><?=$val?>
							<?php
							}
						}
					}
					?>
                </td>
            </tr>
        </table>
		<?php
		}
		?>
    </h1></center>
</body>
</html>