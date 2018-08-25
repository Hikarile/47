<?php
	class game{
		
		public function start($mlevel,$mfrom,$mto,$mbrick){/*遊戲一開始*/
			if($mlevel <> $_SESSION['mlevel']){
				return"不可擅自更改困難度";
			}
			if($_SESSION['back'] == 'true'){
				unset($_SESSION['back']);
				return false;
			}
			
			$_SESSION['mcount']=0;//計數步數
			$_SESSION['bar'][$_SESSION['mcount']]=array($mlevel,0,0);
			
			for($i=0;$i<$mlevel;$i++){
				$A[$i]=$i+1;
				$B[$i]=0;
			}
			$_SESSION['box'][$_SESSION['mcount']]=array($A,$B,$B);
			
			$_SESSION['getfrom'][$_SESSION['mcount']]=0;
			$_SESSION['getto'][$_SESSION['mcount']]=0;
			$_SESSION['getbrick'][$_SESSION['mcount']]=0;
		}
		
		public function error($mname,$mlevel,$mfrom,$mto,$mbrick){/*各種錯誤訊息*/
			if($_SESSION['mname']<>$mname){
				return '不可擅自更改姓名';
			}
			if($_SESSION['mlevel']<>$mlevel){
				return '不可擅自更改難度';
			}
			if($mbrick >= $_SESSION['mlevel'] || $mbrick < '0'){
				return "不存在此盤子";
			}
			if($mfrom > 2 || $mto >2){
				return "不存在此柱子";
			}
		}
		
		public function go($mname,$mlevel,$mfrom,$mto,$mbrick){/*移動*/
			if($_SESSION['back'] == 'true'){
				unset($_SESSION['back']);
				return false;
			}
			if(!($_SESSION['mfrom'] == $mfrom && $_SESSION['mto'] == $mto && $_SESSION['mbrick'] == $mbrick)){
				if($mfrom == $mto){
					return false;
				}
				
				$box=$_SESSION['box'][$_SESSION['mcount']];
				$bar=$_SESSION['bar'][$_SESSION['mcount']];
				
				foreach($box[$mfrom] as $from){
					if($from != 0){
						$fff=$from;
					}
				}
				foreach($box[$mto] as $to){
					if($to != 0){
						$ttt=$to;
					}
				}
				
				if($bar[$mto]==0 || $box[$mfrom][$mbrick] < $ttt){
					$_SESSION['mfrom']=$mfrom;
					$_SESSION['mto']=$mto;
					$_SESSION['mbrick']=$mbrick;
					
					$_SESSION['mcount']++;
					
					$bar[$mto]++;
					$bar[$mfrom]--;
					$_SESSION['bar'][$_SESSION['mcount']]=$bar;
					
					$box[$mto][$mbrick]= $box[$mfrom][$mbrick];
					$box[$mfrom][$mbrick] = 0;
					$_SESSION['box'][$_SESSION['mcount']]=$box;
					
					$_SESSION['getfrom'][$_SESSION['mcount']]=$mfrom;
					$_SESSION['getto'][$_SESSION['mcount']]=$mto;
					$_SESSION['getbrick'][$_SESSION['mcount']]=$mbrick;
					
					if($_SESSION['bar'][$_SESSION['mcount']][2] == $_SESSION['mlevel']){
						$_SESSION['over']='true';
					}
				}else{
					echo"<script>alert('上方環必須小於下方環');</script>";
					return false;
				}
				
			}
		}
		
		public function back($mlevel,$mfrom,$mto,$mbrick){//上一步
			$_SESSION['mcount']--;
			
			$_SESSION['mfrom']=$_SESSION['getfrom'][$_SESSION['mcount']];
			$_SESSION['mto']=$_SESSION['getto'][$_SESSION['mcount']];
			$_SESSION['mbrick']=$_SESSION['getbrick'][$_SESSION['mcount']];
			
			header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['mfrom']."&toStackId=".$_SESSION['mto']."&brickId=".$_SESSION['mbrick']);
		}
		
		public function automatic($a, $b, $c, $n){//自動-計算步驟
			$game=new game;
			if($n>0){
				$game->automatic($a,$c,$b,$n-1);
								
				$_SESSION['nn'][]=$a.','.$b.','.$n;
				
				$game->automatic($c,$b,$a,$n-1);
			}else{
				return false;
			}
		}
		
	}
?>