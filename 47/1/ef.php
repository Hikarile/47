<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql= new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	if($_SESSION['dnlu'] == ""){
		header("location:admin.php");
	}
	
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
	
	if($_POST['ok']){
		$day=$_POST['day'];
		$tp=$_POST['tp'];
		$menu=$_POST['menu'];
		$quan=$_POST['quan'];
		$tab=$_POST['tab'];
		$tnum=$_POST['tnum'];
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$text=$_POST['text'];
		$money=$_POST['money'];
		$moneymoney=$_POST['moneymoney'];
		
		$mysql->query("UPDATE `eat` SET `day` = '$day', `tp` = '$tp', `quan` = '$quan', `menu` = '$menu', `tab` = '$tab', `tnum` = '$tnum', `money` = '$money', `moneymoney` = '$moneymoney', `name` = '$name', `email` = '$email', `phone` = '$phone', `text` = '$text' WHERE `id` = '$id'");
		header("location:eat-manage.php");
		
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
$(function() {
	$('[name="quan"]').change(function() {
		var quan=$('[name="quan"]').val();
		var money=300*quan;
		var moneymoney=money/10;
		$('[name="money"]').val(money);
		$('[name="moneymoney"]').val(moneymoney);
	})
})
</script>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	修改訂餐<input type="button" value="返回" onClick="location.href='eat-manage.php'"><p/>
        
        <form method="post" id="sub">
            <table>
            	<tr>
                    <td>訂餐編號:</td>
                    <td><input type="text" value="<?=$a['number']?>" readonly>(無法修改)</td>
                </tr>
                <tr>
                    <td>用餐日期:</td>
                    <td><input type="date" name="day" value="<?=$a['day']?>"></td>
                </tr>
                <tr>
                    <td>用餐時段:</td>
                    <td>
                    	<select name="tp">
                        	<option value="午餐"<?php if($a['tp'] == "午餐"){echo"selected";}?>>午餐</option>
                            <option value="下午茶"<?php if($a['tp'] == "下午茶"){echo"selected";}?>>下午茶</option>
                            <option value="晚餐"<?php if($a['tp'] == "晚餐"){echo"selected";}?>>晚餐</option>
                        </select>
					</td>
                </tr>
                <tr>
                    <td>套餐:</td>
                    <td>
                    	<select name="menu">
                        	<option value="Food01"<?php if($a['menu'] == "Food01"){echo"selected";}?>>Food01</option>
                            <option value="Food02"<?php if($a['menu'] == "Food02"){echo"selected";}?>>Food02</option>
                            <option value="Food03"<?php if($a['menu'] == "Food03"){echo"selected";}?>>Food03</option>
                            <option value="Food04"<?php if($a['menu'] == "Food04"){echo"selected";}?>>Food04</option>
                            <option value="Food05"<?php if($a['menu'] == "Food05"){echo"selected";}?>>Food05</option>
                            <option value="Food06"<?php if($a['menu'] == "Food06"){echo"selected";}?>>Food06</option>
                        </select>
					</td>
                </tr>
                <tr>
                	<td>套餐數量:</td>
                    <td><input type="number" name="quan" value="<?=$a['quan']?>"></td>
                </tr>
                <tr>
                    <td>桌數:</td>
                    <td><input type="number" name="tab" value="<?=$a['tab']?>" readonly></td>
                </tr>
                <tr>
                    <td>桌號:</td>
                    <td><input type="text" name="tnum" value="<?=$a['tnum']?>" readonly></td>
                </tr>
                <tr>
                    <td>姓名:</td>
                    <td><input type="text" name="name" value="<?=$a['name']?>"></td>
                </tr>
                <tr>
                    <td>電話:</td>
                    <td><input type="tel" name="phone" pattern="^[02]{2}[\-]\d{8}|[0]{1}[0-9]{9}$" value="<?=$a['phone']?>"></td>
                </tr>
                <tr>
                    <td>E_MAIL:</td>
                    <td><input id="email" type="email" name="email" value="<?=$a['email']?>"></td>
                </tr>
                <tr>
                    <td>備註:</td>
                    <td><input type="text" name="text" value="<?=$a['text']?>"></td>
                </tr>
                <tr>
                    <td>總金額:</td>
                    <td><input type="text" name="money" value="<?=$a['money']?>" readonly>(無法修改)</td>
                </tr>
                <tr>
                    <td>訂金:</td>
                    <td><input type="text" name="moneymoney" value="<?=$a['moneymoney']?>" readonly>(無法修改)</td>
                </tr>
                <tr>
                    <th colspan="2"><input type="submit" name="ok" value="確定"></th>
                </tr>
            </table>
        </form>
        <script>
        	$(function(){
				$("#sub").submit(function(){
					var email=$("#email").val();
					if (email.search(/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/)!=-1) {
					} else {
						alert("Email 資料錯誤？請重新輸入！");
						return false;
					}
				});
			});
			$("[name='quan']")
        </script>
    </h1></center>
	
</body>
</html>