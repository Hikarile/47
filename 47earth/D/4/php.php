<?php
	class game{
		private $mname;
		private $mlevel;
		private $mfrom;
		private $mto;
		private $mbrick;
		
		public function game($date){
			$this->mname=$date['mname'];
			$this->mlevel=$date['mlevel'];
			$this->mfrom=$date['mfrom'];
			$this->mto=$date['mto'];
			$this->mbrick=$date['mbrick'];
		}
		
		public function start(){
			if($_SESSION['mname']==''){
				$_SESSION['mname']=$this->mname;
				$_SESSION['mlevel']=$this->mlevel;
				
				$_SESSION['mcount']='0';
				$_SESSION['allcount']=(pow(2,$this->mlevel)-1);
				
				$_SESSION['auto']=NULL;
				$_SESSION['again']=NULL;
				
				$_SESSION['stime']=date('H:i:s');
				
				$_SESSION['getfrom'][$_SESSION['mcount']]='0';
				$_SESSION['getto'][$_SESSION['mcount']]='0';
				$_SESSION['getbrick'][$_SESSION['mcount']]='0';
				
				$_SESSION['bar'][0]=array($this->mlevel,0,0);
				for($i=0;$i<=2;$i++){
					$a[$i]=$i+1;		
					$b[$i]=0;
				}$_SESSION['box'][0]=array($a,$b,$b);
				
				
				$_SESSION['autofrom'][0]=0;
				$_SESSION['autoto'][0]=0;
				$_SESSION['autobrick'][0]=0;
				
				$game=new game([]);
				$game->auto('1','3','2',$this->mlevel);
				
				for($i=0;$i<=2;$i++){
					$a[$i]=$i+1;
					$b[$i]=0;
				}$_SESSION['nnn'][0]=array($a,$b,$b);
				
				foreach($_SESSION['nn'] as $key=>$val){
					$val=explode(',',$val);
					
					$nnn=$_SESSION['nnn'][$key];
					$nnn[$val[1]-1][$val[2]-1]=$nnn[$val[0]-1][$val[2]-1];
					$nnn[$val[0]-1][$val[2]-1]=0;
					$_SESSION['nnn'][$key+1]=$nnn;
					
					$_SESSION['autofrom'][$key+1]=$val[0];
					$_SESSION['autoto'][$key+1]=$val[1];
					$_SESSION['autobrick'][$key+1]=$val[2];
				}
			}
		}
		public function error(){
			if($_SESSION['mname']!=''){
				if($this->mname<>$_SESSION['mname']){
					return"不可擅自更改姓名";
				}
				if($this->mlevel<>$_SESSION['mlevel']){
					return"不可擅自更改困難度";
				}
				if($this->mbrick >= $_SESSION['mlevel']){
					return "不存在此盤子";
				}
				if($this->mfrom > 2 || $this->mto >2){
					return "不存在此柱子";
				}
			}
		}
		public function go(){
			if($_SESSION['mname']!=''){
				if(!($_SESSION['getfrom'][$_SESSION['mcount']] == $this->mfrom && $_SESSION['getto'][$_SESSION['mcount']] == $this->mto && $_SESSION['getbrick'][$_SESSION['mcount']] == $this->mbrick)){
					
					if($this->mfrom == $this->mto){
						return false;
					}
					
					$fff='';
					$ttt='';
					
					$bar=$_SESSION['bar'][$_SESSION['mcount']];
					$box=$_SESSION['box'][$_SESSION['mcount']];
					
					$fff=$this->mbrick;
					foreach($box[$this->mto] as $val){
						if($val!=0){
							if($ttt==''){
								$ttt=$val;
							}
						}
					}
					
					if($bar[$this->mto]==0 || $fff<$ttt){
						$_SESSION['mcount']++;
						
						$bar[$this->mfrom]--;
						$bar[$this->mto]++;
						$_SESSION['bar'][$_SESSION['mcount']]=$bar;
						
						$box[$this->mto][$this->mbrick]=$box[$this->mfrom][$this->mbrick];
						$box[$this->mfrom][$this->mbrick]=0;
						$_SESSION['box'][$_SESSION['mcount']]=$box;
						
						$_SESSION['getfrom'][$_SESSION['mcount']]=$this->mfrom;
						$_SESSION['getto'][$_SESSION['mcount']]=$this->mto;
						$_SESSION['getbrick'][$_SESSION['mcount']]=$this->mbrick;
						
						if($_SESSION['bar'][$_SESSION['mcount']][2] == $this->mlevel){
							$_SESSION['over']='true';
						}
					}else{
						echo'<script>';
						echo'alert("上方盤子必須小於下方的盤子");';
						echo'location.href="game.php?nickname='.$_SESSION['mname'].'&difficulty='.$_SESSION['mlevel'].'&fromStackId='.$_SESSION['getfrom'][$_SESSION['count']].'&toStackId='.$_SESSION['getfrto'][$_SESSION['count']].'&brickId='.$_SESSION['getbrick'][$_SESSION['count']].'";';
						echo'</script>';
					}
					
				}
			}
		}
		public function back(){
			$_SESSION['mcount']--;
			header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['getfrom'][$_SESSION['mcount']]."&toStackId=".$_SESSION['getto'][$_SESSION['mcount']]."&brickId=".$_SESSION['getbrick'][$_SESSION['mcount']]);
			exit();
		}
		
		public function auto($a,$b,$c,$n){
			$game=new game([]);
			if($n>0){
				$game->auto($a,$c,$b,$n-1);
				$_SESSION['nn'][]=$a.','.$b.','.$n;
				$game->auto($c,$b,$a,$n-1);
			}else{
				return false;
			}
		}
		
	}