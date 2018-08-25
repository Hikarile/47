<?php
	include("cd.php");
	
	$t=$mysql->query("SELECT * FROM `text` where `id` = '".$_SESSION['textid']."'");
	$text=mysqli_fetch_array($t);
	if($text['text']=='開始作答'){
		echo 'start';
	}
	echo '-----';
	
	$n=$mysql->query("SELECT * FROM `name` where `textid` = '".$_SESSION['textid']."'");
	$i=0;
	while($name=mysqli_fetch_array($n)){
		$i++;
	?>
	<table width="100%" height="100px" border="1" <?php if($name['id'] == $_SESSION['id']){echo'bgcolor="#999999"';}?>>
    	<tr>
        	<th width="20%"><?=$i?></th>
            <th><?=$name['name']?></th>
        </tr>
    </table>
	<?php
	}
?>