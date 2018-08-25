<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$("#aa").change(function(){
			var aa=$("#aa").val();
			if(aa<=-1){
				$("#aa").val(0);
				alert("不可為負數");
				return false;
			}else if(aa >= 6){
				$("#aa").val(5);
				alert("超過上限");
				return false;
			}else{
				$(".p").remove();
				$.ajax({
					url:"png.php",
					type:"POST",
					data:{aa:aa},
					success: function(pp){
						$("#hi").after(pp);
					}
				})
			}
		})
	})
</script>
</head>
<?php
	include("include.php");
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		$ey=$_POST['ey'];
		$py=$_POST['py'];
		$aa=$_POST['aa'];
		function check($name,$phone,$email,$text,$number) {
			if($name == ""){
				return "<script>alert('姓名未填')</script>";
			}
			if($phone == ""){
				return "<script>alert('電話未填')</script>";
			}
			if($email == ""){
				return "<script>alert('E_MAIL未填')</script>";
			}
			if($text == ""){
				return "<script>alert('內容未填')</script>";
			}
			if($number == ""){
				return "<script>alert('序號未填')</script>";
			}
			return '';
		}
		$a = check($name,$phone,$email,$text,$number);
		
		if($a == '') {
			$time=date("Y-m-d h:i:s");
			$mysql->query("INSERT INTO `message` (`name`, `email`, `phone`, `text`, `number`, `py`, `ey`, `time`) VALUES ('$name', '$email', '$phone', '$text', '$number', '$py', '$ey', '$time')");
			$id=mysqli_insert_id($mysql);
			
			for($i=1;$i<=$aa;$i++){	
				if($_FILES['png'.$i]['name']!=""){
					move_uploaded_file($_FILES['png'.$i]['tmp_name'],'file/'.$_FILES['png'.$i]['name']);//複製檔案
					$mysql->query("INSERT INTO `png` (`mid`, `png`) VALUES ('$id', '".$_FILES['png'.$i]['name']."')");
				}
			}
			header("location:message.php");	
			exit;
		} else {
			echo $a;
		}
	}
?>
<body bgcolor="#6699FF">
	
    <center><h1>
    	新增留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data">
			<table width="35%">
                <tr>
                    <th bgcolor="#999999">姓名:</th>
                    <th><input type="text" name="name"></th>
                </tr>
                <tr>
                    <th bgcolor="#999999">電話:</th>
                    <th><input type="tel" name="phone" pattern="[0]{1}[0-9]{9}|[02]{2}[/-][0-9]{8}"></th>
                    <th><input type="checkbox" name="py" value="1" checked>顯示</th>
                </tr>
                <tr>
                    <th bgcolor="#999999">E_MAIL:</th>
                    <th><input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$"></th>
                    <th><input type="checkbox" name="ey" value="1" checked>顯示</th>
                </tr>
                <tr>
                	<th bgcolor="#999999">要上傳幾張圖片</th>
                    <th><input type="number" name="aa" id="aa"></th>
                </tr>
                <input type="hidden" id="hi" name="hi">
                <tr>
                    <th bgcolor="#999999">內容:</th>
                    <th><input type="text" name="text"></th>
                </tr>
                <tr>
                    <th bgcolor="#999999">序號:</th>
                    <th><input type="tel" name="number" pattern="[A-Za-z]{3}\d{3}"></th>
                </tr>
                <tr>
                	<th colspan="3">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="重置" onClick="location.href='messageadd.php'">
                    </th>
                </tr>
            </table>
        </form>
    </h1></center>
    
</body>
</html>