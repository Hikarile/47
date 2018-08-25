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
	
	if($_POST['out']){
		session_destroy();
		header("location:admin.php");
	}
	
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
	.hidden{
		display:none;
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
				
				if($("#time1").val()==''){
					alert("作答時間未填");
					return false;
				}
				if($("#time2").val()==''){
					alert("統計觀看時間未填");
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
		$(".hidden").addClass('labelXD');
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
    	新增試卷<p/>
        
        <input type="button" value="新增題目" onClick="topic()" class="sub"><p/>
        
        <form method="post" action="add.php" id="sub">
        	<input type="hidden" name="p" id="p" value="0"><p/>
            
            <label class="hidden">作答時間<input type="number" name="time1" id="time1" max="60" min="10" value="20" class="t">秒</label><br/>
            <label class="hidden">統計觀看時間<input type="number" name="time2" id="time2" max="60" min="10" value="20" class="t">秒</label><br/>
            
            <input type="submit" name="ok" value="編輯完成" class="sub" hidden>
            <input type="submit" name="ok" value="稍後編輯" class="sub" hidden>
        </form>
        
	</h1></body>
</body>
</html>