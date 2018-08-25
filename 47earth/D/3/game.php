<!DOCTYPE html>
<html><head>
<meta charset="UTF-8" />
<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	require_once("php.php");
	
	if($_SERVER['QUERY_STRING']==''){
		header("location: index.php");
		exit();
	}
	
	if($_SESSION['out']!=''){
		if($_SESSION['out']!='out'){
			$_SESSION['out']='out';
			header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['getfrom'][$_SESSION['mcount']]."&toStackId=".$_SESSION['getto'][$_SESSION['mcount']]."&brickId=".$_SESSION['getbrick'][$_SESSION['mcount']]);
			exit();
		}else{
			$_SESSION['out']='null';
		}
	}
	
	$mname=$_GET['nickname'];//名字
	$mlevel=$_GET['difficulty'];//難度
	$mfrom=$_GET['fromStackId'];//起始柱子
	$mto=$_GET['toStackId'];//結束柱子
	$mbrick=$_GET['brickId'];//方塊
	
	$game=new game(['mname'=>$mname,'mlevel'=>$mlevel,'mfrom'=>$mfrom,'mto'=>$mto,'mbrick'=>$mbrick]);
	if($_SESSION["auto"] != NULL || $_SESSION["again"] != NULL){//有按自動按鈕
		if($_SESSION["auto"] != NULL){
			if($_SESSION["auto"] == $_SESSION['allcount']){
				$_SESSION['stime']=date('H:i:s');
				$_SESSION["auto"]=NULL;
				
				$_SESSION['mfrom']=$_SESSION['getto'][$_SESSION['mcount']];
				$_SESSION['mto']=$_SESSION['getfrom'][$_SESSION['mcount']];
				$_SESSION['mbrick']=$_SESSION['getbrick'][$_SESSION['mcount']];
					
				header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['mfrom']."&toStackId=".$_SESSION['mto']."&brickId=".$_SESSION['mbrick']);
				exit();
			}else{
				$_SESSION["auto"]++;
			}
		}elseif($_SESSION["again"] != NULL){
			if($_SESSION["again"] == $_SESSION['acount']){
				$_SESSION['stime']=date('H:i:s');
				$_SESSION["again"]=NULL;
			}else{
				$_SESSION["again"]++;
			}
		}
	}else{
		$error=$game->error();
		if($error != ""){
			echo "<script>";
			echo "alert('".$error."');";
			echo 'location.href="index.php"';
			echo "</script>";
		}
		$game->start();
		if(!($_POST['back'] && $_POST['automatic'] && $_POST['again'])){
			$game->go();
		}
		if($_POST['back']){
			$game->back();
		}
		if($_POST['again']){
			$_SESSION['acount']=$_SESSION['mcount'];
			$_SESSION['again']='0';
		}
		if($_POST['automatic']){
			$_SESSION["auto"]="0";
		}
	}
	
?>
<link href="css/style.css" rel="stylesheet" />
<link href="css/widgets.css" rel="stylesheet" />
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
	var aut='<?=$_SESSION['auto']?>';
	var again='<?=$_SESSION['again']?>';
	var over='<?=$_SESSION['over']?>';
	
	$(function(){
		if(over != ''){
			$(".success").removeAttr('hidden');
			setTimeout(function(){
				location.href='index.php';
			}, 1500);
		}
		
		$('.col').each(function(){
			$(this).find('.brick:not(:first)').mousedown(function(){
				alert('此盤子不再最上面');
			});
			$(this).find('.brick:first').draggable({revert:true});
		})
		$('.col').droppable({
			drop:function(e,u){
				var t=$(this);
				var drag=u.draggable;
				$.ajax({
					url:'session.php',
					success:function(){
						location.change({
							fromStackId:drag.parent().data('id'),
							toStackId:	t.data('id'),
							brickId:	drag.data('id')
						});
					}
				})
			}
		});
		
		$("#automatic,#again,#back").submit(function(){
			$.ajax({
				url:'session.php',
			})
		})
		
		if(aut != ''){
			setTimeout(function(){
				submitFun()
			}, 500);
		}else if(again != ''){
			var time='<?=$_SESSION['time'][$_SESSION['again']]?>';
			setTimeout(function(){
				submitFun()
			},time*1000);
		}
	});
	
	function btn(from,to){
		var col='';
		brick=$("#stick"+from+" div:first").attr('data-id');
		
		if(brick != undefined){
			$.ajax({
				url:'session.php',
				success:function(){
					location.change({
						fromStackId:from,
						toStackId:	to,
						brickId:	brick
					});
				}
				
			})
		}
	}
	
	function submitFun(){
		if(aut != ''){
			var name='<?=$_SESSION['mname']?>';
			var level='<?=$_SESSION['mlevel']?>';
			var form='<?=$_SESSION['autofrom'][$_SESSION["auto"]]?>';
			var to='<?=$_SESSION['autoto'][$_SESSION["auto"]]?>';
			var brick='<?=$_SESSION['autobrick'][$_SESSION["auto"]]?>';
		}
		if(again != ''){
			var name='<?=$_SESSION['mname']?>';
			var level='<?=$_SESSION['mlevel']?>';
			var form='<?=$_SESSION['getfrom'][$_SESSION['again']]?>';
			var to='<?=$_SESSION['getto'][$_SESSION['again']]?>';
			var brick='<?=$_SESSION['getbrick'][$_SESSION['again']]?>';
		}
		location.href='game.php?nickname='+name+'&difficulty='+level+'&fromStackId='+form+'&toStackId='+to+'&brickId='+brick;
	}
