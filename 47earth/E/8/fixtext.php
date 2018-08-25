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
	
	$_SESSION['count']=0;
?>
<style>
	.box1{
		width:400px;
		height:300px;
		border:#F60 solid 3px;
		background-color:#F90;
		padding:20px;
		margin:20px;
	}
	.sub{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#F90;
		border-radius:20px;
		font-size:23px;
	}
	.sub:hover{
		background-color:#F63;
	}
	.out{
		width:150px;
		height:60px;
		border:#F63 solid 3px;
		background-color:#FF9;
		font-size:23px;
	}
	.out:hover{
		background-color:#F90;
	}
	.btn{
		width:150px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:23px;
	}
	.btn:hover{
		background-color:#39F;
	}
	.text{
		width:150px;
		height:30px;
		font-size:23px;
	}
	.correct{
		width:40px;
		height:40px;
		font-size:15px;
	}
</style>
<script src="jquery.js"></script>
<script>
	$(function(){
		$(document).on('click','input[type=radio]',function(){
			var count=$(this).attr('count');
			var date=$(this).attr('date');
			$("#type"+count).val(date);
			for(i=1;i<=3;i++){
				$(".div"+i+count).attr('hidden','hidden');
			}
			
			if(date==1){
				$(".div1"+count).removeAttr('hidden');
			}
			if(date==2){
				$(".div2"+count).removeAttr('hidden');
				for(j=1;j<=4;j++){
					$("#da2"+count+j).val('');
				}
			}
			if(date==3){
				$(".div3"+count).removeAttr('hidden');
				for(k=1;k<=8;k++){
					$("#label3"+count+k).remove();
				}
				
				for(j=1;j<=4;j++){
					var da='<label class="label" id="label3'+count+j+'">'+j+'.<input class="text" type="text" name="da3'+count+'['+j+']" id="da3'+count+j+'">&nbsp;&nbsp;&nbsp;正確答案:<input type="checkbox" id="correct3'+count+j+'" name="correct3'+count+'['+j+']" class="correct" value="'+j+'"><br/></label>';
					$("#number"+count).before(da);
				}
				
			}
		})
		
		$("#sub").submit(function(){
			var p=$("#p").val();
			for(count=1;count<=p;count++){
				if($("#type"+count).val()==''){
					alert('第'+count+'題的題型未填');
					return false;
				}
				if($("#q"+count).val()==''){
					alert('第'+count+'題的題目未填');
					return false;
				}
				
				if($("#type"+count).val() == '2'){
					for(i=1;i<=4;i++){
						if($("#da2"+count+i).val()==''){
							alert('第'+count+'題第'+i+'題答案未填');
							return false;
						}
					}
				}
				if($("#type"+count).val() == '3'){
					var ok=0;
					var ii=$("#number"+count).val();
					for(i=1;i<=ii;i++){
						if($("#da3"+count+i).val()==''){
							alert('第'+count+'題第'+i+'題答案未填');
							return false;
						}
					}
					$("#number"+count).val('4');
				}
				
				if($("#t1"+count).val()==''){
					alert('第'+count+'題的作答時間未填');
					return false;
				}
				if($("#t2"+count).val()==''){
					alert('第'+count+'題的統計觀看時間未填');
					return false;
				}
			}
		})
	})
	function topic(){
		$.ajax({
			url:"topic.php",
			success: function(da){
				$("#p").before(da);
			}
		})
		var p=$("#p").val();
		p++;
		$("#p").val(p);
		
		$(".sub").removeAttr('hidden');
	}
	function add(count){
		var j=$("#number"+count).val();
		if(j<8){
			j++;
			var da='<label class="label" id="label3'+count+j+'">'+j+'.<input class="text" type="text" name="da3'+count+'['+j+']" id="da3'+count+j+'">&nbsp;&nbsp;&nbsp;正確答案:<input type="checkbox" id="correct3'+count+j+'" name="correct3'+count+'['+j+']" class="correct" value="'+j+'"><br/></label>';
			$("#number"+count).before(da);
			$("#number"+count).val(j);
		}
	}
	function d(count){
		var j=$("#number"+count).val();
		if(j>2){
			$("#label3"+count+j).remove();
			j--;
			$("#number"+count).val(j);
		}
	}
</script>
</head>

