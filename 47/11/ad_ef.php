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
<script src="jquery.js" type="text/javascript"></script>
<script>
	$(function(){
		$.ajax({
			url:"day.php",
			type:"POST",
			data:{a:0,session:<?=$a['session']?>},
			success: function(da){
				$("hr").after(da);
				$('.a[m=<?=$a['c']?>]').trigger('click');
			}
		})
		$("#tab").change(function(){
			if($("#day").val()==''){
				alert("請先選擇日期");
				return false;
			}
			ten=Number($("#ten").val());
			tab=Number($('#tab').val());
			if(ten<tab){
				alert("超過上限");
				$("#tab").val(ten);
				return false;
			}
		})
		$("#su").submit(function(){
			if($("#day").val()==''){
				alert("請先選擇日期");
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
			}
		})
	}
	function cli(day,tp,ten,i,c,odj){
		$(".a").removeAttr('style');
		$(odj).css('background-color','#6C9');
		var arr=['星期一','星期二','星期三','星期四','星期五','星期六','星期日'];
		mon=arr[i];
		$("#day").val(day+' '+mon);
		$("#tp").val(tp);
		$("#ten").val(ten);
		$("#c").val(c);
	}
	function aaa(){
		if($("#day").val()==''){
			alert("請先選擇日期");
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
			alert("請先選擇日期");
			return false;
		}
		day=$("#day").val();
		tp=$("#tp").val();
		quan=$("#quan").val();
		menu=$("#menu").val();
		tab=$("#tab").val();
		c=$("#c").val();
		location.href='ad_ttab.php?day='+day+'&tp='+tp+'&quan='+quan+'&menu='+menu+'&tab='+tab+'&c='+c+'&id=<?=$id?>';
	}
</script>
</head>

<body bgcolor="#6699FF">
	<center><h1>
    	修改訂餐<input type="button" value="返回" onClick="location.href='ad_e.php'"><p/>
        
        <p/><hr><p/>
        <form method="post" action="ad_eff.php" id="su">
        	<table width="35%">
            	<tr>
                	<th bgcolor="#999999" width="25%">日期</th>
                    <td width="25%"><input id="day" type="text" name="day" readonly></td>
                    <th bgcolor="#999999" width="25%">時段</th>
                    <td width="25%">
                    <select id="tp" name="tp" disabled>
                    	<option value="午餐">午餐</option>
                        <option value="下午茶">下午茶</option>
                        <option value="晚餐">晚餐</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<th bgcolor="#999999" width="25%">訂餐數量</th>
                    <td width="25%">
                    <select id="quan" name="quan">
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
                    <th bgcolor="#999999" width="25%">套餐名稱</th>
                    <td width="25%">
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
                	<th bgcolor="#999999" width="25%">訂餐桌數</th>
                    <td width="25%">
                    <input id="ten" type="hidden" name="ten">
                    <select id="tab" name="tab">
                    	<option value="1"<?php if($a['tab']==1){echo'selected';}?>>1</option>
                        <option value="2"<?php if($a['tab']==2){echo'selected';}?>>2</option>
                        <option value="3"<?php if($a['tab']==3){echo'selected';}?>>3</option>
                        <option value="4"<?php if($a['tab']==4){echo'selected';}?>>4</option>
                        <option value="5"<?php if($a['tab']==5){echo'selected';}?>>5</option>
                        <option value="6"<?php if($a['tab']==6){echo'selected';}?>>6</option>
                        <option value="7"<?php if($a['tab']==7){echo'selected';}?>>7</option>
                        <option value="8"<?php if($a['tab']==8){echo'selected';}?>>8</option>
                        <option value="9"<?php if($a['tab']==9){echo'selected';}?>>9</option>
                        <option value="10"<?php if($a['tab']==10){echo'selected';}?>>10</option>
                    </select>
                    </td>
                    <th bgcolor="#999999" width="25%">桌號</th>
                    <td width="25%">
                    <input id="tnum"type="text" name="tnum"  value="<?=$a['tnum']?>"readonly>
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
                    	<input type="hidden" name="id" value="<?=$id?>">
                    	<input type="hidden" name="c" value="<?=$a['c']?>" id="c">
                    	<input type="submit" value="確定">
                        <input type="button" value="取消" onClick="location.href='ad_e.php'">
                    </th>
                </tr>
            </table>
        </form>        
        
    </h1></center>
</body>
</html>