<?php
	include('cd.php');
	
	$_SESSION['amount']++;
	
?>
<table width="90%" border="2">
    <tr bgcolor="#6699FF">
        <th width="15%"><?=$_SESSION['amount']?></th>
        <td>
            題目類型:<br/>
            <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r1" top="<?=$_SESSION['amount']?>">是非題</label>
            <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r2" top="<?=$_SESSION['amount']?>">單選題</label>
            <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r3" top="<?=$_SESSION['amount']?>">多選題</label>
            <p/>
            
            題目問題:</br>
            <label><textarea class="q" id="q<?=$_SESSION['amount']?>" name="q[<?=$_SESSION['amount']?>]"></textarea></label>
            </p>
            
            題目選項:</br>
            
            <div id="div1<?=$_SESSION['amount']?>" hidden>
            	1.是
                &nbsp;&nbsp;&nbsp;
                2.否
                &nbsp;&nbsp;&nbsp;
                正確解答:
                <select class="okda" name="okda<?=$_SESSION['amount']?>1">
                	<option value="是">是</option>
                    <option value="否">否</option>
                </select>
            </div>
            <div id="div2<?=$_SESSION['amount']?>" hidden>
            	1.<input type="text" id="n<?=$_SESSION['amount']?>21" name="n<?=$_SESSION['amount']?>2[1]">&nbsp;&nbsp;&nbsp;
                2.<input type="text" id="n<?=$_SESSION['amount']?>22" name="n<?=$_SESSION['amount']?>2[2]">&nbsp;&nbsp;&nbsp;
                3.<input type="text" id="n<?=$_SESSION['amount']?>23" name="n<?=$_SESSION['amount']?>2[3]">&nbsp;&nbsp;&nbsp;
                4.<input type="text" id="n<?=$_SESSION['amount']?>24" name="n<?=$_SESSION['amount']?>2[4]">&nbsp;&nbsp;&nbsp;
                正確解答:
                <select class="okda" name="okda<?=$_SESSION['amount']?>2">
                	<option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div id="div3<?=$_SESSION['amount']?>" hidden>
            	<input type="button" value="新增項目" onClick="add('<?=$_SESSION['amount']?>')">&nbsp;&nbsp;&nbsp;
            	<input type="button" value="刪除項目" onClick="d('<?=$_SESSION['amount']?>')"><br/>
                
                <input type="hidden" name="number[<?=$_SESSION['amount']?>]" value="4" id="number<?=$_SESSION['amount']?>">
            </div>
            
            <p/>
            <input type="hidden" name="type[<?=$_SESSION['amount']?>]" id="type<?=$_SESSION['amount']?>">
        </td>
    </tr>
</table>