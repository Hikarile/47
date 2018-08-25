<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	$mysql=new mysqli('localhost','admin','1234','47');
	$mysql->query("set names `utf8`");
	$a=$_POST['aa'];
	
	if($a == 0){//一進來
		$_SESSION['n']=0;
	}elseif($a == 1){//往前
		$_SESSION['n']=$_SESSION['n']-1;
	}else{//往後
		$_SESSION['n']=$_SESSION['n']+1;
	}
	
	$mon=date("N")-1;
	$ii=$_SESSION['n']*7;
	$day=date("Y年m月d日",strtotime(-$mon+$ii."day"))."-".date("Y年m月d日",strtotime(+6-$mon+$ii."day"));  //最上面Ymd-Ymd
	
	$ten=array();
	for($j=1;$j<=3;$j++){
		for($i=0;$i<=6;$i++){
			$d=date("Y-m-d",strtotime($ii+$i-$mon."day"));
			if($j==1){
				$tp="午餐";
			}else if($j==2){
				$tp="下午茶";
			}else{
				$tp="晚餐";
			}
			$count=0;
			$bb=$mysql->query("SELECT * FROM `eat` where `day` = '$d' and `tp` = '$tp'");
			while($b=mysqli_fetch_array($bb)){
				$count=$count+$b['tab'];
			}
			if($count == 10){
				$ten[]='<th class="a" id="'.$j.''.$i.'">已無位子</th>';
			}else{
				$t=10-$count;
				$ten[]='<th class="a" id="'.$j.''.$i.'" onClick="a('.$j.',\''.date("Y-m-d",strtotime($ii+$i-$mon."day")).'\',this)">'.$t.'</th>';
			}
		}
	}
	echo '
		<table id="big1" border="2" width="80%" bgcolor="#66CCFF">
        	<tr>
            	<th onClick="before()">前一周</th>
                <th>'.$day.'</th>
                <th onClick="after()">後一周</th>
            </tr>
        </table>
        <table id="big2" border="2" width="80%" height="400px">
        	<tr height="100px">
            	<th width="10%"></th>
            	<th width="10%"bgcolor="#0099FF">(一)<br/>'.date("d",strtotime($ii-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(二)<br/>'.date("d",strtotime($ii+1-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(三)<br/>'.date("d",strtotime($ii+2-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(四)<br/>'.date("d",strtotime($ii+3-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(五)<br/>'.date("d",strtotime($ii+4-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(六)<br/>'.date("d",strtotime($ii+5-$mon."day")).'</th>
                <th width="10%"bgcolor="#0099FF">(日)<br/>'.date("d",strtotime($ii+6-$mon."day")).'</th>
            </tr>
            <tr height="100px">	
            	<th bgcolor="#0099FF" id="a">午餐<br/>(可訂桌數)</th>
				'.$ten[0].''.$ten[1].''.$ten[2].''.$ten[3].''.$ten[4].''.$ten[5].''.$ten[6].'
            </tr>
            <tr height="100px">
            	<th bgcolor="#0099FF" id="b">下午茶<br/>(可訂桌數)</th>
				'.$ten[7].''.$ten[8].''.$ten[9].''.$ten[10].''.$ten[11].''.$ten[12].''.$ten[13].'
            </tr>
            <tr height="100px">
            	<th bgcolor="#0099FF" id="c">晚餐<br/>(可訂桌數)</th>
				'.$ten[14].''.$ten[15].''.$ten[16].''.$ten[17].''.$ten[18].''.$ten[19].''.$ten[20].'
            </tr>
        </table>';