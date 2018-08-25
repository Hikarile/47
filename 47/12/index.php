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
		$("#tab").change(function(){
			if($("#day").val()==''){
				alert("請先點選日期");
				return false;
			}
			ten=Number($("#ten").val());
			tab=Number($("#tab").val());
			if($ten<tab){
				alert("超過上限");
				$("#tab").val(ten);
			}
		})
		$("#su").submit(function(){
			if($("#day").val()==''){
				alert("請先點選日期");
				return false;
			}
			if($("#tnum").val()==''){
				alert("請先選擇桌號");
				return false;
			}
			$("#tp").removeAttr('disabled');
		})
	})
	function ab(n){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:n},
			success: function(da){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(da);
				
				day=$("#day").val().split(' ');
				tp=$("#tp").val();
				$('tr').find('[day='+day[0]+'][tp='+tp+']').css('background-color','#6C9');
			}
		})
	}
	function cli(day,tp,ten,i,dd,odj){
		$(".a").removeAttr('style');
		var arr=['星期一','星期二','星期三','星期四','星期五','星期六','星期日'];
		mon=arr[i];
		$("[name='day']").val(day+' '+mon);
		$("[name='tp']").val(tp);
		$("[name='tab']").val(1);
		$("[name='tnum']").val('');
		$("#dd").val(dd);
		$(odj).css('background-color','#6C9');
	}
	function aaa(){
		if($("#day").val()==''){
			alert("請先點選日期");
			return false;
		}
		tab=$("#tab").val();
		day=$("#day").val();
		tp=$("#tp").val();
		$.ajax({
			url:"tab.php",
			type:"POST",
			data:{day:day,tp:tp,tab:tab},
			success: function(da){
				$("#tnum").val(da);
			}
		})
	}
	function bbb(){
		if($("#day").val()==''){
			alert("請先點選日期");
			return false;
		}
		day=$("#day").val();
		tp=$("#tp").val();
		quan=$("#quan").val();
		menu=$("#menu").val();
		tab=$("#tab").val();
		dd=$("#dd").val();
		location.href='ttab.php?day='+day+'&tp='+tp+'&quan='+quan+'&menu='+menu+'&tab='+tab+'&dd='+dd;
	}
</script>
</head>
<?php
	include("cd.php");
?>
<body bgcolor="#6699FF">
	<center><h1>
    	訪客訂餐
    	<table width="80%" height="60px" border="1">
        	<tr>
            	<th><input type="button" value="訪客留言" onClick="location.href='message.php'" style="width:100%; height:60px; font-size:30px;"></th>
                <th><input type="button" value="訪客訂餐" onClick="location.href='index.php'" style="width:100%; height:60px; font-size:30px;"></th>
                <th><input type="button" value="網站管理" onClick="location.href='admin.php'" style="width:100%; height:60px; font-size:30px;"></th>
            </tr>
        </table>
        <?php
        if($_SESSION['dnlu']!=''){
		?>
		<table width="50%" height="50px" border="1">
        	<tr>
            	<th><input type="button" value="留言管理" onClick="location.href='ad_m.php'" style="width:100%; height:50px; font-size:30px;"></th>
                <th><input type="button" value="訂餐管理" onClick="location.href='ad_e.php'" style="width:100%; height:50px; font-size:30px;"></th>
            </tr>
        </table>
		<?php
		}
		?>
        <p/><hr><p/>
        
        <form method="post" action="index2.php" id="su">
        	<table width="40%">
            	<tr>
                	<th width="25%" bgcolor="#CCCCCC">日期</th>
                    <td><input id="day" type="text" name="day" readonly></td>
                    <th width="25%" bgcolor="#CCCCCC">時段</th>
                    <td>
                    	<select id="tp" name="tp" disabled>
                        	<option value="午餐">午餐</option>
                            <option value="下午茶">下午茶</option>
                            <option value="晚餐">晚餐</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#CCCCCC">訂餐數量</th>
                    <td>
                    	<select id="quan"name="quan">
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
                    </td>
                    <th width="25%" bgcolor="#CCCCCC">套餐名稱</th>
                    <td>
                    	<select id="menu" name="menu">
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
                	<th width="25%" bgcolor="#CCCCCC">訂餐桌數</th>
                    <td>
                    	<input id="ten" type="hidden" name="ten">
                        <select id="tab" name="tab">
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
                    </td>
                    <th width="25%" bgcolor="#CCCCCC">桌號</th>
                    <td><input id="tnum" type="text" name="tnum" readonly> </td>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="button" value="自動產生桌號" onClick="aaa()">
                        <input type="button" value="選擇桌號" onClick="bbb()">
                    </th>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="hidden" name="dd" id="dd">
                    	<input type="submit" value="確定">
                        <input type="button" value="取消" onClick="location.href='index.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>