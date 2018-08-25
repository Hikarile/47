<?php
	include("cd.php");
	
	$namen=$_SESSION['name'];
	$number=$_SESSION['number'];
		
	$n=$mysql->query("SELECT * FROM `name` where `text_number` = '$number'");
	
	$t=$mysql->query("SELECT * FROM `text` where `text_number` = '$number'");
	$text=mysqli_fetch_array($t);
	if($text['test']=='開始作答'){
		echo 'start';
	}
	echo '----';
?>
<table border="1" bgcolor="#6699FF" width="400px">
	<?php
    while($name=mysqli_fetch_array($n)){
	$i++;
	?>
    <tr <?php if($name['name'] == $namen){echo'bgcolor="#CCCCCC"';}?>>
        <th><?=$i?></th>
        <td><?=$name['name']?></td> 
    </tr>
    <?php
    }
	?>
</table>