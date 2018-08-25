<?php
	include("cd.php");
	$id=$_GET['id'];
	$aa=$mysql->query("SELECT * FROM `eat` where `id` = '$id'");
	$a=mysqli_fetch_array($aa);
?>
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
			data:{a:0,id:<?=$id?>,dd:<?=$a['dd']?>},
			success: function(da){
				$("hr").after(da);
				$("tr").find("[day='<?=$a['day']?>'][tp='<?=$a['tp']?>']").css('background-color','#6C9');
				$("#ten").val($("tr").find("[day='<?=$a['day']?>'][tp='<?=$a['tp']?>']").text());
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
			data:{a:n,id:<?=$id?>,dd:<?=$a['dd']?>},
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
		id=$("#id").val();
		
		$.ajax({
			url:"ad_etab.php",
			type:"POST",
			data:{day:day,tp:tp,tab:tab,id:id},
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
        
        <form method="post" action="ad_eff.php" id="su">
        	<table width="40%">
            	<tr>
                	<th bgcolor="#CCCCCC" width="25%">日期</th>
                    <td width="25%">
                    	<input type="text" id="day" name="day" readonly value="<?=$a['day']?> <?=$a['mon']?>">
                    </td>
                    <th bgcolor="#CCCCCC" width="25%">時段</th>
                    <td width="25%">
                    	<select name="tp" id="tp" disabled>
                        	<option value="午餐"<?php if($a['tp']=='午餐'){echo'selected';}?>>午餐</option>
                            <option value="下午茶"<?php if($a['tp']=='下午茶'){echo'selected';}?>>下午茶</option>
                            <option value="晚餐"<?php if($a['tp']=='晚餐'){echo'selected';}?>>晚餐</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#CCCCCC" width="25%">訂餐數量</th>
                    <td width="25%">
                    	<select name="quan" id="quan">
                        	<?php
                            for($i=1;$i<=20;$i++){
								if($a['quan']==$i){
									echo'<option value="'.$i.'" selected>'.$i.'</option>';
								}else{
									echo'<option value="'.$i.'">'.$i.'</option>';
								}
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
							?><option value="<?=$m['menu']?>" <?php if($a['menu']==$m['menu']){echo 'selected';}?>><?=$m['menu']?></option><?php
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
                        	<option value="1"<?php if($a['tab']=='1'){echo'selected';}?>>1</option>
                            <option value="2"<?php if($a['tab']=='2'){echo'selected';}?>>2</option>
                            <option value="3"<?php if($a['tab']=='3'){echo'selected';}?>>3</option>
                            <option value="4"<?php if($a['tab']=='4'){echo'selected';}?>>4</option>
                            <option value="5"<?php if($a['tab']=='5'){echo'selected';}?>>5</option>
                            <option value="6"<?php if($a['tab']=='6'){echo'selected';}?>>6</option>
                            <option value="7"<?php if($a['tab']=='7'){echo'selected';}?>>7</option>
                            <option value="8"<?php if($a['tab']=='8'){echo'selected';}?>>8</option>
                            <option value="9"<?php if($a['tab']=='9'){echo'selected';}?>>9</option>
                            <option value="10"<?php if($a['tab']=='10'){echo'selected';}?>>10</option>
                        </select>
                    </td>
                    <th bgcolor="#CCCCCC" width="25%">桌號</th>
                    <td width="25%">
                    	<input type="text" id="tnum" name="tnum" readonly value="<?=$a['tnum']?>">
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