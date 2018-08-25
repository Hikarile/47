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
    	新增試卷<p/>
        <div class="box1"><input type="button" value="返回" class="out" onClick="location.href='menu.php'"></div>
        <input type="button" value="新增題目" onClick="topic()" class="out"><p/>
        
        <form method="post" action="add.php" id="sub">
            <input type="hidden" name="p" id="p" value="0">
            
            <label class="t" hidden>作答時間<input type="text" id="time1" name="time1" value="20" max="60" min="10">秒</label><br/>
            <label class="t" hidden>統計觀看時間<input type="text" id="time2" name="time2" value="20" max="60" min="10">秒</label><br/>
            
            <input type="submit" name="ok" value="編輯完成" class="sub" hidden>
            <input type="submit" name="ok" value="稍後再編輯" class="sub" hidden>
        </form>
        
    </h1></center>
</body>
</html>