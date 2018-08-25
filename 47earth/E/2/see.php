<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	$id=$_GET['id'];
	
	$bb=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$b=mysqli_fetch_array($bb);
	
	$aa=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
?>
<style>
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
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
	
	.add{
		border:#FC6 solid 3px;
		background-color:#F90;
		font-size:20px;
		width:150px;
		height:50px;	
	}
	.add:hover{
		border:#FC6 solid 3px;
		background-color:#C63;
		font-size:20px;
		width:150px;
		height:50px;
	}
	
	.text{
		width:95%;
		height:100px;
		font-size:25px;
		max-width:95%;
		max-height:100px;
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
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	預覽試卷<p/>
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="返回" onClick="location.href='menu.php'">
        </div>
        
        <form method="post">
			<?php
            while($a=mysqli_fetch_array($aa)){
                $i++;
            ?>
            <table width="90%" border="2">
                <tr bgcolor="#6699FF">
                    <th width="15%"><?=$i?></th>
                    <td>
                        <?=$i?>.<br/>
                        <?=$a['q']?>?
                        &nbsp;&nbsp;
                        <?php
                        if($a['type']=='1'){
							echo '<label class="annotation">是非題</label>';
						}else if($a['type']=='2'){
							echo '<label class="annotation">單選題</label>';
						}else if($a['type']=='3'){
							echo '<label class="annotation">複選題</label>';
						}
						?><p/>
                        
                        <?php
                        if($a['type'] == '1'){
                        ?>
                        <input class="da" type="radio" name="type1[<?=$i?>]" value="是">是
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="da" type="radio" name="type1[<?=$i?>]" value="否">否
                        <?php
                        }if($a['type'] == '2'){
                            $da=explode(',',$a['da']);
                            for($j=1;$j<=4;$j++){
                            ?>
                            <input class="da" type="radio" name="type2[<?=$i?>]" value="<?=$da[$j-1]?>"><?=$da[$j-1]?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php
                            }
                        }if($a['type'] == '3'){
                            $da=explode(',',$a['da']);
                            foreach($da as $j=>$d){
                                if($d != '' ){
                                    ?>
                                    <input class="da" type="checkbox" name="type3[<?=$j+1?>][<?=$i?>]" value="<?=$d?>"><?=$d?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                }
                            }
                        }if($a['type'] == '4'){
                        ?>
                        <textarea class="text" name="type4[<?=$i?>]"></textarea>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <?php
            }
            ?>
            <p/>
            
            作答時間<label style="color:#F00;"><?=$b['time1']?></label>秒<br/>
            統計觀看時間<label style="color:#F00;"><?=$b['time2']?></label>秒<p/>
            
            <input class="add" type="button" value="確定" onClick="location.href='menu.php'">
        </form>
        
    </h1></center>
</body>
</html>