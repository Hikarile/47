<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="jquery.js"></script>
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
			$("#tnum").val("");
			ten=Number($("#ten").val());
			tab=Number($("#tab").val());
			if(ten<tab){
				alert("超過上限");
				$("#tab").val(ten);
				return false;
			}
		})
		$("#su").submit(function(){
			if($("#day").val()==''){
				alert("請先點選日期");
				return false;
			}if($("#tnum").val()==''){
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
				$("tr").find("[day='"+day[0]+"'][tp='"+tp+"']").css('background-color','#6C9');
			}
		})
	}
	function cli(day,tp,ten,i,dd,odj){
		$(".a").removeAttr('style');
		var arr=['星期一','星期二','星期三','星期四','星期五','星期六','星期日'];
		mon=arr[i];
		$("#day").val(day+' '+mon);
		$("#tp").val(tp);
		$("#ten").val(ten);
		$("#dd").val(dd);
		$("#tab").val(1);
		$("#tnum").val('');
		$(odj).css('background-color','#6C9');
	}
	function aaa(){
		if($("#day").val()==''){
			alert("請先點選日期");
			return false;
		}
		day=$("#day").val();
		tp=$("#tp").val();
		tab=$("#tab").val();
		
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
		?><p/><hr><p/>
        
        <form method="post" action="ff.php" id="su">
        	<table width="40%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="25%">日期</th>
                    <td width="25%">
                    	<input type="text" id="day" name="day" readonly>
                    </td>
                    <th bgcolor="#CCCCCC" width="25%">時段</th>
                    <td width="25%">
                    	<select name="tp" id="tp" disabled>
                        	<option value="午餐">午餐</option>
                            <option value="下午茶">下午茶</option>
                            <option value="晚餐">晚餐</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="25%">訂餐數量</th>
                    <td width="25%">
                    	<select name="quan" id="quan">
                        	<?php
                            for($i=1;$i<=20;$i++){
								echo'<option value="'.$i.'">'.$i.'</option>';
							}
							?>
                        </select>
                    </td>
                    <th bgcolor="#CCCCCC" width="25%">套餐名稱</th>
                    <td width="25%">
                    	<select name="menu" id="menu">
                        	<?php
                            $mm=$mysql->query("SELECT * FROM `menu`");
							while($m=mysqli_fetch_array($mm)){
							?><option value="<?=$m['menu']?>"><?=$m['menu']?></option><?php
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="25%">訂餐桌數</th>
                    <td width="25%">
                    	<input type="hidden" id="ten" name="ten" readonly>
                        <select name="tab" id="tab">
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
                    <th bgcolor="#CCCCCC" width="25%">桌號</th>
                    <td width="25%">
                    	<input type="text" id="tnum" name="tnum" readonly>
                    </td>
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
                        <input type="button" value="取消" onClick="location.href='f.php'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>