<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
	.b{
		width:10%;
		height:50px;
		font-size:30px;
	}
	.bb{
		width:10%;
		height:50px;
		font-size:30px;
		background-color:#6C9;
	}
	.p1 {
		width:40%;
		border-radius:20%;
		animation-name:p1;
		animation-duration:1.5s;
	}
	@keyframes p1 {
		from {
			transform: scaleX(1.5);
			
		}
		to {
			transform: scaleX(1);
			
		}
	}
	.p2 {
		width:40%;
		border-radius:20%;
		animation-name:p2;
		animation-duration:1.5s;
	}
	@keyframes p2 {
		from {
			transform: rotate(0deg);
			
		}
		to {
			transform: rotate(360deg);
			
		}
	}
	.p3 {
		width:40%;
		border-radius:20%;
		animation-name:p3;
		animation-duration:1.5s;
	}
	@keyframes p3 {
		from {
			transform: skewX(0deg);
			
		}
		to {
			transform: skewX(180deg);
			
		}
	}
	.p4 {
		width:40%;
		border-radius:20%;
		animation-name:p4;
		animation-duration:1.5s;
	}
	@keyframes p4 {
		from {
			transform: translateX(500px);
			
		}
		to {
			transform: translateX(0px);
			
		}
	}
	.p5 {
		width:40%;
		border-radius:20%;
		animation-name:p5;
		animation-duration:1.5s;
	}
	@keyframes p5 {
		from {
			transform: scaleY(0);
			
		}
		to {
			transform: scaleY(1);
			
		}
	}
</style>
<script src="jquery.js"></script>
<script>
now="";
end="";
function o(i){
	$("#p1").hide();
	$("#p2").hide();
	$("#p3").hide(); 
	$("#p4").hide();
	$("#p5").hide();

	$('#b1').attr('class','b');
	$('#b2').attr('class','b');
	$('#b3').attr('class','b');
	$('#b4').attr('class','b');
	$('#b5').attr('class','b');
	$('#b6').attr('class','b');

	
	$("#p"+i).show();
	$("#b"+i).attr('class','bb');
}

function asdasdf(){
	www="";
	www=Math.floor(Math.random()*5) + 1;
	now=www;
	if(now==end){
		asdasdf()
	}else{
		end=www;
	}
	o(www);
}

function body_load(){
	asdasdf();
	setInterval("asdasdf()","2000");
}

</script>
<title>無標題文件</title>
</head>
<?php
	include("cd.php");
?>
<body onLoad="body_load();" class="load" bgcolor="#6699FF">
	<center><h1>
        <table border="1" width="80%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訪客訂餐" onClick="location.href='f.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px" type="button" value="套餐管理" onClick="location.href='menu.php'"></th>
            </tr>
        </table>
		<?php
		}
		?><p/>
        <img class="p1" id="p1" src="Sample Pictures/Jellyfish.jpg" hidden>
        <img class="p2" id="p2" src="Sample Pictures/Penguins.jpg" hidden>
        <img class="p3" id="p3" src="Sample Pictures/Desert.jpg" hidden>
        <img class="p4" id="p4" src="Sample Pictures/Koala.jpg" hidden>
        <img class="p5" id="p5" src="Sample Pictures/Lighthouse.jpg" hidden><p/>
        
        <input class="b" id="b1" type="button" value="水母" onClick="o(1)">
        <input class="b" id="b2" type="button" value="企鵝" onClick="o(2)">
        <input class="b" id="b3" type="button" value="沙漠" onClick="o(3)">
        <input class="b" id="b4" type="button" value="無尾熊" onClick="o(4)">
        <input class="b" id="b5" type="button" value="燈塔" onClick="o(5)">
        
    </h1></center>
</body>
</html>