
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>線上訂餐網站</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
<h1><a href="index.php">線上訂餐網站</a></h1>
<ul>
	<li><a href="mess.php" class="mess">訪客留言</a></li>
	<li><a href="book.php" class="book">訪客訂餐</a></li>
	<li><a href="manage.php" class="manage">網站管理</a></li>
</ul>


<div class="page">

<h3>網站管理-登入</h3>
<form method="post" action="login.php">
 
	<table>
  <tbody>
    <tr>
      <td>帳號</td>
      <td><input type="text" name="user"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>密碼</td>
      <td><input type="password" name="pwd"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>圖片驗證碼</td>
      <td>
      	<img id="img1" draggable="true" ondragstart="drag(event)" >
      	<img id="img2" draggable="true" ondragstart="drag(event)" >
      	<img id="img3" draggable="true" ondragstart="drag(event)" >
      	<img id="img4" draggable="true" ondragstart="drag(event)" >
      	
      </td>
      <td>
      <input type="button" id="code-btn" value="驗證碼重新產生">
		</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <input type="text" name="code" id="code" ondrop="drop(event)" ondragover="event.preventDefault();">
      <input type="hidden" name="code2" id="code2"> 
      </td>
      <td id="sort">&nbsp;</td>
    </tr>
    
    <script>
	$(function(){
		function code() {
			$.ajax({
				url: 'code.php',
				success: function(msg) {
					var arr = msg.split('');
					var arr2 = [arr[0], arr[1], arr[2], arr[3]];
					
					$('#img1').attr({ src: 'code/' + arr[0] + '.png' , v: arr[0] });
					$('#img2').attr({ src: 'code/' + arr[1] + '.png' , v: arr[1] });
					$('#img3').attr({ src: 'code/' + arr[2] + '.png' , v: arr[2] });
					$('#img4').attr({ src: 'code/' + arr[3] + '.png' , v: arr[3] });
					
					if(arr[4] == 0) {
						arr2.sort(function(a, b){ return a-b; });
						$('#sort').html('請由小到大排列驗證碼');
					} else {
						arr2.sort(function(a, b){ return b-a; });
						$('#sort').html('請由大到小排列驗證碼');
					}
					
					$('#code').val('');
					$('#code2').val(arr2.join(''));
				}
			});
		}
		code();
		$('#code-btn').on('click', function(){
			code();
		});
	});
	var ob = new Object();
	function drag(e) {
		ob.v = $('#' + e.target.id).attr('v');
	}
	function drop(e) {
		e.preventDefault();
		val = $('#code').val();
		$('#code').val(val + ob.v);
	}  
  	</script>
    
    <tr>
      <td>&nbsp;</td>
      <td>
      <input type="submit" value="送出"><input type="reset" value="重設">
		</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</form>

</div>


</body>
</html>