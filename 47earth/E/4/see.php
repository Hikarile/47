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
        
        <form action="menu.php">
        	<?php
			$i=0;
            $q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
			while($qa=mysqli_fetch_array($q)){
			$i++;
			?>
			<table border="1" width="80%" height="100px" bgcolor="#FF9933">
            	<tr>
                	<th width="15%"><?=$i?></th>
                    <td>
                    	<?=$qa['q']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        if($qa['type']==1){
							?>
							<samp style="color:#F00">是非題</samp><p/>
							<input class="da" type="radio" name="da1[<?=$i?>]" value="是">是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="da" type="radio" name="da1[<?=$i?>]" value="否">否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php
						}
						if($qa['type']==2){
							$da=explode(',',$qa['da']);
							?>
							<samp style="color:#F00">單選題</samp><p/>
							<?php
							foreach($da as $key=>$val){
								if($val!=''){
									$j=$key+1;
									?>
									<input class="da" type="radio" name="da2[<?=$i?>]" value="<?=$val?>"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php
								}
							}
						}
						if($qa['type']==3){
							$da=explode(',',$qa['da']);
							?>
							<samp style="color:#F00">多選題</samp><p/>
							<?php
							foreach($da as $key=> $val){
								if($val!=''){
									$j=$key+1;
									?>
									<input class="da" type="checkbox" name="da3<?=$i?>[<?=$j?>]" value="<?=$val?>"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			?><p/>
            <input class="sub" type="submit" name="ok" value="確定">
        </form>
        
    </h1></center>
</body>
</html>