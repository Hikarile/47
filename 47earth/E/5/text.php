<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	$count=$_SESSION['ga'];
	
	$ms=explode(' ',microtime("now"));
	$time=($_SESSION['t1'][$count]-($ms[1]+$ms['0']))*1000;
	
	if($_SESSION['ok'][$count]=='' && $_POST['ok']){
		if($_POST['da']!=''){
			if($_SESSION['type'][$count]=='3'){
				foreach($_POST['da'] as $key => $val){
					$ok=$ok.$val.',';
				}
				$_SESSION['ok'][$count]=$ok;
			}else{
				$_SESSION['ok'][$count]=$_POST['da'];
			}
			$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['id']."', '".$_SESSION['type'][$count]."', '".$_SESSION['ok'][$count]."')");
			header("location:text.php");
		}
	}
	
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
<script src="jquery.js"></script>
<script>
	setInterval(function(){
		location.href='img.php';
	},<?=$time?>)
</script>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><?=$count?>/<?=$_SESSION['count']?></div>
	<center><h1>
        <?=$_SESSION['number']?><p/>
        
        <form method="post">
			<table border="1" width="90%" height="150px" bgcolor="#FF9933"s>
            	<tr>
                	<th width="15%"><?=$count?></th>
                    <td>
                    	<?=$_SESSION['q'][$count]?>?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p/>
                        
                        <?php
                        if($_SESSION['type'][$count]=='1'){
						?>
                        <input type="radio" class="correct" name="da" id="da" value="是" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]=='是'){echo'checked';}?>>是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="否" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]=='否'){echo'checked';}?>>否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						}if($_SESSION['type'][$count]=='2'){
						$da=explode(',',$_SESSION['da'][$count]);
						?>
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[0]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]==$da[0]){echo'checked';}?>><?=$da[0]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[1]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]==$da[1]){echo'checked';}?>><?=$da[1]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[2]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]==$da[2]){echo'checked';}?>><?=$da[2]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="correct" name="da" id="da" value="<?=$da[3]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]==$da[3]){echo'checked';}?>><?=$da[3]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						}if($_SESSION['type'][$count]=='3'){
							$da=explode(',',$_SESSION['da'][$count]);
							foreach($da as $key=>$val){
								if($val!=''){
									$i=$key+1;
									?>
									<input type="checkbox" class="correct" name="da[<?=$i?>]" id="da" value="<?=$val?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?>
                                    <?php
                                    if($_SESSION['ok'][$count]!=''){
										$o=explode(',',$_SESSION['ok'][$count]);
										foreach($o as $key1=>$val1){
											if($val == $val1){
												echo'checked';
											}
										}
									}
									?>
                                    ><?=$val?><br/>
									<?php
								}
							}
						}
						?>
                    </td>
                </tr>
            </table><p/>
            <input type="submit" name="ok" value="確定" class="btn">
        </form>
    </h1></center>
</body>
</html>