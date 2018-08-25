<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js"></script>
<script>
	$(function(){
		$("#su").submit(function(){
			ii=$("#p").val();
			for(i=1;i<=ii;i++){
				if($("[name='p"+i+"']").attr('d')==1){
					id=$("[name='p"+i+"']").attr('id');
					$.ajax({
						url:"pngd.php",
						type:"POST",
						data:{id:id},
					})
				}
			}
		})
		$("#aa").change(function(){
			var aa=$("#aa").val();
			var ii=$("#hi").val();
			if(aa<=-1){
				$("#aa").val(0);
				alert("不可為負數");
				return false;
			}else if(parseInt(aa)+parseInt(ii) >= 6){
				$("#aa").val(aa-1);
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
	function pd(i){
		$("#"+i).hide();
		$("[name='pd"+i+"']").hide();
		$("#"+i).attr('d',1);
		ii=$("#hi").val();
		ii-=1;
		$("#hi").val(ii);
	}
</script>
</head>
<?php
	include("cd.php");
	
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `message` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	$bb=$mysql->query("SELECT * FROM `png` where `mid` = '$id'");
	
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
			$mysql->query("UPDATE `message` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `ey` = '$ey', `py` = '$py', `text` = '$text', `number` = '$number', `ftime` = '$time' WHERE `message`.`id` = '$id'");
			
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
    	
        修改留言<input type="button" value="返回" onClick="location.href='message.php'"><p/>
        
        <form method="post" enctype="multipart/form-data" id="su">
        	<table width="30%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="50%">姓名</th>
                    <td><input type="text" name="name" value="<?=$a['name']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">E_MAIL</th>
                    <td>
                    	<input type="tel" name="email" pattern="^[\w]+@+[\w]+.+[\w]+$" value="<?=$a['email']?>">
                        <input type="checkbox" name="ey" value="1"<?php if($a['ey']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">電話</th>
                    <td>
                    	<input type="tel" name="phone" pattern="[0-9]+|[0-9]+[/-]+[0-9]+" value="<?=$a['phone']?>">
                        <input type="checkbox" name="py" value="1"<?php if($a['py']==1){echo'checked';}?>>顯示
                    </td>
                </tr>
                <?php
				$ii=0;
				while($b=mysqli_fetch_array($bb)){
				$ii++;
                if($b['png']!=''){
				?>
				<tr>
                	<th colspan="2">
                    	<img width="30%" id="<?=$b['id']?>" name="p<?=$ii?>" src="file/<?=$b['png']?>">
                        <input type="button" name="pd<?=$b['id']?>" value="刪除" onClick="pd(<?=$b['id']?>)">
                    </th>
                </tr>
				<?php
				}
				}
				?>
               <tr>
                	<th bgcolor="#CCCCCC">要上傳幾張圖片</th>
                    <td><input type="number" name="aa" id="aa"></td>
                </tr>
                <input type="hidden" id="hi" name="hi" value="<?=$ii?>">
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">內容</th>
                    <td><input type="text" name="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="50%">留言序號</th>
                    <td><input type="tel" name="number" pattern="[A-Za-z]{3}[0-9]{3}" value="<?=$a['number']?>"></td>
                </tr>
                <tr>
                	<th colspan="2">
                    	<input type="hidden" id="p" name="p" value="<?=$ii?>">
                    	<input type="submit" name="ok" value="確定">
                        <input type="button" value="重設" onClick="location.href='messagefix.php?id=<?=$id?>'">
                    </th>
                </tr>
            </table>
        </form>
        
        
    </h1></center>
</body>
</html>