<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	$count=$_SESSION['ga'];
	
	$ms=explode(' ',microtime("now"));
	$time=($_SESSION['t1'][$count]-($ms[1]+$ms[0]))*1000;
	
	if($_POST['ok']){
		if($_SESSION['ok'][$count]!=''){
			header('location:text.php');
		}else{
			if($_POST['da']!=''){
				if($_SESSION['type'][$count]=='3'){
					foreach($_POST['da'] as $key => $val){
						$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['id']."', '".$_SESSION['type'][$count]."', '$val')");
						$da=$da.$val.',';
					}
					$_SESSION['ok'][$count]=$da;
				}else{
					$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['id']."', '".$_SESSION['type'][$count]."', '".$_POST['da']."')");
					$_SESSION['ok'][$count]=$_POST['da'];
				}
			}
			header('location:text.php');
		}
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
<script src="jquery.js"></script>
<script>
	setInterval(function(){
		location.href='img.php';
	},<?=$time?>)
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?><p/>
        <div class="box1"><?=$count?>/<?=$_SESSION['count']?></div>
        
        <form method="post">
            <table width="80%" height="200px" bgcolor="#FF9900" border="1">
                <tr>
                    <th width="15%"><?=$count?></th>
                    <td>
                    <?=$_SESSION['q'][$count]?>?<p/>
                    
                    <?php
					if($_SESSION['type'][$count]=='1'){
						?>
						<input type="radio" name="da" class="da" value="是" <?php if($_SESSION['ok'][$count]=='是'){echo'checked';}?> <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?>>是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="da" class="da" value="否" <?php if($_SESSION['ok'][$count]=='否'){echo'checked';}?> <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?>>否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						}
					if($_SESSION['type'][$count]=='2'){
						for($i=1;$i<=4;$i++){
							?>
							<input type="radio" name="da" class="da" value="<?=$_SESSION['da'][$count][$i]?>"  <?php if($_SESSION['ok'][$count]==$_SESSION['da'][$count][$i]){echo'checked';}?> <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?>><?=$_SESSION['da'][$count][$i]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php
							}
						}
					if($_SESSION['type'][$count]=='3'){
						foreach($_SESSION['da'][$count] as $key => $val){
							?>
							<input type="checkbox" name="da[<?=$key?>]" class="da" value="<?=$val?>" 
							<?php
							$da=explode(',',$_SESSION['ok'][$count]);
							foreach($da as $key1 =>$val1){
								if($val1 == $val){
									echo 'checked';
								}
							}
							?> <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?>
							><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php
						}
					}
                    ?>
                    </td>
                </tr>
            </table><p/>
            <input type="submit" name="ok" value="確定" class="sub">
        </form>
    </h1></center>
</body>
</html>