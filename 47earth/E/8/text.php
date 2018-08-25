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
	
	if($_POST['ok']){
		if($_SESSION['ok'][$count]==''){
			if($_SESSION['type'][$count]=='1'){
				$da=$_POST['da'];
				$_SESSION['ok'][$count]=$da;
			}
			if($_SESSION['type'][$count]=='2'){
				$da=$_POST['da'];
				$_SESSION['ok'][$count]=$da;
			}
			if($_SESSION['type'][$count]=='3'){
				foreach($_POST['da'] as $key => $val){
					$da=$da.$val.',';
				}
				$_SESSION['ok'][$count]=$da;
			}
			$mysql->query("INSERT INTO `count` (`nameid`, `textid`, `qaid`, `type`, `da`) VALUES ('".$_SESSION['id']."', '".$_SESSION['textid']."', '".$_SESSION['qid'][$count]."', '".$_SESSION['type'][$count]."', '".$da."')");
			
			header("location:text.php");
		}
	}
?>
<style>
	.box1{
		width:400px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
		margin:20px;
	}
	.sub{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.sub:hover{
		background-color:#36F;
	}
	.out{
		width:150px;
		height:60px;
		border:#F63 solid 3px;
		background-color:#FF9;
		font-size:23px;
	}
	.out:hover{
		background-color:#F90;
	}
	.btn{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.btn:hover{
		background-color:#39F;
	}
	.text{
		width:150px;
		height:30px;
		font-size:23px;
	}
	.correct{
		width:40px;
		height:40px;
		font-size:15px;
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
	<samp style="font-size:50px"><?=$count?>/<?=$_SESSION['count']?></samp>
    <center><h1>
    	
        <?=$_SESSION['number']?><p/>
        <form method="post">
            <table width="80%" bgcolor="#FF9900" border="1" height="100px">
                <tr>
                    <th width="20%"><?=$count?></th>
                    <td>
                        <?=$_SESSION['q'][$count]?>?</p>
                        
                        <?php
                        if($_SESSION['type'][$count]=='1'){
                            ?>
                            <input type="radio" name="da" class="correct" value="是" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]=='是'){echo'checked';}?>>是
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="da" class="correct" value="否" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count]=='否'){echo'checked';}?>>否
                            <?php
                        }
                        if($_SESSION['type'][$count]=='2'){
                            $da=explode(',',$_SESSION['da'][$count]);
                            ?>
                            <input type="radio" name="da" class="correct" value="<?=$da[0]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count] == $da[0]){echo'checked';}?>><?=$da[0]?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="da" class="correct" value="<?=$da[1]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count] == $da[1]){echo'checked';}?>><?=$da[1]?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="da" class="correct" value="<?=$da[2]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count] == $da[2]){echo'checked';}?>><?=$da[2]?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="da" class="correct" value="<?=$da[3]?>" <?php if($_SESSION['ok'][$count]!=''){echo'disabled';}?> <?php if($_SESSION['ok'][$count] == $da[3]){echo'checked';}?>><?=$da[3]?>
                            <?php
                        }
                        if($_SESSION['type'][$count]=='3'){
                            $da=explode(',',$_SESSION['da'][$count]);
                            foreach($da as $key=>$val){
                                if($val!=''){
                                ?>
                                <input type="checkbox" name="da[<?=$i?>]" class="correct" value="<?=$val?>"
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
                                ><?=$val?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                <?php
                                }
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