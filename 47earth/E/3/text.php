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
		if($_SESSION['ok'][$count]==''){
			if($_POST['da'] !=''){
				$textid=$_POST['textid'];
				$qid=$_POST['qid'];
				$nameid=$_SESSION['id'];
				$type=$_POST['type'];
				
				if($type=='3'){
					foreach($_POST['da'] as $j => $da){
						$_SESSION['ok'][$count][$j]=$da;
						$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('$textid', '$qaid', '$nameid', '$type', '$da')");
					}
				}else{
					$_SESSION['ok'][$count]=$_POST['da'];
					$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('$textid', '$qid', '$nameid', '$type', '".$_POST['da']."')");
				}
				header('location:text.php');
			}
		}else{
			echo '<script>alert("無法修改答案")</script>';
		}
	}
?>
<style>
	.box1{
		position:absolute;
		top:50px;
		right:100px;
	}
	.box2{
		width:400px;
		border: #F93 solid 3px;
    	background-color: #FC6;
		padding:30px;
	}
	.text{
		width:200px;
		height:25px;
		font-size:20px;
	}
	.out{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FFFF99;
		font-size:20px;
	}
	.sub{
		border:#36F solid 4px;
		background-color:#69F;
		width:120px;
		height:60px;
		font-size:25px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FC3;
		font-size:20px;
	}
	.out:hover{
		background-color:#C63;
	}
	.sub:hover{
		background-color:#6CF;
	}
	.btn:hover{
		background-color:#C63;
	}
	.t{
		max-width:100%;
		max-height:150px;
		min-width:100%;
		min-height:150px;
		font-size:25px;
	}
	.corrext{
		width:50px;
		height:40px;
		font-size:20px;
	}
	.table{
		font-size:40px;
	}
</style>
<script src="jquery.js"></script>
<script>
	setInterval(function(){
		location.href = 'img.php';
	},<?=$time?>);
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?><p>&nbsp;<p/>
        <div class="box1"><?=$count?>/<?=$_SESSION['count']?></div>
        
        <form method="post">
		<table border="1" bgcolor="#FF9933" width="80%" height="200px" class="table">
        	<tr>
            	<th width="15%"><?=$count?></th>
                <td>
                	<?=$_SESSION['q'][$count]?>?<p/>
                    <?php
					if($_SESSION['ok'][$count]==''){
						if($_SESSION['type'][$count]=='1'){
							?>
							<input class="corrext" type="radio" name="da" value="是">是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="corrext" type="radio" name="da" value="否">否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php
						}
						if($_SESSION['type'][$count]=='2'){
							foreach($_SESSION['da'][$count] as $key => $val){
                            	?>
								<input class="corrext" type="radio" name="da" value="<?=$val?>'"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
							}
						}
						if($_SESSION['type'][$count]=='3'){
							foreach($_SESSION['da'][$count] as $key => $val){
                            	?>
								<input class="corrext" type="checkbox" name="da[<?=$key?>]" value="<?=$val?>"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
							}
						}
					}else{
						if($_SESSION['type'][$count]=='1'){
							?>
							<input class="corrext" type="radio" name="da" value="是"<?php if($_SESSION['ok'][$count]=='是'){echo' checked';}?> disabled>是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="corrext" type="radio" name="da" value="否"<?php if($_SESSION['ok'][$count]=='否'){echo' checked';}?> disabled>否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php
						}
						if($_SESSION['type'][$count]=='2'){
							foreach($_SESSION['da'][$count] as $key => $val){
								?>
								<input class="corrext" type="radio" name="da" value="<?=$val?>"<?php if($_SESSION['ok'][$count]==$val){echo' checked';}?> disabled><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
							}
						}
						if($_SESSION['type'][$count]=='3'){
							foreach($_SESSION['da'][$count] as $key => $val){
								?>
								<input class="corrext" type="checkbox" name="da[<?=$key?>]" value="<?=$val?>" disabled
                                <?php
                                foreach($_SESSION['ok'][$count] as $key1 => $val1){
									if($val == $val1){
										echo' checked';
									}
								}
								?>
                                ><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
							}
						}

					}
					?>
                </td>
            </tr>
        </table><p/>
        <input type="hidden" name="textid" value="<?=$_SESSION['textid']?>">
        <input type="hidden" name="type" value="<?=$_SESSION['type'][$count]?>">
        <input type="hidden" name="qid" value="<?=$_SESSION['qid'][$count]?>">
        <input class="sub" type="submit" name="ok" value="確定">
        </form>
    </h1></center>
</body>
</html>