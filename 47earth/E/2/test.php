<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	$count=$_SESSION['ga'];
	
	$ms=explode(' ', microtime("now"));
	$time=$_SESSION['t1'][$count]-($ms[1]+$ms[0]);
	
	if($_POST['ok']){
		$qaid=$_POST['qaid'];
		$type=$_POST['type'];
		if($_POST['da'] !=''){
			if($type=='3'){
				foreach($_POST['da'] as $j => $da){
					$_SESSION['ok'][$count][$j]=$da;
					$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['text_id']."', '$qaid', '".$_SESSION['id']."', '$type', '$da')");
				}
			}else{
				$da=$_POST['da'];
				$_SESSION['ok'][$count]=$da;
				$mysql->query("INSERT INTO `count` (`textid`, `qaid`, `nameid`, `type`, `da`) VALUES ('".$_SESSION['text_id']."', '$qaid', '".$_SESSION['id']."', '$type', '$da')");
			}
		}
		$_SESSION['timeout']=$_POST['timeout'];
		header('location:test.php');
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
	
	.annotation{
		font-size:25px;
		color:#C00;
	}
	.da{
		width:25px;
		height:25px;
	}
	
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	var time=<?=$time?>;
	var ok='<?=$_SESSION['ok'][$count]?>';
	setInterval(function (){
		if(ok==''){
			$.ajax({
				url:"save.php",
				type:"POST",
				data:{type:<?=$_SESSION['type'][$count]?>,qaid:<?=$_SESSION['qaid'][$count]?>}
			})
		}
		location.href = 'img.php';
	}, time * 1000);
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$_SESSION['number']?>
        
        <div style="position:absolute; top:30px; right:60px;">
        	<?=$count?>/<?=$_SESSION['count']?>
        </div><p>&nbsp;<p/>
        
        
        <form method="post">
            <table border="1" bgcolor="#6699FF" width="90%">
                <tr>
                    <th width="15%"><?=$count?></th>
                    <td>
                    	<?=$_SESSION['q'][$count]?>?
                        &nbsp;&nbsp;
                        <?php
                        if($_SESSION['type'][$count]=='1'){
							echo '<label class="annotation">是非題</label>';
						}else if($_SESSION['type'][$count]=='2'){
							echo '<label class="annotation">單選題</label>';
						}else if($_SESSION['type'][$count]=='3'){
							echo '<label class="annotation">複選題</label>';
						}
						?><p/>
                        
                        <?php
                        if($_SESSION['type'][$count] == '1'){
							if($_SESSION['ok'][$count]==''){
							?>
							<input class="da" type="radio" name="da" value="是">是
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="da" type="radio" name="da" value="否">否
							<?php
							}else{
							?>
							<input class="da" type="radio" name="da" value="是" disabled <?php if($_SESSION['ok'][$count]=="是"){echo'checked';}?>>是
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="da" type="radio" name="da" value="否" disabled <?php if($_SESSION['ok'][$count]=="否"){echo'checked';}?>>否
							<?php
							}
						}if($_SESSION['type'][$count] == '2'){
                            for($j=1;$j<=4;$j++){
								if($_SESSION['ok'][$count]==''){
								?>
								<input class="da" type="radio" name="da" value="<?=$_SESSION['da'][$count][$j-1]?>"><?=$_SESSION['da'][$count][$j-1]?>
                            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
								}else{
								?>
								<input class="da" type="radio" name="da" value="<?=$_SESSION['da'][$count][$j-1]?>" disabled <?php if($_SESSION['ok'][$count]==$_SESSION['da'][$count][$j-1]){echo'checked';}?>><?=$_SESSION['da'][$count][$j-1]?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
								}
                            }
						}if($_SESSION['type'][$count] == '3'){
							foreach($_SESSION['da'][$count] as $key=>$val){
								if($_SESSION['ok'][$count]==''){
								?>
								<input class="da" type="checkbox" name="da[<?=$key?>]" value="<?=$val?>"><?=$val?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
								}else{
								?>
								<input class="da" type="checkbox" name="da[<?=$key?>]" value="<?=$val?>"disabled
                                <?php
                                for($i=1;$i<=count($_SESSION['ok'][$count]);$i++){
									if($_SESSION['ok'][$count][$i]==$val){
										echo 'checked';
									}
								}
								?>
                                ><?=$val?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
								}
							}
						}
						?>	
                    </td>
                </tr>
            </table><p/>
            <input type="hidden" name="type" value="<?=$_SESSION['type'][$count]?>">
            <input type="hidden" name="qaid" value="<?=$_SESSION['qaid'][$count]?>">
            <input type="hidden" name="timeout">
            <?php
            if($_SESSION['ok'][$count]==''){
				echo'<input type="submit" name="ok" value="確定">';
			}
			?>
        </form>
    </h1></center>
</body>
</html>