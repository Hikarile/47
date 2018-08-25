<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	$count=$_SESSION['ga'];
	
	$ms=explode(' ',microtime("now"));
	$time=($_SESSION['t2'][$count]-($ms[1]+$ms[0]))*1000;
	
	if($_SESSION['ok'][$count]==''){
		$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['id']."', '".$_SESSION['type'][$count]."', '')");
	}
	
	if($_SESSION['null_text']+$_SESSION['yes_text']+$_SESSION['no_text']!=$count){
		if($_SESSION['ok'][$count]==''){
			$_SESSION['null_text']+=1;
		}else{
			if($_SESSION['ok'][$count] == $_SESSION['correct'][$count]){
				$_SESSION['yes_text']+=1;
			}else{
				$_SESSION['no_text']+=1;
			}
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
		location.href='next.php';
	},<?=$time?>)
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?><p/>
        <div class="box1"><?=$count?>/<?=$_SESSION['count']?></div>
        
        <table>
        	<tr>
            	<th width="50%">正確答案</th>
                <th width="50%"><samp style="color:#F00;"><?=$_SESSION['correct'][$count]?></samp></th>
            </tr>
            <tr>
            	<th width="50%">您的答案</th>
                <th width="50%"><samp style="color:#00F;">
                <?php
				if($_SESSION['ok'][$count]==''){
					echo '未填寫';
				}else{
					echo $_SESSION['ok'][$count];
				}
				?>
                </samp></th>
            </tr>
        </table>
        <img src="img/png2.php?textid=<?=$_SESSION['textid']?>&qaid=<?=$_SESSION['qid'][$count]?>" width="300px" height="300px">
    </h1></center>
</body>
</html>