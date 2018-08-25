<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js"></script>
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
	include("cd.php");
	
	if($_POST['ok']){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$ey=$_POST['ey'];
		$py=$_POST['py'];
		$text=$_POST['text'];
		$number=$_POST['number'];
		
		function aa($name,$email,$phone,$text,$number){
			if($name==''||$email==''||$phone==''||$text==''||$number==''){
				return '<script>alert("未填寫完成")</script>';
			}else{
				return $a='';
			}
		}
		$a=aa($name,$email,$phone,$text,$number);
		
		if($a==''){
			$time=date("Y/m/d H:i:s");
			$mysql->query("INSERT INTO `message` (`name`, `email`, `phone`, `ey`, `py`, `text`, `number`, `time`) VALUES ('$name', '$email', '$phone', '$ey', '$py', '$text', '$number', '$time')");
			
			$id=mysqli_insert_id($mysql);
			
			for($i=1;$i<=$_POST['aa'];$i++){
				if($_FILES['png'.$i]['name']!=''){
					move_uploaded_file($_FILES['png'.$i]['tmp_name'],'file/'.$_FILES['png'.$i]['name']);
					$mysql->query("INSERT INTO `png` (`mid`, `png`) VALUES ('$id', '".$_FILES['png'.$i]['name']."')");
				}
			}
			header("location:message.php");
		}else{
			echo $a;
		}
	}
	
?>
<body bgcolor="#6699FF">
	<center><h1>
    	
        新增留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data">
        	<table width="30%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">姓名</th>
                    <td><input type="text" name="name" value="<?=$_POST['name']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">E_MAIL</th>
                    <td>
                    	<input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$" value="<?=$_POST['email']?>">
                        <input type="checkbox" name="ey" value="1"<?php if($_POST['ey']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">電話</th>
                    <td>
                    	<input type="tel" name="phone" pattern="[0-9]+|[0-9]+[/-]+[0-9]+" value="<?=$_POST['phone']?>">
                        <input type="checkbox" name="py" value="1"<?php if($_POST['py']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC">要上傳幾張圖片</th>
                    <td><input type="number" name="aa" id="aa"></td>
                </tr>
                <input type="hidden" id="hi" name="hi">
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">內容</th>
                    <td><input type="text" name="text" value="<?=$_POST['text']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">留言序號</th>
                    <td><input type="tel" name="number" pattern="[A-Za-z]{3}[0-9]{3}" value="<?=$_POST['number']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="submit" name="ok" value="確定">
                        <input type="reset" value="重設">
                    </th>
                </tr>
            </table>
        </form>
        
        
    </h1></center>
</body>
</html>