</script>
<script src="js/scripts.js"></script>
<title>河內塔</title>
</head>
<body onSelectStart="event.returnValue=false">
    <div hidden class="success">
        <div class="container">
            <div class="message">
				遊戲成功!
            </div>
        </div>
    </div>
    
	<div id="container-game" class="gameRunning">
		<div class="module">
			<?php
			foreach($_SESSION['autobrick'] as $key =>$val){
				if($key!='0'){
					$bick=$val++;
					$from=$_SESSION['autofrom'][$key];
					$to=$_SESSION['autoto'][$key];
					echo'<span>'.$bick.'號盤子:'.$from.'->'.$to.'</span><p>&nbsp;<p/>';
				}
			}
			?>
		</div>
        <div class="row">
            <div class="layout">
                <h2>河內塔</h2>

                <div class="game">
                    <div class="clear colNumber">
                        <div class="col3">
                            <span>3</span>
                        </div>
                        <div class="col3">
                            <span>2</span>
                        </div>
                        <div class="col3">
                            <span>1</span>
                        </div>
                    </div>
                    
                    <?php
					if($_SESSION["auto"]!=NULL){
						$box=$_SESSION['nnn'][$_SESSION['auto']];
						for($i=2; $i>=0; $i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($y=0;$y<$_SESSION['mlevel'];$y++){
								if($box[$i][$y]>0){
									$math=20 * $box[$i][$y];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$y."'></div>";
								}
							}
							echo "</div>";
						}
					}else if($_SESSION["again"]!=NULL){
						$box=$_SESSION['box'][$_SESSION["again"]];
						for($i=2; $i>=0; $i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($y=0;$y<$_SESSION['mlevel'];$y++){
								if($box[$i][$y]>0){
									$math=20 * $box[$i][$y];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$y."'></div>";
								}
							}
							echo "</div>";
						}
					}else{
						$box=$_SESSION['box'][$_SESSION['mcount']];
						for($i=2; $i>=0; $i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($y=0;$y<$_SESSION['mlevel'];$y++){
								if($box[$i][$y]>0){
									$math=20 * $box[$i][$y];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$y."'></div>";
								}
							}
							echo "</div>";
						}
					}
					?>
                    
                    <div class="clear moveButton">
                        <div class="col3">
                            <input type="submit" value="2" data="2" onClick="btn(2,1)">
                            <input type="submit" value="1" data="2" onClick="btn(2,0)">
                        </div>
                        <div class="col3">
                            <input type="submit" value="3" data="1" onClick="btn(1,2)">
                            <input type="submit" value="1" data="1" onClick="btn(1,0)">
                        </div>
                        <div class="col3">
                            <input type="submit" value="3" data="0" onClick="btn(0,2)">
                            <input type="submit" value="2" data="0" onClick="btn(0,1)">
                        </div>
                    </div>

                </div>
                <div class="desc left">
                    <a href="index.php" class="btn btn-secondary">回到設定頁面</a>
                </div>
            </div>
            <div class="module">
            	
                <div class="mod">
                    <h4>暱稱</h4>
                    <h2><?=$_GET['nickname']?></h2>
                </div>
                
                <div class="mod" id="move">
                    <h4>移動次數</h4>
                    <h2><?=$_SESSION['mcount']?></h2>
                </div>
				
				<div class="mod">
                    <h4>最短移動次數</h4>
                    <h2><?=$_SESSION['allcount']?></h2>
                </div>
                
				<div class="mod" id="asideFuncButtons">
                <?php if($_SESSION['mcount']>0){?>
					<form method="post" id="back">
						<input name="back" type="submit" value="上一步">
					</form>
					<form method="post" id="again">
						<input name="again" type="submit" value="重播">
					</form>
                <?php }else{
				?>
					<form method="post" id="automatic">
						<input name="automatic" type="submit" value="自動解答">
					</form>
				<?php
				}?>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>