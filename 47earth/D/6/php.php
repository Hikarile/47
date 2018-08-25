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
				$_SESSION['stime']=date("H:i:s");
				
				$_SESSION['name']=$this->name;
				$_SESSION['level']=$this->level;
				
				$_SESSION['count']='0';
				$_SESSION['allcount']=(pow(2,$this->level))-1;
				
				$_SESSION['from'][$_SESSION['count']]='0';
				$_SESSION['to'][$_SESSION['count']]='0';
				$_SESSION['brick'][$_SESSION['count']]='0';
				
				$_SESSION['auto']=NULL;
				$_SESSION['again']=NULL;
				
				$_SESSION['bar'][$_SESSION['count']]=array($this->level,0,0);
				for($i=0;$i<=$this->level-1;$i++){
					$a[$i]=$i+1;
					$b[$i]=0;
				}$_SESSION['box'][$_SESSION['count']]=array($a,$b,$b);
				
				
				$_SESSION['autofrom'][0]='0';
				$_SESSION['autoto'][0]='0';
				$_SESSION['autobrick'][0]='0';
				
				$game=new game([]);
				$game->auto('1','3','2',$this->level);
				
				for($i=0;$i<=2;$i++){
					$a[$i]=$i+1;
					$b[$i]=0;
				}$_SESSION['nnn'][0]=array($a,$b,$b);
				
				foreach($_SESSION['nn'] as $key =>$val){
					$val=explode(',',$val);
					 
					$nnn=$_SESSION['nnn'][$key];
					$nnn[$val[1]-1][$val[2]-1]=$nnn[$val[0]-1][$val[2]-1];
					$nnn[$val[0]-1][$val[2]-1]=0;
					$_SESSION['nnn'][$key+1]=$nnn;
					
					$_SESSION['autofrom'][$key+1]=$val[0]-1;
					$_SESSION['autoto'][$key+1]=$val[1]-1;
					$_SESSION['autobrick'][$key+1]=$val[2]-1;
				}
			}
		}
		public function error(){
			if($_SESSION['name']!=''){
				if($_SESSION['name']<>$this->name){
					return '請勿擅自更改姓名';
				}
				if($_SESSION['level']<>$this->level){
					return '請勿擅自更改難度';
				}
				if($_SESSION['level']<=$this->brick){
					return '不存在此盤子';
				}
				if($this->from>2||$this->to>2){
					return '不存在此棍子';
				}
			}
		}
		public function go(){
			if($_SESSION['name']!=''){
				if(!($_SESSION['name']==$this->name&&$_SESSION['level']==$this->level&&$_SESSION['from'][$_SESSION['count']]==$this->from&&$_SESSION['to'][$_SESSION['count']]==$this->to&&$_SESSION['brick'][$_SESSION['count']]==$this->brick)){
					if($this->from==$this->to){
						return false;
					}
					$box=$_SESSION['box'][$_SESSION['count']];
					$bar=$_SESSION['bar'][$_SESSION['count']];
					
					$fff='';
					$ttt='';
					
					$fff=$this->brick;
					foreach($box[$this->to] as $val){
						if($val!=0){
							if($ttt==''){
								$ttt=$val;
							}
						}
					}
					
					if($bar[$this->to] == '0' || $ttt>$fff){
						$_SESSION['count']++;
						
						$_SESSION['from'][$_SESSION['count']]=$this->from;
						$_SESSION['to'][$_SESSION['count']]=$this->to;
						$_SESSION['brick'][$_SESSION['count']]=$this->brick;
						
						$bar[$this->from]--;
						$bar[$this->to]++;
						$_SESSION['bar'][$_SESSION['count']]=$bar;
						
						$box[$this->to][$this->brick]=$box[$this->from][$this->brick];
						$box[$this->from][$this->brick]=0;
						$_SESSION['box'][$_SESSION['count']]=$box;
						
						if($_SESSION['bar'][$_SESSION['count']][2]==3){
							$_SESSION['over']='over';
						}
					}else{
						echo'<script>';
						echo'alert("上面盤子要大於下面盤子");';
						echo'location.href="game.php?nickname='.$_SESSION['name'].'&difficulty='.$_SESSION['level'].'&fromStackId='.$_SESSION['from'][$_SESSION['count']].'&toStackId='.$_SESSION['to'][$_SESSION['count']].'&brickId='.$_SESSION['brick'][$_SESSION['count']].'"';
						echo'</script>';
					}
				}
			}
		}
		public function back(){
			$_SESSION['count']--;
			header('location:game.php?nickname='.$_SESSION['name'].'&difficulty='.$_SESSION['level'].'&fromStackId='.$_SESSION['from'][$_SESSION['count']].'&toStackId='.$_SESSION['to'][$_SESSION['count']].'&brickId='.$_SESSION['brick'][$_SESSION['count']]);
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