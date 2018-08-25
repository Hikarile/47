<?php
	include("cd.php");
	$id=$_GET['id'];
	$a=$mysql->query("SELECT * FROM `eat` where `id` = '$id'")->fetch_array();
?>
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
			data:{a:0,se:<?=$a['dd']?>,id:<?=$a['id']?>},
			success: function(da){
				$("hr").after(da);
				$('tr').find('[day="<?=$a['day']?>"][tp="<?=$a['tp']?>"]').css('background-color','#6C9');
			}
		});
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
			data:{a:n,id:<?=$a['id']?>},
			success: function(da){
				$("#big1").remove();
				$("#big2").remove();
				
				day=$("#day").val().split(' ');
				tp=$("#tp").val();
				$("hr").after(da);
				$('tr').find('[day="'+day[0]+'"][tp="'+tp+'"]').css('background-color','#6C9');
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
		id=$("#id").val();
		
		location.href='ad_ettab.php?day='+day+'&tp='+tp+'&quan='+quan+'&menu='+menu+'&tab='+tab+'&dd='+dd+'&id='+id;
	}
</script>
</head>
<body bgcolor="#6699FF">
	<center><h1>
    	訂餐修改
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
        
        <form method="post" action="ad_eff.php" id="su">
        	<table width="40%">
            	<tr>
                	<th colspan="4">
                    	訂餐編號:<?=$a['number']?>
                    </th>
                </tr>
            	<tr>
                	<th width="25%" bgcolor="#CCCCCC">日期</th>
                    <td><input id="day" type="text" name="day" value="<?=$a['day']?>" readonly></td>
                    <th width="25%" bgcolor="#CCCCCC">時段</th>
                    <td>
                    	<select id="tp" name="tp" disabled>
                        	<option value="午餐"<?php if($a['tp']=='午餐'){echo'selected';}?>>午餐</option>
                            <option value="下午茶"<?php if($a['tp']=='下午茶'){echo'selected';}?>>下午茶</option>
                            <option value="晚餐"><?php if($a['tp']=='晚餐'){echo'selected';}?>晚餐</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#CCCCCC">訂餐數量</th>
                    <td>
                    	<select id="quan"name="quan">
                        	<option value="1"<?php if($a['quan']=='1'){echo'selected';}?>>1</option>
                            <option value="2"<?php if($a['quan']=='2'){echo'selected';}?>>2</option>
                            <option value="3"<?php if($a['quan']=='3'){echo'selected';}?>>3</option>
                            <option value="4"<?php if($a['quan']=='4'){echo'selected';}?>>4</option>
                            <option value="5"<?php if($a['quan']=='5'){echo'selected';}?>>5</option>
                            <option value="6"<?php if($a['quan']=='6'){echo'selected';}?>>6</option>
                            <option value="7"<?php if($a['quan']=='7'){echo'selected';}?>>7</option>
                            <option value="8"<?php if($a['quan']=='8'){echo'selected';}?>>8</option>
                            <option value="9"<?php if($a['quan']=='9'){echo'selected';}?>>9</option>
                            <option value="10"<?php if($a['quan']=='10'){echo'selected';}?>>10</option>
                        </select>
                    </td>
                    <th width="25%" bgcolor="#CCCCCC">套餐名稱</th>
                    <td>
                    	<select id="menu" name="menu">
                        	<option value="Food01"<?php if($a['menu']=='Food01'){echo'selected';}?>>Food01</option>
                            <option value="Food02"<?php if($a['menu']=='Food02'){echo'selected';}?>>Food02</option>
                            <option value="Food03"<?php if($a['menu']=='Food03'){echo'selected';}?>>Food03</option>
                            <option value="Food04"<?php if($a['menu']=='Food04'){echo'selected';}?>>Food04</option>
                            <option value="Food05"<?php if($a['menu']=='Food05'){echo'selected';}?>>Food05</option>
                            <option value="Food06"<?php if($a['menu']=='Food06'){echo'selected';}?>>Food06</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th width="25%" bgcolor="#CCCCCC">訂餐桌數</th>
                    <td>
                    	<input id="ten" type="hidden" name="ten">
                        <select id="tab" name="tab">
                        	<option value="1"<?php if($a['tab']=='1'){echo'selected';}?>>1</option>
                            <option value="2"<?php if($a['tab']=='2'){echo'selected';}?>>2</option>
                            <option value="3"<?php if($a['tab']=='3'){echo'selected';}?>>3</option>
                            <option value="4"<?php if($a['tab']=='4'){echo'selected';}?>>1</option>
                            <option value="5"<?php if($a['tab']=='5'){echo'selected';}?>>5</option>
                            <option value="6"<?php if($a['tab']=='6'){echo'selected';}?>>6</option>
                            <option value="7"<?php if($a['tab']=='7'){echo'selected';}?>>7</option>
                            <option value="8"<?php if($a['tab']=='8'){echo'selected';}?>>8</option>
                            <option value="9"<?php if($a['tab']=='9'){echo'selected';}?>>9</option>
                            <option value="10"<?php if($a['tab']=='10'){echo'selected';}?>>10</option>
                        </select>
                    </td>
                    <th width="25%" bgcolor="#CCCCCC">桌號</th>
                    <td><input id="tnum" type="text" name="tnum" value="<?=$a['tnum']?>" readonly> </td>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="button" value="自動產生桌號" onClick="aaa()">
                        <input type="button" value="選擇桌號" onClick="bbb()">
                    </th>
                </tr>
                <tr>
                	<th colspan="4">
                    	<input type="hidden" name="dd" id="dd" value="<?=$a['dd']?>">
                        <input type="hidden" name="id" id="id" value="<?=$id?>">
                    	<input type="submit" value="確定">
                        <input type="button" value="取消" onClick="location.href='ad_ef.php?id=<?=$id?>'">
                    </th>
                </tr>
            </table>
        </form>
        
    </h1></center>
</body>
</html>