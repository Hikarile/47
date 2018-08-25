<?php
	include("cd.php");
	$aa=$_POST['aa'];
	for($i=1;$i<=$aa;$i++){
		echo '<tr class="p">
				<th bgcolor="#CCCCCC">圖片:</th>
				<td><input type="file" name="png'.$i.'"></td>
			</tr>';
	}
?>