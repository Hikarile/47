<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js"></script>
<script>
	var n="";
	$(function(){
		num();
	})
	
	function num(){
		n++;
		$.ajax({
			url:"number.php",
			success: function(d){
				if(n==1){
					da=d.split(',').sort();
					
					$("#da").val(da[1]+da[2]+da[3]+da[4]);
					$("#number").val('');
					
					$("#a1").attr('src','png/'+da[1]+".png");
					$("#a2").attr('src','png/'+da[2]+".png");
					$("#a3").attr('src','png/'+da[3]+".png");
					$("#a4").attr('src','png/'+da[4]+".png");
				}else{
					n=0;
					da=d.split(',').sort().reverse();
					
					$("#da").val(da[0]+da[1]+da[2]+da[3]);
					$("#number").val('');
					
					$("#a1").attr('src','png/'+da[0]+".png");
					$("#a2").attr('src','png/'+da[1]+".png");
					$("#a3").attr('src','png/'+da[2]+".png");
					$("#a4").attr('src','png/'+da[3]+".png");
				}
			}
		})
	}
	function up(ev,n){
		if(n==1){
			ev.dataTransfer.setData('text',da[n]);
		}else{
			ev.dataTransfer.setData('text',da[n-1]);
		}
	}
</script>
</head>
<?php
	include("cd.php");
	
	if($_POST['ok']){
		if($_POST['ac']=='admin'){
			if($_POST['ps']=='1234'){
				if($_POST['number']==$_POST['da']){
					
					$_SESSION['dnlu']='ttt';
					header("location:ad_m.php");
					
				}else{
					echo'<script>alert("驗證碼錯誤")</script>';
				}
			}else{
				echo'<script>alert("密碼錯誤")</script>';
			}
		}else{
			echo'<script>alert("帳號錯誤")</script>';
		}
	}
?>
<body bgcolor="#6699FF">
	<center><h1>
    	網站管理
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
        
        <?php
        if($_SESSION['dnlu']!=''){
		?><input type="button" value="登出" onClick="location.href='out.php'"><?php
		}else{
		?>
		<form method="post">
        	帳號:<input type="text" name="ac"><br/>
            密碼:<input type="password" name="ps"><br/>
            <input type="button" value="產生驗證碼" onClick="num()">
            <div style="width:230px; height:55px;">
            	<img id="a1" style="width:50px; height:50px;" draggable="true" ondragstart="up(event,1)">
                <img id="a2" style="width:50px; height:50px;" draggable="true" ondragstart="up(event,2)">
                <img id="a3" style="width:50px; height:50px;" draggable="true" ondragstart="up(event,3)">
                <img id="a4" style="width:50px; height:50px;" draggable="true" ondragstart="up(event,4)">
            </div>
            <input type="hidden" name="da" id="da">
            <input type="text" name="number" id="number"><br/>
            
            <input type="submit" name="ok" value="確定">
        </form>
		<?php
		}
		?>
        
    </h1></center>
</body>
</html>