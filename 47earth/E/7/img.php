<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	$count=$_SESSION['ga'];
	
	if($_SESSION['ok'][$count]==''){
		$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['id']."', '".$_SESSION['type'][$count]."', '')");
	}
	
	$ms=explode(' ',microtime("now"));
	$time=($_SESSION['t2'][$count]-($ms[1]+$ms['0']))*1000;
	
	if($_SESSION['null_text']+$_SESSION['no_text']+$_SESSION['yes_text']<>$count){
		if($_SESSION['ok'][$count]==''){
			$_SESSION['null_text']++;
		}else if($_SESSION['correct'][$count] == $_SESSION['ok'][$count]){
			$_SESSION['yes_text']++;
		}else{
			$_SESSION['no_text']++;
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
		location.href='next.php';
	},<?=$time?>)
</script>
</head>

<body bgcolor="#FFFF99">
<samp style="font-size:40px"><?=$count?>/<?=$_SESSION['count']?></samp>
	<center><h1>
        <?=$_SESSION['number']?><p>&nbsp;<p/>
        
        <table width="300px">
        	<tr>
            	<th>正確答案:</th>
                <th><samp stylWe="color:#00F"><?=$_SESSION['correct'][$count]?></samp></th>
            </tr>
            <tr>
            	<th>您的答案:</th>
                <th><samp style="color:#F00">
                <?php
                if($_SESSION['ok'][$count]!=''){
					echo $_SESSION['ok'][$count];
				}else{
					echo'未填寫';
				}
				?>
                </samp></th>
            </tr>
        </table>
        <img src="img/png2.php?textid=<?=$_SESSION['textid']?>&qaid=<?=$_SESSION['qid'][$count]?>" width="300px" height="300px">
    </h1></center>
</body>
</html>