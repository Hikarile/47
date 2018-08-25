<?php
	include("cd.php");
	$_SESSION['count']++;
?>
<table width="90%" bgcolor="#FF6600" border="2">
	<tr>
    	<th width="15%"><?=$_SESSION['count']?></th>
        <td>
        	<samp>問題題型:<br/></samp>
            <label><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" data="1">是非題</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" data="2">單選題</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" data="3">多選題</label></>
            
            <samp>問題題目:<br/></samp>
            <textarea style="width:80%; height:100px; font-size:23px;" id="q<?=$_SESSION['count']?>" name="q[<?=$_SESSION['count']?>]"></textarea><p/>
            
            <samp>問題答案:<br/></samp>
            
        </td>
    </tr>
</table>