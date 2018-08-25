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
        <?=$text['text_number']?><p>&nbsp;<p/>
        
        <form method="post">
        	<?php
			$count=0;
            $q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
			while($qa=mysqli_fetch_array($q)){
			$count++;
			?>
			<table border="1" width="90%" height="150px" bgcolor="#FF9933"s>
            	<tr>
                	<th width="15%"><?=$count?></th>
                    <td>
                    	<?=$qa['q']?>?
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        if($qa['type']=='1'){
						?>
                        <samp style="color:#F00;">是非題</samp><p/>
                        <input type="radio" class="correct" name="da" id="da" value="是">是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="否">否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						}if($qa['type']=='2'){
						$da=explode(',',$qa['da']);
						?>
                        <samp style="color:#F00;">是非題</samp><p/>
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[0]?>"><?=$da[0]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[1]?>"><?=$da[1]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[2]?>"><?=$da[2]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[3]?>"><?=$da[3]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						}if($qa['type']=='3'){
							$da=explode(',',$qa['da']);
							?>
							<samp style="color:#F00;">是非題</samp><p/>
							<?php
							foreach($da as $key=>$val){
								if($val!=''){
									$i=$key+1;
									?>
									<input type="checkbox" class="correct" name="da[<?=$i?>]" id="da" value="<?=$val?>"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
        </form>
        
    </h1></center>
</body>
</html>