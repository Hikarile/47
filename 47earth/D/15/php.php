<?php
	include("cd.php");
	
	class game{
		private $name;
		private $level;
		private $from;
		private $to;
		private $brick;
		
		public function game($date){
			$this->name=$date['name'];
			$this->level=$date['level'];
			$this->from=$date['from'];
			$this->to=$date['to'];
			$this->brick=$date['brick'];
		}
		public function start(){
			if($_SESSION['name']==''){
				$ms=explode(' ',microtime("now"));
				
				$_SESSION['stime']=$ms[0]+$ms[1];
				$_SESSION['name']=$this->name;
				$_SESSION['level']=$this->level;
				
				$_SESSION['count']=0;
				$_SESSION['allcount']=pow(2,$this->level)-1;
				
				$_SESSION['from'][$_SESSION['count']]=0;
				$_SESSION['to'][$_SESSION['count']]=0;
				$_SESSION['brick'][$_SESSION['count']]=0;
				
				$_SESSION['bar'][$_SESSION['count']]=array(1=>$this->level,0,0);
				for($i=1;$i<=$this->level;$i++){
					$a[$i]=$i;
					$b[$i]=0;
				}$_SESSION['box'][$_SESSION['count']]=array(1=>$a,$b,$b);
				
				$_SESSION['auto']=NULL;
				$_SESSION['again']=NULL;
				
				$_SESSION['nn']=NULL;
				$_SESSION['nnn']=NULL;
				
				$_SESSION['autofrom'][$_SESSION['count']]=0;
				$_SESSION['autoto'][$_SESSION['count']]=0;
				$_SESSION['autobrick'][$_SESSION['count']]=0;
				
				for($i=1;$i<=$this->level;$i++){
					$a[$i]=$i;
					$b[$i]=0;
				}$_SESSION['nn'][$_SESSION['count']]=array(1=>$a,$b,$b);
				
				$game=new game([]);
				$game->auto('1','3','2',$this->level);
				
				foreach($_SESSION['nnn'] as $key=>$val){
					$val=explode(',',$val);
					
					$nn=$_SESSION['nn'][$key];
					$nn[$val[1]][$val[2]]=$nn[$val[0]][$val[2]];
					$nn[$val[0]][$val[2]]=0;
					$_SESSION['nn'][$key+1]=$nn;
					
					$_SESSION['autofrom'][$key+1]=$val[0];
					$_SESSION['autoto'][$key+1]=$val[1];
					$_SESSION['autobrick'][$key+1]=$val[2];
				}
			}
		}
		public function go(){
			if(!($_SESSION['name']==$this->name && $_SESSION['level']==$this->level && $_SESSION['from'][$_SESSION['count']]==$this->from && $_SESSION['to'][$_SESSION['count']]==$this->to && $_SESSION['brick'][$_SESSION['count']]==$this->brick)){
				if($this->from == $this->to){
					return false;
				}
				
				$bar=$_SESSION['bar'][$_SESSION['count']];
				$box=$_SESSION['box'][$_SESSION['count']];
				
				$ttt='';
				$fff='';
				
				$fff=$this->brick;
				foreach($box[$this->to] as $val){
					if($val!=0){
						if($ttt==''){
							$ttt=$val;
						}
					}
				}
				
				if($bar[$this->to] == 0 || $fff<$ttt){
					$_SESSION['count']++;
					
					$_SESSION['from'][$_SESSION['count']]=$this->from;
					$_SESSION['to'][$_SESSION['count']]=$this->to;
					$_SESSION['brick'][$_SESSION['count']]=$this->brick;
					
					$bar[$this->to]++;
					$bar[$this->from]--;
					$_SESSION['bar'][$_SESSION['count']]=$bar;
					
					$box[$this->to][$this->brick]=$box[$this->from][$this->brick];
					$box[$this->from][$this->brick]=0;
					$_SESSION['box'][$_SESSION['count']]=$box;
					
					if($_SESSION['bar'][$_SESSION['count']][3] == $_SESSION['level']){
						$_SESSION['over']='over';
					}
					
				}else{
					echo'<script>';
					echo'alert("大盤子不能放在小盤子上");';
					echo'location.href="game.php?nickname='.$_SESSION['name'].'&difficulty='.$_SESSION['level'].'&fromStackId='.$_SESSION['from'][$_SESSION['count']].'&toStackId='.$_SESSION['to'][$_SESSION['count']].'&brickId='.$_SESSION['brick'][$_SESSION['count']].'";';
					echo'</script>';											
				}
			}
		}
		public function back(){
			$_SESSION['count']--;
			header("location:game.php?nickname=".$_SESSION['name']."&difficulty=".$_SESSION['level']."&fromStackId=".$_SESSION['from'][$_SESSION['count']]."&toStackId=".$_SESSION['to'][$_SESSION['count']]."&brickId=".$_SESSION['brick'][$_SESSION['count']]);
			exit();
		}
		public function auto($a,$b,$c,$n){
			$game=new game([]);
			if($n>0){
				$game->auto($a,$c,$b,$n-1);
				$_SESSION['nnn'][]=$a.','.$b.','.$n;
				$game->auto($c,$b,$a,$n-1);
			}else{
				return false;
			}
		}
	}
	
	