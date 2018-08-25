<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:0},
			success: function(da){
				$("hr").after(da);
			}
		})
		$("[name='tab']").change(function(){
			if($("[name='day").val()==''){
				alert("請先點選日期");
				return false;
			}else{
				ten=$("[name='tab']").val();
				tab=$("[name='tab']").val();
				if(ten<tab){
					alert("超過上限");
					$("[name='tab']").val(ten);
				}
			}
		})
		$("#su").submit(function(){
			if($("[name='day").val()==''){
				alert("請先點選日期");
				return false;
			}if($("[name='tnum").val()==''){
				alert("請先選擇桌號");
				return false;
			}
			$("[name='tp']").removeAttr('disabled');
		})
	})
	function changeMonth(n){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:n},
			success: function(da){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(da);
			}
		})
	}
	function cli(day,tp,ten,i,odj){
		$(".a").removeAttr('style');
		var arr = ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日'];
		mon = arr[i];	
		$(odj).css('background-color','#6C9');
		$("[name='day']").val(day+' '+mon);
		$("[name='tp']").val(tp);
		$("[name='ten']").val(ten);
	}
	function chTableNum(type){
		day=$("[name='day").val();
		tp=$("[name='tp").val();
		tab=$("[name='tab").val();
		quan=$("[name='quan").val();
		menu=$("[name='menu").val();
		
		if(day==''){
			alert("請先點選日期");
			return false;
		}
			
		if(type == 'auto') {
			$.ajax({
				url:"tab.php",
				type:"POST",
				data:{day:day,tp:tp,tab:tab},
				success: function(da){
					$("[name='tnum").val(da);
				}
			})
		} else {
			location.href='ttab.php?day='+day+'&tp='+tp+'&quan='+quan+'&menu='+menu+'&tab='+tab;
		}
			
	}
</script>
</head>
<?php
	include("cd.php")
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐
    	<table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:60px; font-size:30px;" type="button" value="網頁管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table border="1" width="50%" height="50px">
        	<tr>
            	<th><input style="width:100%; height:50px; font-size:30px;" type="button" value="留言管理" onClick="location.href='ad_m.php'"></th>
                <th><input style="width:100%; height:50px; font-size:30px;" type="button" value="訂餐管理" onClick="location.href='ad_e.php'"></th>
            </tr>
        </table>
		<?php
		}
		?>
        </p><hr></p>
        
        <form method="post" action="index2.php" id="su">
        	<table width="35%">
            	<tr>
                	<th width="25%" bgcolor="#999999">日期</th>
                    <td>
                    	<input type="text" name="day" readonly>
					</td width="25%">
                    <th width="25%" bgcolor="#999999">時段</th>
                    <td width="25%">
                    	<select name="tp" disabled>
                        	<option value="午餐">午餐</option>
                            <option value="下午茶">下午茶</option>
                            <option value="晚餐">晚餐</option>
                        </select>
					</td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#999999">訂餐數量</th>
                    <td>
                    	<select name="quan">
							<option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
					</td width="25%">
                    <th width="25%" bgcolor="#999999">套餐名稱</th>
                    <td width="25%">
                    	<select name="menu">
                        	<option value="Food01">Food01</option>
                            <option value="Food02">Food02</option>
                            <option value="Food03">Food03</option>
                            <option value="Food04">Food04</option>
                            <option value="Food05">Food05</option>
                            <option value="Food06">Food06</option>
                        </select>
					</td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#999999">訂餐桌數</th>
                    <td>
                    	<select name="tab">
                        	<option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
					</td width="25%">
                    <th width="25%" bgcolor="#999999">桌號</th>
                    <td width="25%">
                    	<input type="text" name="tnum" readonly>
					</td>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="button" value="自動產生桌號" onClick="chTableNum()">
                        <input type="button" value="選擇桌號" onClick="chTableNum('auto')">
                    </th>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="submit" value="確定訂餐">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>