<body bgcolor="#FFFF99">
	<input type="button" value="返回" onClick="location.href='menu.php'" class="out">
    <center><h1>
        修改試卷<p/>
        
        <input type="button" value="新增題目" onClick="topic()" class="btn">
        
        <form method="post" action="fix.php" id="sub">
        	<?php
			$q=$mysql->query("SELECT * FROM `qa` where `textid` = '$id'");
			while($qa=mysqli_fetch_array($q)){
				$_SESSION['count']++;
			?>
			<table width="80%" border="1" bgcolor="#FF9900">
                <tr>
                    <th width="15%"><?=$_SESSION['count']?></th>
                    <td>
                        問題題型:<br/>
                        <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="1" class="correct" <?php if($qa['type'] == '1'){echo'checked';}?>>是非題</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="2"class="correct" <?php if($qa['type'] == '2'){echo'checked';}?>>單選題</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="label"><input type="radio" name="type[<?=$_SESSION['count']?>]" count="<?=$_SESSION['count']?>" date="3"class="correct" <?php if($qa['type'] == '3'){echo'checked';}?>>多選題</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p/>
                        
                        問題題目:<br/>
                        <textarea style="width:80%; height:100px; font-size:23px;" name="q[<?=$_SESSION['count']?>]" id="q<?=$_SESSION['count']?>"><?=$qa['q']?></textarea><p/>
                        
                        問題答案:<br/>
                        <div class="div1<?=$_SESSION['count']?>" <?php if($qa['type'] != '1'){echo'hidden';}?>>
                            <label class="label">1.是</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="label">2.否</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="label">
                                正確答案:
                                <select name="correct1<?=$_SESSION['count']?>" class="correct">
                                    <option value="是" <?php if($qa['correct'] == '是'){echo'selected';}?>>是</option>
                                    <option value="否" <?php if($qa['correct'] == '否'){echo'selected';}?>>否</option>
                                </select>
                            </label>
                        </div>
                        <div class="div2<?=$_SESSION['count']?>" <?php if($qa['type'] != '2'){echo'hidden';}?>>
                        	<?php
                            $da=explode(',',$qa['da']);
							?>
                            <label class="label">1.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[1]" id="da2<?=$_SESSION['count']?>1" value="<?=$da[0]?>"></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="label">2.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[2]" id="da2<?=$_SESSION['count']?>2" value="<?=$da[1]?>"></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="label">3.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[3]" id="da2<?=$_SESSION['count']?>3" value="<?=$da[2]?>"></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="label">4.<input class="text" type="text" name="da2<?=$_SESSION['count']?>[4]" id="da2<?=$_SESSION['count']?>4" value="<?=$da[3]?>"></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                            <label class="label">
                                正確答案:
                                <select name="correct2<?=$_SESSION['count']?>" class="correct">
                                    <option value="1" <?php if($qa['correct'] == $da[0]){echo'selected';}?>>1</option>
                                    <option value="2" <?php if($qa['correct'] == $da[1]){echo'selected';}?>>2</option>
                                    <option value="3" <?php if($qa['correct'] == $da[2]){echo'selected';}?>>3</option>
                                    <option value="4" <?php if($qa['correct'] == $da[3]){echo'selected';}?>>4</option>
                                </select>
                            </label>
                        </div>
                        <div class="div3<?=$_SESSION['count']?>" <?php if($qa['type'] != '3'){echo'hidden';}?>>
                            <input type="button" value="新增答案" onClick="add(<?=$_SESSION['count']?>)">
                            <input type="button" value="刪除答案" onClick="d(<?=$_SESSION['count']?>)"><p/>
                            
                            <?php
							$da=explode(',',$qa['da']);
							$correct=explode(',',$qa['correct']);
							$i=0;
							foreach($da as $key => $val){
								if($val!=''){
								$i++;
							?>
							<label class="label" id="label3<?=$_SESSION['count']?><?=$i?>"><?=$i?>.<input class="text" type="text" name="da3<?=$_SESSION['count']?>[<?=$i?>]" id="da3<?=$_SESSION['count']?><?=$i?>" value="<?=$val?>">
                            &nbsp;&nbsp;&nbsp;
                            <?php
									$ok=0;
									foreach($correct as $key1 => $val1){
										if($val1 !='' && $val == $val1){
											$ok++;
											?>
											正確答案:<input type="checkbox" id="correct3<?=$_SESSION['count']?><?=$i?>" name="correct3<?=$_SESSION['count']?>[<?=$i?>]" class="correct" value="<?=$i?>" checked><br/></label>
											<?php
										}
									}
									if($ok==0){
									?>
                                    正確答案:<input type="checkbox" id="correct3<?=$_SESSION['count']?><?=$i?>" name="correct3<?=$_SESSION['count']?>[<?=$i?>]" class="correct" value="<?=$i?>"><br/></label>
                                    <?php
									}
								}
							}
							?>
                            
                            <input type="hidden" value="<?=$i?>" id="number<?=$_SESSION['count']?>" name="number<?=$_SESSION['count']?>">
                        </div><p/>
                        
                       <label class="label">作答時間<input class="text" type="number" name="t1[<?=$_SESSION['count']?>]" id="t1<?=$_SESSION['count']?>" value="<?=$qa['t1']?>" min="0">秒</label><br/>
                       <label class="label">統計觀看時間<input class="text" type="number" name="t2[<?=$_SESSION['count']?>]" id="t2<?=$_SESSION['count']?>" value="<?=$qa['t2']?>" min="0">秒</label>
                        
                       <input type="hidden" name="type[<?=$_SESSION['count']?>]" id="type<?=$_SESSION['count']?>" value="<?=$qa['type']?>">
                    </td>
                </tr>
            </table>
			<?php
			}
			?>
        	<input type="hidden" name="p" id="p" value="<?=$_SESSION['count']?>"><p/>
            <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
            <input type="submit" name="ok" value="編輯完成" class="sub">
            <input type="submit" name="ok" value="稍後編輯" class="sub">
        </form>
        
    </h1></center>
</body>
</html>