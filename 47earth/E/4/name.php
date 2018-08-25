<?php
	include("cd.php");
	
	$nowname=$_SESSION['name'];
	$number=$_SESSION['number'];
	
	$n=$mysql->query("SELECT * FROM `name` where `text_number` = '$number'");
	
	$t=$mysql->query("SELECT * FROM `text` where `text_number` = '$number'");
	$text=mysqli_fetch_array($t);
	if($text['test']=='開始作答'){
		echo  'start';
	}
	echo '-----';
?>
<table class="name" border="1">
	<?php
	$i=0;
    while($name=mysqli_fetch_array($n)){
	$i++;
	?>
	<tr height="100px" <?php if($name['name'] == $nowname){echo'bgcolor="#CCCCCC"';}?>>
    	<th><?=$i?></th>
        <th><?=$name['name']?></th>
    </tr>
	<?php
	}
	?>
</table>