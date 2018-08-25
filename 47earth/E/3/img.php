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
		$textid=$_SESSION['textid'];
		$qid=$_SESSION['qid'][$count];
		$nameid=$_SESSION['id'];
		$type=$_SESSION['type'][$count];
		$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('$textid', '$qid', '$nameid', '$type', '')");
		$_SESSION['correct'][$count]='未填寫';
	}
	
	if($_SESSION['null_text']+$_SESSION['yes_text']+$_SESSION['no_text']<$count){
		if($_SESSION['ok'][$count]==''){
			$_SESSION['null_text']+=1;
		}else{
			if($_SESSION['type'][$count]!='3'){
				if($_SESSION['correct'][$count] == $_SESSION['ok'][$count]){
					$_SESSION['yes_text']+=1;
				}else{
					$_SESSION['no_text']+=1;
				}
			}else{
				foreach($_SESSION['ok'][$count] as $key => $val){
					$aaa=$aaa.$val.",";
				}
				if($_SESSION['correct'][$count] == $aaa){
					$_SESSION['yes_text']+=1;
				}else{
					$_SESSION['no_text']+=1;
				}
			}
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
		var ga=<?=$_SESSION['ga']?>+1;
		var count=<?=$_SESSION['count']?>;
		if(ga>count){
			location.href = 'end.php';
		}else{
			location.href = 'next.php';
		}
	},<?=$time?>);
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?><p>&nbsp;<p/>
        <div class="box1"><?=$count?>/<?=$_SESSION['count']?></div>
        
        <table width="300px">
        	<tr>
            	<th>正確答案:</th>
                <td><samp style="color:#00F"><?=$_SESSION['correct'][$count]?></samp></td>
            </tr>
            <tr>
            	<th>您的答案:</th>
                <td><samp style="color:#F00">
                <?php
                if($_SESSION['type'][$count]=='3'){
					echo $aaa;
				}else{
					echo $_SESSION['ok'][$count];
				}
				?>
                </samp></td>
            </tr>
        </table>
       <img src="img/png2.php?textid=<?=$_SESSION['textid']?>&qaid=<?=$_SESSION['qid'][$count]?>" width="300px" height="300px">
    </h1></center>
</body>
</html>