<?php
	include("cd.php");
	include("login.php");
	
	$_SESSION['count']++;
?>
<table width="80%" border="1" bgcolor="#FF9900">
	<tr>
    	<th width="15%"><?=$_SESSION['count']?></th>
        <td>
        	問題題型:<br/>
            <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1" class="correct">是非題</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2"class="correct">單選題</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3"class="correct">多選題</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p/>
            
            問題題目:<br/>
            <textarea style="width:80%; height:100px; font-size:23px;" name="q[<?=$_SESSION['count']?>]" id="q<?=$_SESSION['count']?>"></textarea><p/>
            
            問題答案:<br/>
            <div class="div1<?=$_SESSION['count']?>" hidden>
                <label class="label">1.是</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="label">2.否</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="label">
                	正確答案:
                   	<select name="correct1<?=$_SESSION['count']?>" class="correct">
                    	<option value="是">是</option>
                        <option value="否">否</option>
                    </select>
                </label>
            </div>
            <div class="div2<?=$_SESSION['count']?>" hidden>
            	<label class="label">1.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[1]" id="da2<?=$_SESSION['count']?>1"></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="label">2.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[2]" id="da2<?=$_SESSION['count']?>2"></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="label">3.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[3]" id="da2<?=$_SESSION['count']?>3"></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="label">4.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[4]" id="da2<?=$_SESSION['count']?>4"></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                <label class="label">
                	正確答案:
                   	<select name="correct2<?=$_SESSION['count']?>" class="correct">
                    	<option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </label>
            </div>
            <div class="div3<?=$_SESSION['count']?>" hidden>
            	<input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><p/>
                
                <input type="hidden" value="4" id="number<?=$_SESSION['count']?>" name="number<?=$_SESSION['count']?>">
            </div><p/>
            
            <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>">
            
           <label class="label">作答時間<input class="text" type="number" name="t1[<?=$_SESSION['count']?>]" id="t1<?=$_SESSION['count']?>" value="20" min="0">秒</label><br/>
           <label class="label">統計觀看時間<input class="text" type="number" name="t2[<?=$_SESSION['count']?>]" id="t2<?=$_SESSION['count']?>" value="20" min="0">秒</label>
        </td>
    </tr>
</table>
