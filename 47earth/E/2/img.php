<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	$count=$_SESSION['ga'];
	
	$ms=explode(' ', microtime("now"));
	$time=$_SESSION['t2'][$count]-($ms[1]+$ms[0]);
	
	$aaa='';
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
	.text{
		width:95%;
		height:100px;
		font-size:25px;
		max-width:95%;
		max-height:100px;
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
	
	.time{
		font-size:80px;
		border:#000 solid 2px;
		border-radius:50px;
		width:100px;
		height:100px;
	}
	
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	var time=<?=$time?>;
	setInterval(function(){
		ga='<?=$_SESSION['ga']?>';
		count='<?=$_SESSION['count']?>';
		if(count <= ga){
			location.href='end.php';
		}else{
			location.href='next.php';
		}
	},time*1000);
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?>
        
        <div style="position:absolute; top:30px; right:60px;">
        	<?=$count?>/<?=$_SESSION['count']?>
        </div><p/>
        
        <?=$count?>.<?=$_SESSION['q'][$count]?>?</p>
        
        <table>
        	<tr>
            	<th>您的答案:</th>
                <th><samp style="color:#F00;">
                	<?php
					if($_SESSION['ok'][$count] != ''){
						if($_SESSION['type'][$count]=='3'){
							foreach($_SESSION['ok'][$count] as $key => $val){
								echo $val.",";
							}
						}else{
							echo $_SESSION['ok'][$count];
						}
					}else{
						echo '未填寫';
					}
					?>
                </samp></th>
            </tr>
            <tr>
            	<th>正確解答:</th>
                <th><samp style="color:#00F;"><?=$_SESSION['correct'][$count]?></samp></th>
            </tr>
        </table><p/>
        
        <table>
        	<tr>
            	<th>個答案統計</th>
            </tr>
            <tr>
                <td>
                	<img src="png/png1.php?textid=<?=$_SESSION['text_id']?>&qaid=<?=$_SESSION['qaid'][$count]?>" width="400px" height="400px">
                </td>
            </tr>
        </table>
        
    </h1></center>
</body>
</html>