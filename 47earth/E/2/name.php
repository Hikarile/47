<?php
	include('cd.php');
	
	$name=$_SESSION['name'];
	$number=$_SESSION['number'];
	
	$aa=$mysql->query("SELECT * FROM `name` where `text_number` = '$number'");
	
	$bb=$mysql->query("SELECT * FROM `text` where `text_number` = '$number'");
	$b=mysqli_fetch_array($bb);
	if($b['test'] == '開始作答'){
		echo 'start';
	}
	echo '________________';
?>
<table width="100%" border="1">
	<?php
    while($a=mysqli_fetch_array($aa)){
	$i++;
	?>
    <tr <?php if($a['name'] == $name){echo'bgcolor="#CCCCCC"';}?>>
        <th><?=$i?></th>
        <td><?=$a['name']?></td>
    </tr>
    <?php
    }
	?>
</table>