<?php
	class game{
		private $mname;
		private $mlevel;
		private $mfrom;
		private $mto;
		private $mbrick;
		
		public function game($data){
			$this->mname = $data['mname'];
			$this->mlevel = $data['mlevel'];
			$this->mfrom = $data['mfrom'];
			$this->mto = $data['mto'];
			$this->mbrick = $data['mbrick'];
		}
		
		public function start(){//一開始
			if($_SESSION['mname']==''){
				$_SESSION['mname']=$this->mname;
				$_SESSION['mlevel']=$this->mlevel;
				
				$_SESSION['allcount']=pow(2,$_GET['difficulty'])-1;
				
				$_SESSION["auto"]=NULL;
				$_SESSION["again"]=NULL;
				
				$_SESSION['stime']=date('H:i:s');
				
				$_SESSION['mfrom']='';
				$_SESSION['mto']='';
				$_SESSION['mbrick']='';
				
				$_SESSION['mcount']='0';//計數步數
				$_SESSION['bar'][0]=array($this->mlevel,0,0);
				
				for($i=0;$i<$this->mlevel;$i++){
					$A[$i]=$i+1;
					$B[$i]=0;
				}
				$_SESSION['getto'][0]='0';
				$_SESSION['getfrom'][0]='0';
				$_SESSION['getbrick'][0]='0';
				
				$_SESSION['box'][0]=array($A,$B,$B);
				
				
				
				$_SESSION['nn']=NULL;
				$_SESSION['nnn']=NULL;
				
				$_SESSION['autofrom']=NULL;
				$_SESSION['autoto']=NULL;
				$_SESSION['autobrick']=null;
				
				$_SESSION['autofrom'][]=0;
				$_SESSION['autoto'][]=0;
				$_SESSION['autobrick'][]=0;
				
				$game=new game([]);
				$game->automatic('1','3','2',$this->mlevel);
				
				for($i=0;$i<$this->mlevel;$i++){
					$A[$i]=$i+1;
					$B[$i]=0;
				}$_SESSION['nnn'][0]=array($A,$B,$B);
				
				foreach($_SESSION['nn']  as $k=> $nn){
					$nn=explode(',',$nn);
					
					$nnn=$_SESSION['nnn'][$k];
					
					$nnn[$nn[1]-1][$nn[2]-1]=$nnn[$nn[0]-1][$nn[2]-1];
					$nnn[$nn[0]-1][$nn[2]-1]=0;
					
					$_SESSION['nnn'][$k+1]=$nnn;
					$_SESSION['autofrom'][$k+1]=$nn[0];
					$_SESSION['autoto'][$k+1]=$nn[1];
					$_SESSION['autobrick'][$k+1]=$nn[2];
				}
			}
		}
		
		public function error(){//錯誤判斷
			if($_SESSION['mname'] !=''){
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
		
		public function go(){//移動
			if(!($_SESSION['getfrom'][$_SESSION['mcount']] == $this->mfrom && $_SESSION['getto'][$_SESSION['mcount']] == $this->mto && $_SESSION['getbrick'][$_SESSION['mcount']] == $this->mbrick)){
				if($this->mfrom == $this->mto){
					return false;
				}
				
				$fff='';
				$ttt='';
				
				$bar=$_SESSION['bar'][$_SESSION['mcount']];
				$box=$_SESSION['box'][$_SESSION['mcount']];
				
				$ff=$this->mbrick;
				foreach($box[$this->mto] as $val){
					if($val!=0){
						if($fff==''){
							$ttt=$val;
						}
					}
				}
				
				if($bar[$this->mto]==0 || $fff < $ttt){
					$_SESSION['mfrom']=$this->mfrom;
					$_SESSION['mto']=$this->mto;
					$_SESSION['mbrick']=$this->mbrick;
					
					$_SESSION['mcount']++;
					
					$bar[$this->mto]++;
					$bar[$this->mfrom]--;
					$_SESSION['bar'][$_SESSION['mcount']]=$bar;
					
					$box[$this->mto][$this->mbrick]= $box[$this->mfrom][$this->mbrick];
					$box[$this->mfrom][$this->mbrick] = 0;
					$_SESSION['box'][$_SESSION['mcount']]=$box;
					
					$_SESSION['getfrom'][$_SESSION['mcount']]=$this->mfrom;
					$_SESSION['getto'][$_SESSION['mcount']]=$this->mto;
					$_SESSION['getbrick'][$_SESSION['mcount']]=$this->mbrick;
					
					if($_SESSION['bar'][$_SESSION['mcount']][2] == $_SESSION['mlevel']){
						$_SESSION['over']='true';
					}
				}else{
					echo"<script>";
					echo"alert('上方環必須小於下方環');";
					echo"location.href='game.php?nickname=".$this->mname."&difficulty=".$this->mlevel."&fromStackId=".$_SESSION['getfrom'][$_SESSION['mcount']]."&toStackId=".$_SESSION['getto'][$_SESSION['mcount']]."&brickId=".$_SESSION['getbrick'][$_SESSION['mcount']]."'";
					echo"</script>";
					
				}
			}
		}
		
		public function back(){//上一步
			$_SESSION['mcount']--;
			
			$_SESSION['mfrom']=$_SESSION['getfrom'][$_SESSION['mcount']];
			$_SESSION['mto']=$_SESSION['getto'][$_SESSION['mcount']];
			$_SESSION['mbrick']=$_SESSION['getbrick'][$_SESSION['mcount']];
			
			header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['mfrom']."&toStackId=".$_SESSION['mto']."&brickId=".$_SESSION['mbrick']);
			exit();
		}
		
		public function automatic($a, $b, $c, $n){//自動-計算步驟
			$game=new game([]);
			if($n>0){
				$game->automatic($a,$c,$b,$n-1);
				$_SESSION['nn'][]=$a.','.$b.','.$n;
				$game->automatic($c,$b,$a,$n-1);
			}else{
				return false;
			}
		}
	}