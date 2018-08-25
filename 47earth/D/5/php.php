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
				$_SESSION['allcount']=(pow(2,$this->mlevel))-1;
				
				$_SESSION['auto']=NULL;
				$_SESSION['again']=NULL;
				
				$_SESSION['getfrom'][$_SESSION['mcount']]='0';
				$_SESSION['getto'][$_SESSION['mcount']]='0';
				$_SESSION['getbrick'][$_SESSION['mcount']]='0';
				
				$_SESSION['stime']=date("H:i:s:u");
				
				$_SESSION['bar'][$_SESSION['mcount']]=array($this->mlevel,0,0);
				for($i=0;$i<=2;$i++){
					$a[$i]=$i+1;		
					$b[$i]=0;
				}$_SESSION['box'][$_SESSION['mcount']]=array($a,$b,$b);
				
				$_SESSION['nn']=NULL;
				$_SESSION['nnn']=NULL;
				
				$_SESSION['autofrom'][$_SESSION['mcount']]='0';
				$_SESSION['autoto'][$_SESSION['mcount']]='0';
				$_SESSION['autobrick'][$_SESSION['mcount']]='0';
				
				$game=new game([]);
				$game->auto('1','3','2',$this->mlevel);
				
				for($j=0;$j<=2;$j++){
					$a[$j]=$j+1;
					$b[$j]=0;
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
				if($_SESSION['mname']<>$this->mname){
					return '請勿擅自更改姓名';
				}
				if($_SESSION['mlevel']<>$this->mlevel){
					return '請勿擅自更改難度';
				}
				if($_SESSION['mbrick']>$this->mlevel){
					return '無此盤子';
				}
				if($_SESSION['mfrom']>2 || $_SESSION['mto']>2){
					return '無此柱子';
				}
			}
		}
		
		public function go(){
			if($_SESSION['mname']!=''){
				if(!($this->mname==$_SESSION['mname']&&$this->mlevel==$_SESSION['mlevel']&&$this->mfrom==$_SESSION['getfrom'][$_SESSION['mcount']]&&$this->mto==$_SESSION['getto'][$_SESSION['mcount']]&&$this->mbrick==$_SESSION['getbrick'][$_SESSION['mcount']])){
					if($this->mfrom==$this->mto){
						return false;
					}
					$bar=$_SESSION['bar'][$_SESSION['mcount']];
					$box=$_SESSION['box'][$_SESSION['mcount']];
					
					$fff='';
					$ttt='';
					
					$fff=$this->mbrick;
					foreach($box[$this->mto] as $key=>$val){
						if($val!=''){
							if($ttt==''){
								$ttt=$val;
							}
						}
					}
					if($bar[$this->mto]==0||$fff<$ttt){
						$_SESSION['mcount']++;
						
						$bar[$this->mfrom]--;
						$bar[$this->mto]++;
						$_SESSION['bar'][$_SESSION['mcount']]=$bar;
						
						$box[$this->mto][$this->mbrick]=$box[$this->mfrom][$this->mbrick];
						$box[$this->mfrom][$this->mbrick]=0;
						$_SESSION['box'][$_SESSION['mcount']]=$box;;
						
						$_SESSION['getfrom'][$_SESSION['mcount']]=$this->mfrom;
						$_SESSION['getto'][$_SESSION['mcount']]=$this->mto;
						$_SESSION['getbrick'][$_SESSION['mcount']]=$this->mbrick;
						
						if($_SESSION['bar'][$_SESSION['mcount']][2]==3){
							$_SESSION['over']='over';
						}
					}else{
						echo'<script>';
						echo'alert("大盤子不能放在小盤子上面");';
						echo'location.href="game.php?nickname='.$_SESSION['mname'].'&difficulty='.$_SESSION['mlevel'].'&fromStackId='.$_SESSION['getfrom'][$_SESSION['mcount']].'&toStackId='.$_SESSION['getfrto'][$_SESSION['mcount']].'&brickId='.$_SESSION['getbrick'][$_SESSION['mcount']].'";';
						echo'</script>';
					}
					
				}
			}
		}
		
		public function back(){
			$_SESSION['mcount']--;
			
			header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['getfrom'][$_SESSION['mcount']]."&toStackId=".$_SESSION['getto'][$_SESSION['mcount']]."&brickId=".$_SESSION['getbrick'][$_SESSION['mcount']]);
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