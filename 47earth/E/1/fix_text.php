<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('cd.php');
	unset($_SESSION['amount']);
	
	$id=$_GET['id'];
	
	$bb=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$b=mysqli_fetch_array($bb);
	
	$aa=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
?>
<style>
	.btn{
		 border:#FC6 solid 3px;
		 background-color:#FF9;
		 font-size:20px;
		 width:150px;
		 height:50px;
	}
	.btn:hover{
		background-color:#C63;
	}
	
	form input[type=submit]{
		width:130px;
		height:50px;
		border:#03F solid 3px;
		border-radius:20px;
		background-color:#69F;
		font-size:20px;
	}
	form input[type=submit]:hover{
		background-color:#6CF;
	}
	
	.q{
		max-width:90%;
		max-height:70px;
		width:90%;
		height:70px;
		font-size:20px;
	}
	.okda{
		width:50px;
		height:35px;
		font-size:20px;
	}
</style>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$(document).on('click','input[type="radio"]',function(){
			var date=$(this).attr('date');
			var top=$(this).attr('top');
			for(i=1;i<=4;i++){
				$("#div"+i+top).attr('hidden','hidden');
			}
			
			if(date == 'r1'){
				$("#type"+top).val('1');
				$("#div1"+top).removeAttr('hidden');
			}
			if(date == 'r2'){
				for(j=1;j<=4;j++){
					$("#n"+top+"2"+j).val('');
				}
				
				$("#type"+top).val('2');
				$("#div2"+top).removeAttr('hidden');
			}
			if(date == 'r3'){
				$("#number"+top).val('4');
				for(j=1;j<=8;j++){
					$("#"+top+j).remove();
				}
				for(j=1;j<=4;j++){
					var da='<label id="'+top+j+'">'+j+'.<input type="text" id="n'+top+"3"+j+'" name="n'+top+'3['+j+']">&nbsp;&nbsp;&nbsp正確解答<input class="okda" id="okda'+top+'3'+j+'" type="checkbox" name="okda'+top+'3['+j+']" vlaue="'+j+'"><br/></label>';
					$("#number"+top).before(da);
				}
				
				$("#type"+top).val('3');
				$("#div3"+top).removeAttr('hidden');
			}
			if(date == 'r4'){
				$("#type"+top).val('4');
				$("#div4"+top).removeAttr('hidden');
			}
		})
		
		$("#sub").submit(function(){
			var ppp=$("#ppp").val();
			for(i=1;i<=ppp;i++){
				var ok='';
				
				if($("#type"+i).val()==''){
					alert('你未選擇題目類型');
					return false;
				}
				if($("#q"+i).val() == ''){
					alert('你第'+i+'題的題目沒填');
					return false;
				}
				if($("#type"+i).val() == '2'){
					for(j=1;j<=4;j++){
						if($("#n"+i+"2"+j).val() == ''){
							alert('你第'+i+'題的第'+j+'個答案沒填');
							return false;
						}
					}
				}
				if($("#type"+i).val() == '3'){
					var number=$("#number"+i).val();
					for(j=1;j<=number;j++){
						if($("#n"+i+"3"+j).val() == ''){
							alert('你第'+i+'題的第'+j+'個答案沒填');
							return false;
						}
						if($("#okda"+i+"3"+j).prop('checked')==true){
							ok++;
						}
					}
					if(ok == ''){
						alert('你第'+i+'題的正確答案未選擇');
						return false;
					}
				}
			}
		})
	})
	
	function change(b,s){
		if($("#okda"+b+"3"+s).attr('checked') == 'checked'){
			$("#okda"+b+"3"+s).removeAttr('checked');
		}else{
			$("#okda"+b+"3"+s).attr('checked','checked');
		}
	}
	
	
	function topic(){//新增題目
		var ppp=$("#ppp").val();
		ppp++;
		$("#ppp").val(ppp);
		
		$.ajax({
			url:"topic.php",
			success: function(da){
				$(".ok").removeAttr('hidden');
				$("#p").before(da);
			}
		})
	}
	
	function add(top){//新增答案
		var val=$("#number"+top).val();
		if(val < 8){
			val++;
			da='<label id="'+top+val+'">'+val+'.<input type="text" id="n'+top+'3'+val+'" name="n'+top+'3['+val+']">&nbsp;&nbsp;&nbsp正確解答<input class="okda" id="okda'+top+'3'+jval+'" type="checkbox" name="okda'+top+'3['+val+']" vlaue="'+val+'"><br/></label>';
			$("#number"+top).before(da);
			$("#number"+top).val(val);
		}
	}
	function d(top){//刪除答案
		var val=$("#number"+top).val();
		if(val > 2){
			$("#"+top+val).remove();
			val--;
			$("#number"+top).val(val);
		}
	}
	
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	修改試卷<p/>
        
        <div style="position:absolute; top:30px; right:60px;">
        	<input class="btn" type="button" value="返回" onClick="location.href='menu.php'">
        </div>
        
        <input class="btn" style="background-color:#C63;" type="button" value="新增題目" onClick="topic()"><p/>
        
        <form method="post" id="sub" action="fix.php">
        	
            <?php
            while($a=mysqli_fetch_array($aa)){
			$_SESSION['amount']++;
			?>
            <table width="90%" border="2">
                <tr bgcolor="#6699FF">
                    <th width="15%"><?=$_SESSION['amount']?></th>
                    <td>
                        題目類型:<br/>
                        <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r1" top="<?=$_SESSION['amount']?>" <?php if($a['type']=='1'){echo 'checked';}?>>是非題</label>
                        <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r2" top="<?=$_SESSION['amount']?>" <?php if($a['type']=='2'){echo 'checked';}?>>單選題</label>
                        <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r3" top="<?=$_SESSION['amount']?>" <?php if($a['type']=='3'){echo 'checked';}?>>多選題</label>
                        <label><input type="radio" name="type[<?=$_SESSION['amount']?>]" date="r4" top="<?=$_SESSION['amount']?>" <?php if($a['type']=='4'){echo 'checked';}?>>問答題</label>
                        <p/>
                        
                        題目問題:</br>
                        <label><textarea class="q" id="q<?=$_SESSION['amount']?>" name="q[<?=$_SESSION['amount']?>]"><?=$a['q']?></textarea></label>
                        </p>
                        
                        題目選項:</br>
                        
                        <div id="div1<?=$_SESSION['amount']?>" <?php if($a['type']!='1'){echo 'hidden';}?>>
                            1.是 &nbsp;&nbsp;&nbsp; 2.否&nbsp;&nbsp;&nbsp;
							正確解答:
                            <select class="okda" name="okda<?=$_SESSION['amount']?>1">
                                <option value="是" <?php if($a['correct'] == '是'){echo'selected';}?>>是</option>
                                <option value="否" <?php if($a['correct'] == '否'){echo'selected';}?>>否</option>
                            </select>
                        </div>
                        <div id="div2<?=$_SESSION['amount']?>" <?php if($a['type']!='2'){echo 'hidden';}?>>
                        	<?php
                            if($a['type'] == '2'){
								$da=explode(',',$a['da']);
								for($i=1;$i<=4;$i++){
									echo $i.'.<input type="text" id="n'.$_SESSION['amount'].'2'.$i.'" name="n'.$_SESSION['amount'].'2['.$i.']" value="'.$da[$i-1].'">&nbsp;&nbsp;&nbsp;';
								}
							}
							?>&nbsp;&nbsp;&nbsp;
               				正確解答:
							<select class="okda" name="okda<?=$_SESSION['amount']?>2">
                                <option value="1"<?php if($a['correct'] == $da[0]){echo'selected';}?>>1</option>
                                <option value="2"<?php if($a['correct'] == $da[1]){echo'selected';}?>>2</option>
                                <option value="3"<?php if($a['correct'] == $da[2]){echo'selected';}?>>3</option>
                                <option value="4"<?php if($a['correct'] == $da[3]){echo'selected';}?>>4</option>
                            </select>
                        </div>
                        <div id="div3<?=$_SESSION['amount']?>"  <?php if($a['type']!='3'){echo 'hidden';}?>>
                            <input type="button" value="新增項目" onClick="add('<?=$_SESSION['amount']?>')">&nbsp;&nbsp;&nbsp;
                            <input type="button" value="刪除項目" onClick="d('<?=$_SESSION['amount']?>')"><br/>
                            
                            <?php
                            if($a['type'] == '3'){
								$da=explode(',',$a['da']);
								$ok=explode(',',$a['correct']);
								foreach($da as $i=>$d){
									$ookk='';
									if($d !=''){
										$ii=$i+1;
										echo '<label id="'.$_SESSION['amount'].$ii.'">'.$ii.'.<input type="text" id="n'.$_SESSION['amount'].'3'.$ii.'" name="n'.$_SESSION['amount'].'3['.$ii.']" value="'.$d.'">&nbsp;&nbsp;&nbsp;正確解答';
										
										foreach($ok as $ookk){
											if($ookk!=''){
												if($ookk == $d){
													echo '<input class="okda" id="okda'.$_SESSION['amount'].'3'.$ii.'" type="checkbox" name="okda'.$_SESSION['amount'].'3['.$ii.']" vlaue="'.$ii.'" checked onClick="change('.$_SESSION['amount'].','.$ii.')">';
													$ookk='true';
													break;
												}
											}
										}
										if($ookk==''){
											echo '<input class="okda" id="okda'.$_SESSION['amount'].'3'.$ii.'" type="checkbox" name="okda'.$_SESSION['amount'].'3['.$ii.']" vlaue="'.$ii.'" onClick="change('.$_SESSION['amount'].','.$ii.')">';
										}
										echo '<br/></label>';
									}
								}
							}
							?>
                            <input type="hidden" name="number[<?=$_SESSION['amount']?>]" value="<?=$ii?>" id="number<?=$_SESSION['amount']?>">
                        </div>
                        <div id="div4<?=$_SESSION['amount']?>"  <?php if($a['type']!='4'){echo 'hidden';}?>>
                            自由填寫
                        </div>
                        
                        <p/>
                        <input type="hidden" name="type[<?=$_SESSION['amount']?>]" id="type<?=$_SESSION['amount']?>" value="<?=$a['type']?>">
                    </td>
                </tr>
            </table>
			<?php
			}
			?>
        	
            <p id="p">&nbsp;</p>
            <input type="hidden" name="ppp" id="ppp" value="<?=$_SESSION['amount']?>">
            <input type="hidden" name="id" id="id" value="<?=$id?>">
            
            <label class="t">作答時間:<input type="number" id="time1" name="time1" max="60" min="10" value="<?=$b['time1']?>">秒</label><br/>
            <label class="t">統計觀看時間:<input type="number" id="time2" name="time2" max="60" min="10" value="<?=$b['time2']?>">秒</label><p/>
            
            <input class="ok" type="submit" name="ok" value="稍後再編輯">
            <input class="ok" type="submit" name="ok" value="編輯完成">
        </form>
        
    </h1></center>
</body>
</html>