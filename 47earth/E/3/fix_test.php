<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	include("login.php");
	$_SESSION['count']=0;
	
	$id=$_GET['id'];
	
	$te=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($te);
	
	$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
?>
<style>
	.box1{
		position:absolute;
		top:50px;
		right:100px;
	}
	.box2{
		width:400px;
		border: #F93 solid 3px;
    	background-color: #FC6;
		padding:30px;
	}
	.text{
		width:200px;
		height:25px;
		font-size:20px;
	}
	.out{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FFFF99;
		font-size:20px;
	}
	.sub{
		border:#36F solid 4px;
		background-color:#69F;
		width:120px;
		height:60px;
		font-size:21px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FC3;
		font-size:20px;
	}
	.out:hover{
		background-color:#C63;
	}
	.sub:hover{
		background-color:#6CF;
	}
	.btn:hover{
		background-color:#C63;
	}
	.t{
		max-width:100%;
		max-height:150px;
		min-width:100%;
		min-height:150px;
		font-size:25px;
	}
	.corrext{
		width:50px;
		height:40px;
		font-size:20px;
	}
</style>
<script src="jquery.js"></script>
<script>
	$(function(){
		$(document).on('click','input[type="radio"]',function(){
			var count=$(this).attr('count');
			var date=$(this).attr('date');
			for(i=1;i<=3;i++){
				$("#div"+i+count).attr('hidden','hidden');
			}
			
			if(date=='1'){
				$("#div1"+count).removeAttr('hidden');
				$("#type"+count).val(date);
			}
			if(date=='2'){
				$("#div2"+count).removeAttr('hidden');
				$("#type"+count).val(date);
				for(i=1;i<=4;i++){
					$("#da2"+count+i).val('');
				}
			}
			if(date=='3'){
				$("#div3"+count).removeAttr('hidden');
				$("#type"+count).val(date);
				for(i=1;i<=4;i++){
					$(".lb3"+count+i).remove();
				}
				for(i=1;i<=4;i++){
					var da='<label class="lb3'+count+i+'">'+i+'.<input type="text" name="da3'+count+'['+i+']" id="da3'+count+i+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確答案<input class="corrext" type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" vlaue="'+i+'"><br/></label>';
					$("#number"+count).before(da);
				}
			}
		})
		
		
		$("#sub").submit(function(){
			var p=$("#p").val();
			for(i=1;i<=p;i++){
				if($("#type"+i).val()==''){
					alert('第'+i+'題的題型未選擇');
					return false;
				}
				if($("#q"+i).val()==''){
					alert('第'+i+'題的題目未選擇');
					return false;
				}
				
				if($("#type"+i).val() == '2'){
					for(j=1;j<=4;j++){
						if($("#da2"+i+j).val()==''){
							alert('第'+i+'題第'+j+'個答案未填');
							return false;
						}
					}
				}
				if($("#type"+i).val() == '3'){
					var ok=0;
					var jj=$("#number"+i).val();
					for(j=1;j<=jj;j++){
						if($("#da3"+i+j).val()==''){
							alert('第'+i+'題第'+j+'個答案未填');
							return false;
						}
						if($("#correct3"+i+j).prop('checked')==true){
							ok++;
						}
					}
					if(ok==0){
						alert('第'+i+'題正確答案未填');
						return false;
					}
				}
				
				if($("#time1").val()==''){
					alert('作答時間未填');
					return false;
				}
				if($("#time2").val()==''){
					alert('統計觀看時間未填');
					return false;
				}
			}
		})
	})
	function topic(){
		var p=$("#p").val();
		p++;
		$("#p").val(p);
		$.ajax({
			url:"topic.php",
			success: function(da){
				$("#p").before(da);
			}
		})
		$(".t").removeAttr('hidden');
		$(".sub").removeAttr('hidden');
	}
	function add(count){
		var i=$("#number"+count).val();
		if(i<8){
			i++;
			$("#number"+count).val(i);
			var da='<label class="lb3'+count+i+'">'+i+'.<input type="text" name="da3'+count+'['+i+']" id="da3'+count+i+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確答案<input class="corrext" type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" vlaue="'+i+'"><br/></label>';
			$("#number"+count).before(da);
		}
	}
	function d(count){
		var i=$("#number"+count).val();
		if(i>2){
			$(".lb3"+count+i).remove();
			i--;
			$("#number"+count).val(i);
		}
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	修改試卷<p/>
        <div class="box1"><input type="button" value="返回" class="out" onClick="location.href='menu.php'"></div>
        <input type="button" value="新增題目" onClick="topic()" class="out"><p/>
        
        <form method="post" action="fix.php" id="sub">
        	<?php
            while($qa=mysqli_fetch_array($q)){
			$_SESSION['count']++;
			?>
			<table width="80%" height="200px;" border="1" bgcolor="#FF9933">
                <tr>
                    <th width="10%"><?=$_SESSION['count']?></th>
                    <td>
                        問題類型<br/>
                        <input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1"<?php if($qa['type']=='1'){echo'checked';}?>>是非題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2"<?php if($qa['type']=='2'){echo'checked';}?>>單選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3"<?php if($qa['type']=='3'){echo'checked';}?>>多選題&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p/>
                        
                        問題題目<br/>
                        <textarea class="t" id="q<?=$_SESSION['count']?>" name="q[<?=$_SESSION['count']?>]"><?=$qa['q']?></textarea><p/>
                        
                        問題答案<br/>
                        <div id="div1<?=$_SESSION['count']?>"<?php if($qa['type']!=1){echo'hidden';}?>>
                            1.是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            2.否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            正確答案:
                            <select class="corrext" id="correct<?=$_SESSION['count']?>" name="correct1[<?=$_SESSION['count']?>]">
                                <option value="是"<?php if($qa['type']=='是'){echo'selected';}?>>是</option>
                                <option value="否"<?php if($qa['type']=='否'){echo'selected';}?>>否</option>
                            </select>
                        </div>
                        <div id="div2<?=$_SESSION['count']?>"<?php if($qa['type']!=2){echo'hidden';}?>>
                        	<?php
                            $da=explode(',',$qa['da']);
							for($i=1;$i<=4;$i++){
							?>
							<?=$i?>.<input type="text" name="da2<?=$_SESSION['count']?>[<?=$i?>]" id="da2<?=$_SESSION['count']?><?=$i?>" value="<?=$da[$i-1]?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php
							}
							?>
                            正確答案:
                            <select class="corrext" id="correct<?=$_SESSION['count']?>" name="correct2[<?=$_SESSION['count']?>]">
                                <option value="1"<?php if($_POST['correct'] == $da[0]){echo'selected';}?>>1</option>
                                <option value="2"<?php if($_POST['correct'] == $da[1]){echo'selected';}?>>2</option>
                                <option value="3"<?php if($_POST['correct'] == $da[2]){echo'selected';}?>>3</option>
                                <option value="4"<?php if($_POST['correct'] == $da[3]){echo'selected';}?>>4</option>
                            </select>
                        </div>
                        <div id="div3<?=$_SESSION['count']?>"<?php if($qa['type']!=3){echo'hidden';}?>>
                            <input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                            <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><br/>
                            <?php
                            $da=explode(',',$qa['da']);
							$correct=explode(',',$qa['correct']);
							foreach($da as $key=>$val){
								if($val!=''){
									$ok='';
									$i=$key+1;
									echo '<label class="lb3'.$_SESSION['count'].$i.'">'.$i.'.<input type="text" name="da3'.$_SESSION['count'].'['.$i.']" id="da3'.$_SESSION['count'].$i.'" value="'.$val.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確答案';
									foreach($correct as $key1=>$val1){
										if($val1!=''){
											if($val == $val1){
												echo '<input class="corrext" type="checkbox" name="correct3'.$_SESSION['count'].'['.$i.']" id="correct3'.$_SESSION['count'].$i.'" vlaue="'.$i.'" checked><br/></label>';
												$ok='true';
											}
										}
									}
									if($ok==''){
										echo '<input class="corrext" type="checkbox" name="correct3'.$_SESSION['count'].'['.$i.']" id="correct3'.$_SESSION['count'].$i.'" vlaue="'.$i.'"><br/></label>';
									}
								}
							}
							?>
                            <input type="hidden" name="number[<?=$_SESSION['count']?>]" id="number<?=$_SESSION['count']?>" value="<?=$i?>">
                        </div>
                        <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>" value="<?=$qa['type']?>">
                    </td>
                </tr>
            </table>
			<?php
			}
			?>
            <input type="hidden" name="p" id="p" value="<?=$_SESSION['count']?>">
            
            <label class="t">作答時間<input type="text" id="time1" name="time1" value="<?=$text['time1']?>" max="60" min="10">秒</label><br/>
            <label class="t">統計觀看時間<input type="text" id="time2" name="time2" value="<?=$text['time2']?>" max="60" min="10">秒</label><br/>
            
            <input type="submit" name="ok" value="編輯完成" class="sub">
            <input type="submit" name="ok" value="稍後再編輯" class="sub">
            <input type="hidden" name="id" value="<?=$id?>">
        </form>
        
    </h1></center>
</body>
</html>