<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<?php
	include("cd.php");
	include("login.php");
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
				$("#number"+count).val('4');
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
        新增試卷<p/>
        
        <input type="button" value="新增題目" onClick="topic()" class="btn">
        
        <form method="post" action="add.php" id="sub">
        	<input type="hidden" name="p" id="p" value="<?=$_SESSION['count']?>"><p/>
            
            <input type="submit" name="ok" value="編輯完成" class="sub" hidden>
            <input type="submit" name="ok" value="稍後編輯" class="sub" hidden>
        </form>
        
    </h1></center>
</body>
</html>