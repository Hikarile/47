<?php
	include("include.php");
	
	$aa=$_POST['aa'];
	for($i=1;$i<=$aa;$i++){
		echo '<tr class="p">
				<th bgcolor="#999999">圖片:</th>
				<th><input type="file" name="png'.$i.'"></th>
			</tr>';
	}
?>