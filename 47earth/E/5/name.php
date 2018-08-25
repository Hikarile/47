<?php
	include("cd.php");
	
	$t=$mysql->query("SELECT * FROM `text` where `id` = '".$_SESSION['textid']."'");
	$text=mysqli_fetch_array($t);
	if($text['test']=='開始作答'){
		echo 'start';
	}
	echo '-----';
	$n=$mysql->query("SELECT * FROM `name` where `text_id` = '".$_SESSION['textid']."'");
?>
<table width="100%" border="1">
	<?php
	$i=0;
    while($name=mysqli_fetch_array($n)){
    $i++;
	?>
	<tr height="100px" <?php if($name['name'] == $_SESSION['name']){echo'bgcolor="#CCCCCC"';}?>>
    	<th width="30%"><?=$i?></th>
        <th><?=$name['name']?></th>
    </tr>
	<?php
    }
    ?>
</table>