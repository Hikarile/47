<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	
	if($_POST['out']){
		session_destroy();
		header("location:admin.php");
	}
	
	$t=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($t);
?>
<style>
	.box1{
		display: inline-block;
	}
	.box2{
		width:450px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
	}
	.out{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FF9;
		font-size:25px;
	}
	.sub{
		width:150px;
		height:70px;
		border:#F60 solid 3px;
		background-color:#FC3;
		font-size:25px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:70px;
		border:#36F solid 3px;
		background-color:#69F;
		font-size:25px;
		border-radius:20px;
	}
	.btn:hover{
		background-color:#06F;
	}
	.sub:hover{
		background-color:#F96;
	}
	.out:hover{
		background-color:#F90;
	}
	
	.t{
		width:200px;
		height:30px;
		font-size:23px;
	}
	.correct{
		width:45px;
		height:35px;
		font-size:23px;
	}
	.q{
		max-width:90%;
		min-width:90%;
		max-height:150px;
		min-height:150px;
		font-size:25px;
	}
	@media screen and (max-width: 600px){
		.labelXD{
			display: block;
			font-size: 80%;
		}
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
			
			if(date == '1'){
				$("#type"+count).val(date);
				$("#div1"+count).removeAttr('hidden');
			}
			if(date == '2'){
				$("#type"+count).val(date);
				$("#div2"+count).removeAttr('hidden');
				for(i=1;i<=4;i++){
					$("#da2"+count+i).val('');
				}
			}
			if(date == '3'){
				$("#type"+count).val(date);
				$("#div3"+count).removeAttr('hidden');
				for(i=1;i<=8;i++){
					$("#lb3"+count+i).remove();
				}
				for(i=1;i<=4;i++){
					var da='<label class="labelXD" id="lb3'+count+i+'">'+i+'.<input type="text" name="da3'+count+'['+i+']" id="da3'+count+i+'" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label class="labelXD">正確答案<input type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" class="correct" value="'+i+'"><br/></label>';
					$("#number"+count).before(da);
				}
				$("#number"+count).val(4);
			}
		})
		
		$("#sub").submit(function(){
			var p=$("#p").val();
			for(i=1;i<=p;i++){
				if($("#type"+i).val()==''){
					alert("第"+i+"題的題型未選擇");
					return false;
				}
				if($("#q"+i).val()==''){
					alert("第"+i+"題的題目未填");
					return false;
				}
				
				if($("#type"+i).val()=='2'){
					for(j=1;j<=4;j++){
						if($("#da2"+i+j).val()==''){
							alert("第"+i+"題的第"+j+"個答案未填");
							return false;
						}
					}
				}
				if($("#type"+i).val()=='3'){
					var ok=0;
					var jj=$("#number"+i).val();
					for(j=1;j<=jj;j++){
						if($("#da3"+i+j).val()==''){
							alert("第"+i+"題的第"+j+"個答案未填");
							return false;
						}
						if($("#correct3"+i+j).prop('checked')==true){
							ok++;
						}
					}
					if(ok==0){
						alert("第"+i+"題的正確答案未填");
						return false;
					}
				}
				if($("#time1"+i).val()==''){
					alert("第"+i+"題的作答時間未填");
					return false;
				}
				if($("#time2"+i).val()==''){
					alert("第"+i+"題的統計觀看時間未填");
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
		$(".time").removeAttr('hidden');
		$(".sub").removeAttr('hidden');
	}
	function add(count){
		var i=$("#number"+count).val();
		if(i<8){
			i++;
			$("#number"+count).val(i);
			var da='<label class="labelXD" id="lb3'+count+i+'">'+i+'.<input type="text" name="da3'+count+'['+i+']" id="da3'+count+i+'" class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label class="labelXD">正確答案<input type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" class="correct" value="'+i+'"><br/></label>';
			$("#number"+count).before(da);
		}
	}
	function d(count){
		var i=$("#number"+count).val();
		if(i>2){
			$("#lb3"+count+i).remove();
			i--;
			$("#number"+count).val(i);
		}
	}
</script>
</head>

<body bgcolor="#FFFF99">
<div class="box1"><input type="submit" name="out" value="返回" onClick="location.href='menu.php'" class="out"></div>
	<center><h1>
    	修改試卷<p/>
        
        <input type="button" value="新增題目" onClick="topic()" class="sub"><p/>
        
        <form method="post" action="fix.php" id="sub">
        	<?php
			$_SESSION['count']=0;
            $q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
			while($qa=mysqli_fetch_array($q)){
			$_SESSION['count']++;
			?>
			<table width="80%" height="150px" bgcolor="#FF9900" border="1">
                <tr>
                    <th width="15%"><?=$_SESSION['count']?></th>
                    <td>
                        問題題型:<br/>
                        <label class="labelXD"><input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1"<?php if($qa['type']=='1'){echo' checked';}?>>是非題</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <label class="labelXD"> <input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2"<?php if($qa['type']=='2'){echo' checked';}?>>單選題</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="labelXD"><input class="correct" type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3"<?php if($qa['type']=='3'){echo' checked';}?>>多選題</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <p/>
                        
                        問題題目:<br/>
                        <textarea class="q" name="q[<?=$_SESSION['count']?>]" id="q<?=$_SESSION['count']?>"><?=$qa['q']?></textarea>
                        <p/>
                        
                        問題答案:<br/>
                        <div id="div1<?=$_SESSION['count']?>"<?php if($qa['type']!='1'){echo' hidden';}?>>
                            <label class="labelXD">1.是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class="labelXD">2.否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class="labelXD">
                           		正確答案:
                                <select name="correct1[<?=$_SESSION['count']?>]" class="correct">
                                    <option value="是"<?php if($qa['correct']=='是'){echo' selected';}?>>是</option>
                                    <option value="否"<?php if($qa['correct']=='否'){echo' selected';}?>>否</option>
                                </select>
                            </label>
                        </div>
                        <div id="div2<?=$_SESSION['count']?>"<?php if($qa['type']!='2'){echo' hidden';}?>>
                            <?php
                            $da=explode(',',$qa['da']);
							?>
                            <label class="labelXD">1.<input type="text" name="da2<?=$_SESSION['count']?>[1]" id="da2<?=$_SESSION['count']?>1" class="t" value="<?=$da[0]?>"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <label class="labelXD"> 2.<input type="text" name="da2<?=$_SESSION['count']?>[2]" id="da2<?=$_SESSION['count']?>2" class="t" value="<?=$da[1]?>"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <label class="labelXD"> 3.<input type="text" name="da2<?=$_SESSION['count']?>[3]" id="da2<?=$_SESSION['count']?>3" class="t" value="<?=$da[2]?>"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <label class="labelXD"> 4.<input type="text" name="da2<?=$_SESSION['count']?>[4]" id="da2<?=$_SESSION['count']?>4" class="t" value="<?=$da[3]?>"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <br/>
                            <label class="labelXD">
                                正確答案:
                                <select name="correct2[<?=$_SESSION['count']?>]" class="correct">
                                    <option value="1"<?php if($qa['correct']==$da[0]){echo' selected';}?>>1</option>
                                    <option value="2"<?php if($qa['correct']==$da[1]){echo' selected';}?>>2</option>
                                    <option value="3"<?php if($qa['correct']==$da[2]){echo' selected';}?>>3</option>
                                    <option value="4"<?php if($qa['correct']==$da[3]){echo' selected';}?>>4</option>
                                </select>
                            </label>
                        </div>
                        <div id="div3<?=$_SESSION['count']?>"<?php if($qa['type']!='3'){echo' hidden';}?>>
                            <input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                            <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><br/>
                            <?php
                            $da=explode(',',$qa['da']);
							$correct=explode(',',$qa['correct']);
							foreach($da as $key=>$val){
								$ok='';
								if($val!=''){
									$i=$key+1;
									?>
                                    <label id="lb3<?=$_SESSION['count']?><?=$i?>"><?=$i?>.<input type="text" name="da3<?=$_SESSION['count']?>[<?=$i?>]" id="da3<?=$_SESSION['count']?><?=$i?>" class="t" value="<?=$val?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確答案
                                    <?php
									foreach($correct as $key1=>$val1){
										if($val1!='' && $val1 == $val){
										?>
                                        <input type="checkbox" name="correct3<?=$_SESSION['count']?>[<?=$i?>]" id="correct3<?=$_SESSION['count']?><?=$i?>" class="correct" value="<?=$i?>" checked><br/></label>
										<?php
										$ok='ok';
										}
									}
									if($ok==''){
									?>
                                    <input type="checkbox" name="correct3<?=$_SESSION['count']?>[<?=$i?>]" id="correct3<?=$_SESSION['count']?><?=$i?>" class="correct" value="<?=$i?>"><br/></label>
                                    <?php
									}
								}
							}
							?>
                            <input type="hidden" name="number[<?=$_SESSION['count']?>]" id="number<?=$_SESSION['count']?>" value="<?=$i?>">
                        </div>
                        
                        作答時間<input type="number" name="time1[<?=$_SESSION['count']?>]" id="time1<?=$_SESSION['count']?>" min="0" value="<?=$qa['t1']?>" class="t">秒<br/>
            			統計觀看時間<input type="number" name="time2[<?=$_SESSION['count']?>]" id="time2<?=$_SESSION['count']?>" min="0" value="<?=$qa['t2']?>" class="t">秒
                        <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>" value="<?=$qa['type']?>">
                    </td>
                </tr>
            </table>
			<?php
			}
			?>
        	<input type="hidden" name="p" id="p" value="<?=$_SESSION['count']?>"><p/>
                        
            <input type="hidden" name="id" id="id" value="<?=$id?>">
            
            <input type="submit" name="ok" value="編輯完成" class="sub">
            <input type="submit" name="ok" value="稍後編輯" class="sub">
        </form>
        
	</h1></body>
</body>
</html>
