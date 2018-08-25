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
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(da);
			}
		})
		$("[name='tab']").change(function(){
			tab=Number($("[name='tab']").val());
			ten=Number($("[name='ten']").val());
			if(ten < tab){
				alert("超過上限");
				$("[name='tab']").val(ten);
				return false;
			}
		})
		$("#sub").submit(function(){
			if($("[name='day']").val()==''){
				alert("請先選擇日期");
				return false;
			}
			if($("[name='tnum']").val()==''){
				alert("請先選擇桌號");
				return false;
			}
			$("[name='tp']").removeAttr('disabled');
		})
	})
	function before(){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:1},
			success: function(da){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(da);
			}
		})
	}
	function after(){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:2},
			success: function(da){
				$("#big1").remove();
				$("#big2").remove();
				$("hr").after(da);
			}
		})
	}
	function cli(tp,day,ten,m,odj){
		$(".a").css('background-color','#FFF');
		$(odj).css('background-color','#69F');
		switch(m){
			case 0:
			mon='星期一';
			break;
			case 1:
			mon='星期二';
			break;
			case 2:
			mon='星期三';
			break;
			case 3:
			mon='星期四';
			break;
			case 4:
			mon='星期五';
			break;
			case 5:
			mon='星期六';
			break;
			case 6:
			mon='星期日';
			break;
		}
		$("[name='day']").val(day+' '+mon);
		$("[name='tp']").val(tp);
		$("[name='ten']").val(ten);
	}
	function aaa(){
		day=$("[name='day']").val();
		tp=$("[name='tp']").val();
		tab=$("[name='tab']").val();
		if(day!=''){
			$.ajax({
				url:"tab.php",
				type:"POST",
				data:{day:day,tp:tp,tab:tab},
				success: function(da){
					$("[name='tnum']").val(da);
				}
			})
		}else{
			alert('請先選擇日期');
			return false;
		}
	}
	function bbb(){
		day=$("[name='day']").val();
		tp=$("[name='tp']").val();
		quan=$("[name='quan']").val();
		menu=$("[name='menu']").val();
		tab=$("[name='tab']").val();
		if(day!=''){
			$("[name='tp']").removeAttr('disabled');
			location.href='ttab.php?day='+day+'&tp='+tp+'&quan='+quan+'&menu='+menu+'&tab='+tab;
		}else{
			alert('請先選擇日期');
			return false;
		}
	}
</script>
</head>

<body bgcolor="#6699FF">
	
    <center><h1>
    	訪客訂餐
        <table border="1" width="80%" height="60px">
        	<tr>
            	<th><input style=" width:100%;height:60px; font-size:40px;" type="button" value="訪客留言" onClick="location.href='message.php'"></th>
                <th><input style=" width:100%;height:60px; font-size:40px;" type="button" value="訪客訂餐" onClick="location.href='index.php'"></th>
                <th><input style=" width:100%;height:60px; font-size:40px;" type="button" value="網站管理" onClick="location.href='admin.php'"></th>
            </tr>
        </table>
        <p/><hr><p/>
        
        <form method="post" id="sub" action="index2.php">
        	<table width="40%">
            	<tr>
                	<th width="25%" bgcolor="#999999">日期</th>
                    <td width="25%"><input type="text" name="day" readonly></td>
                	<th width="25%" bgcolor="#999999">時段</th>
                    <td width="25%">
                    	<select name="tp"disabled>
                        	<option value="午餐">午餐</option>
                            <option value="下午茶">下午茶</option>
                            <option value="晚餐">晚餐</option>
                        </select>
                    </td>
                </tr>
                <tr>	
                	<th width="25%" bgcolor="#999999">訂餐數量</th>
                    <td width="25%">
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
                    </td>
                	<th width="25%" bgcolor="#999999">套餐名稱</th>
                    <td width="25%">
                    	<select name="menu">
                        	<option value="Food1">Food1</option>
                            <option value="Food2">Food2</option>
                            <option value="Food3">Food3</option>
                            <option value="Food4">Food4</option>
                            <option value="Food5">Food5</option>
                            <option value="Food6">Food6</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#999999">訂餐桌數</th>
                    <td width="25%">
                    	<input type="hidden" name="ten">
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
                    </td>
                	<th width="25%" bgcolor="#999999">桌號</th>
                    <td width="25%"><input type="text" name="tnum" readonly></td>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="button" value="自動產生桌號" onClick="aaa()">
                        <input type="button" value="選擇桌號" onClick="bbb()">
                    </th>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="submit" value="確定">
                    </th>
                </tr>
            </table>
        </form>
    </h1></center>
    
</body>
</html>