<?php
	include("cd.php");
	include("login.php");
	
	$_SESSION['count']++;
?>
<table width="80%" height="150px" bgcolor="#FF9900" border="1">
	<tr>
    	<th width="15%"><?=$_SESSION['count']?></th>
        <td>
        	問題題型:<br/>
            <label class="labelXD"><input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1">是非題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <label class="labelXD"><input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2">單選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <label class="labelXD"><input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3">多選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <p/>
            
            問題題目:<br/>
            <textarea class="q" name="q[<?=$_SESSION['count']?>]" id="q<?=$_SESSION['count']?>"></textarea>
            <p/>
            
            問題答案:<br/>
            <div id="div1<?=$_SESSION['count']?>" hidden>
            	<label class="labelXD">1.是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label class="labelXD">2.否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<label class="labelXD">
					正確答案:
					<select name="correct1[<?=$_SESSION['count']?>]" class="correct">
						<option value="是">是</option>
						<option value="否">否</option>
					</select>
				</label>
            </div>
            <div id="div2<?=$_SESSION['count']?>" hidden>
            	<label class="labelXD">1.<input type="text" name="da2<?=$_SESSION['count']?>[1]" id="da2<?=$_SESSION['count']?>1" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label class="labelXD">2.<input type="text" name="da2<?=$_SESSION['count']?>[2]" id="da2<?=$_SESSION['count']?>2" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label class="labelXD">3.<input type="text" name="da2<?=$_SESSION['count']?>[3]" id="da2<?=$_SESSION['count']?>3" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label class="labelXD">4.<input type="text" name="da2<?=$_SESSION['count']?>[4]" id="da2<?=$_SESSION['count']?>4" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br/>
                <label class="labelXD">
					正確答案:
					<select name="correct2[<?=$_SESSION['count']?>]" class="correct">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</label>
            </div>
            <div id="div3<?=$_SESSION['count']?>" hidden>
            	<input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><br/>
                
                <input type="hidden" name="number[<?=$_SESSION['count']?>]" id="number<?=$_SESSION['count']?>">
            </div>
            <p>&nbsp;<p/>
            
            作答時間<input type="number" name="time1[<?=$_SESSION['count']?>]" id="time1<?=$_SESSION['count']?>" min="0" value="20" class="t">秒<br/>
            統計觀看時間<input type="number" name="time2[<?=$_SESSION['count']?>]" id="time2<?=$_SESSION['count']?>" min="0" value="20" class="t">秒
            <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>">
        </td>
    </tr>
</table>