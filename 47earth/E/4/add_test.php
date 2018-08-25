<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	include("login.php");
	$_SESSION['count']=0;
?>
<style>
	.box1{
		position:absolute;
		top:20px;
		right:20px;
	}
	.box2{
		width:500px;
		height:250px;
		border:#F96 solid 3px;
		background-color:#FC6;
		padding-top:20px;
	}
	.out{
		border:#F90 solid 3px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#FFFF99;
	}
	.sub{
		border:#36F solid 2px;
		width:130px;
		height:50px;
		font-size:20px;
		background-color:#69F;
		border-radius:15px;
	}
	.btn{
		width:130px;
		height:50px;
		border:#F93 solid 5px;
		background-color: #FC3;
		font-size:20px;
	}
	.btn:hover{
		background-color:#F60;
	}
	.sub:hover{
		background-color:#06F;
	}
	.out:hover{
		background-color:#F93
	}
	.q{
		max-width:90%;
		min-width:90%;
		height:150px;
		font-size:30px;
	}
	.correct{
		width:50px;
		height:45px;
		font-size:23px;
	}
</style>
<script src="jquery.js"></script>
<script>
	$(function(){
		$(document).on('click','input[type="radio"]',function(){
			var count=$(this).attr('count');
			var date=$(this).attr('date');
			for(i=1;i<=4;i++){
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
				for(i=1;i<=8;i++){
					$("#lb3"+count+i).remove();
				}
				for(i=1;i<=4;i++){
					var da='<label id="lb3'+count+i+'">'+i+'.<input type="text"  name="da3'+count+'['+i+']" id="da3'+count+i+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確解答<input class="correct" type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" value="'+i+'"><br/></label>';
					$("#number"+count).before(da);
				}
			}
		})
		
		$("#sub").submit(function(){
			var ii=$("#p").val();
			for(i=1;i<=ii;i++){
				if($("#type"+i).val()==''){
					alert("第"+i+"題的題型未選擇");
					return false;
				}
				if($("#q"+i).val()==''){
					alert("第"+i+"題的題目未填");
					return false;
				}
				
				if($("#type"+i).val() == '2'){
					for(j=1;j<=4;j++){
						if($("#da2"+i+j).val()==''){
							alert("第"+i+"題第"+j+"個答案未填");
							return false;
						}
					}
				}
				if($("#type"+i).val() == '3'){
					var ok=0;
					var jj=$("#number"+i).val();
					for(j=1;j<=4;j++){
						if($("#da3"+i+j).val()==''){
							alert("第"+i+"題第"+j+"個答案未填");
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
		$(".t").removeAttr('hidden');
		$(".sub").removeAttr('hidden');
	}
	function add(count){
		var i=$("#number"+count).val();
		if(i<8){
			i++;
			$("#number"+count).val(i);
			var da='<label id="lb3'+count+i+'">'+i+'.<input type="text"  name="da3'+count+'['+i+']" id="da3'+count+i+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正確解答<input class="correct" type="checkbox" name="correct3'+count+'['+i+']" id="correct3'+count+i+'" value="'+i+'"><br/></label>';
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
	<center><h1>
    	新增試卷<p/>
        <div class="box1"><input type="button" value="返回" onClick="location.href='menu.php'" class="out"></div>
        
        <input type="button" value="新增題目" onClick="topic()" class="btn"><p/>
        
        <form method="post" action="add.php" id="sub">
        	<input type="hidden" name="p" id="p" value="0"><p/>
            
            <label class="t" hidden>作答時間<input type="number" name="time1" id="time1" value="20" max="60" min="10">秒</label><br/>
            <label class="t" hidden>統計觀看時間<input type="number" name="time2" id="time2" value="20" max="60" min="10">秒</label><br/>
            
            <input type="submit" name="ok" value="編輯完成" class="sub" hidden>
            <input type="submit" name="ok" value="稍後編輯" class="sub" hidden>
        </form>
        
    </h1></center>
</body>
</html>