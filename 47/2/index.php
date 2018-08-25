<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
	include("include.php");
	//session_destroy();
?>
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$.ajax({   //一進網頁跳日期
			url:"day.php",
			type:"POST",
			data:{a:0},
			success: function(nn){
				$("hr").after(nn);
			}
		})
		$("[name=tab]").change(function(){
			if($("[name='day']").val() !=""){
				var ten=Number($("[name='ten']").val());
				var ex=Number($("[name='tab']").val());
				if(ex>ten){
					$("[name='tab']").val(ten);
					alert("超過上限");
					return false;
				}
			}else{
				$("[name='tab']").val(1);
				alert("先選擇日期");
				return false;
			}
		});
		$("#submi").submit(function(){
			if($("[name='day']").val() !=""){
				if($("[name='tnum']").val() !=""){
						$("[name='tp']").removeAttr("disabled");
				}else{
					alert("桌號未選擇");
					return false;
				}
			}else{
				alert("日期未選擇");
				return false;
			}
		})
	})
	function before(){//往後一周
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:2},
			success: function(nn){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(nn);
			}
		})
	}
	function after(){//往前一周
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:1},
			success: function(nn){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(nn);
			}
		})
	}
	function cli(tp,day,ten,m,odj){//點選日期
		$('.a').css('background-color','#69F');
		$(odj).css('background-color','#FFF');
		switch(m){
			case 0:
			mon="星期一";
			break;
			case 1:
			mon="星期二";
			break;
			case 2:
			mon="星期三";
			break;
			case 3:
			mon="星期四";
			break;
			case 4:
			mon="星期五";
			break;
			case 5:
			mon="星期六";
			break;
			case 6:
			mon="星期日";
			break;
		}
		$("[name='tp']").val(tp);
		$("[name='day']").val(day+' '+mon);
		$("[name='ten']").val(ten);
		$("[name='tab']").val(1);
	}
	function aaa(){//自動
		if($("[name='day']").val() !=""){
			var tab=$("[name='tab']").val();
			var day=$("[name='day']").val();
			var tp=$("[name='tp']").val();
			$.ajax({
				url:"tab.php",
				type:"POST",
				data:{tab:tab,day:day,tp:tp},
				success: function(da){
					$("[name=tnum]").val(da);
				}
			})
		}else{
			alert("先選擇日期");
			return false;
		}
	}
	function bbb(){//手動
		if($("[name='day']").val() !=""){
			$("[name='tp']").removeAttr("disabled");
			var day=$("[name='day']").val();
			var tab=$("[name='tab']").val();
			var tp=$("[name='tp']").val();
			var quan=$("[name='quan']").val();
			var menu=$("[name='menu']").val();
			var mon=$("[name='mon']").val();
			location.href="ttab.php?day="+day+"&tp="+tp+"&tab="+tab+"&quan="+quan+"&menu="+menu;
		}else{
			alert("先選擇日期");
			return false;
		}
	}
</script>
<body bgcolor="#6699FF">
	<center><h1>
        <table border="1" width="80%" height="70px">
            <tr>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style="width:100%; height:70px; font-size:40px;" type="button" value="管理頁面" onClick="location.href='admin.php'"></th>
            </tr>
        </table><p/>
        <hr>
        <p/>
        <form method="get" action="index2.php" id="submi">
        	<table>
            	<tr>
                	<th bgcolor="#999999">日期:</th>
                    <td><input type="text" name="day" readonly></td>
                    <th bgcolor="#999999">時段:</th>
                    <td>
                    	<select name="tp" disabled>
                        	<option value="午餐">午餐</option>
                            <option value="下午茶">下午茶</option>
                            <option value="晚餐">晚餐</option>
                        </select>
                    </td>	
                </tr>
                <tr>
                	<th bgcolor="#999999">訂餐數量:</th>
                    <td>
                    	<select name="quan">
                        <?php
                        for($i=1;$i<=20;$i++){
                        	echo'<option value="'.$i.'">'.$i.'</option>';
						}
						?>	
                        </select>
                    </td>
                    <th bgcolor="#999999">套餐名稱:</th>
                    <td>
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
                	<th bgcolor="#999999">訂餐桌數:</th>
                    <td>
                    	<input type="hidden" name="ten">
                    	<select name="tab">
                        <?php
                        for($i=1;$i<=10;$i++){
                        	echo'<option value="'.$i.'">'.$i.'</option>';
						}
						?>	
                        </select>
                    </td>
                    <th bgcolor="#999999">桌號:</th>
                    <td><input type="text" name="tnum" readonly></td>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="button" value="自動產生選桌" onClick="aaa()">
                        <input type="button" value="選擇選桌" onClick="bbb()">
                    </th>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="hidden" name="number">
                    	<input type="submit" value="確定">
                    </th>
                </tr>
            </table>
        </form>
        
	</h1></center>
</body>
</html>