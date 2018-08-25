<?php
	include("cd.php");
	include("login.php");
	$_SESSION['count']++;
?>
<table width="80%" height="200px;" border="1" bgcolor="#FF9933">
	<tr>
    	<th width="10%"><?=$_SESSION['count']?></th>
        <td>
        	問題類型<br/>
        	<input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1">是非題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2">單選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3">多選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p/>
            
            問題題目<br/>
            <textarea class="t" id="q<?=$_SESSION['count']?>" name="q[<?=$_SESSION['count']?>]"></textarea><p/>
            
            問題答案<br/>
            <div id="div1<?=$_SESSION['count']?>" hidden>
            	1.是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2.否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                正確答案:
                <select class="corrext" id="correct<?=$_SESSION['count']?>" name="correct1[<?=$_SESSION['count']?>]">
                	<option value="是">是</option>
                    <option value="否">否</option>
                </select>
            </div>
            <div id="div2<?=$_SESSION['count']?>" hidden>
            	1.<input type="text" name="da2<?=$_SESSION['count']?>[1]" id="da2<?=$_SESSION['count']?>1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2.<input type="text" name="da2<?=$_SESSION['count']?>[2]" id="da2<?=$_SESSION['count']?>2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                3.<input type="text" name="da2<?=$_SESSION['count']?>[3]" id="da2<?=$_SESSION['count']?>3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                4.<input type="text" name="da2<?=$_SESSION['count']?>[4]" id="da2<?=$_SESSION['count']?>4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                正確答案:
                <select class="corrext" id="correct<?=$_SESSION['count']?>" name="correct2[<?=$_SESSION['count']?>]">
                	<option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div id="div3<?=$_SESSION['count']?>" hidden>
            	<input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><br/>
                
                <input type="hidden" name="number[<?=$_SESSION['count']?>]" id="number<?=$_SESSION['count']?>" value="4">
            </div>
            <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>">
        </td>
    </tr>
</table>