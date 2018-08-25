<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <?php
    	include('cd.php');
		require_once('php.php');
		
		if($_SERVER['QUERY_STRING']==''){
			header('location:index.php');
			exit();
		}
		
		if($_SESSION['out']!=''){
			if($_SESSION['out']=='out'){
				$_SESSION['out']='null';
			}else{
				$_SESSION['out']='out';
				header('location:game.php?nickname='.$_SESSION['mname'].'&difficulty='.$_SESSION['mlevel'].'&fromStackId='.$_SESSION['getfrom'][$_SESSION['mcount']].'&toStackId='.$_SESSION['getto'][$_SESSION['mcount']].'&brickId='.$_SESSION['getbrick'][$_SESSION['mcount']]);
				exit();
			}
		}
		
		$mname=$_GET['nickname'];//名字
		$mlevel=$_GET['difficulty'];//難度
		$mfrom=$_GET['fromStackId'];//起始柱子
		$mto=$_GET['toStackId'];//結束柱子
		$mbrick=$_GET['brickId'];//方塊
		
		$game=new game(['mname'=>$mname,'mlevel'=>$mlevel,'mfrom'=>$mfrom,'mto'=>$mto,'mbrick'=>$mbrick]);
		if($_SESSION['again']!=NULL || $_SESSION['auto']!=NULL){
			if($_SESSION['auto']!=NULL){
				if($_SESSION["auto"] == $_SESSION['allcount']){
					$_SESSION['stime']=date('H:i:s');
					$_SESSION["auto"]=NULL;
					
					header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['getto'][$_SESSION['mcount']]."&toStackId=".$_SESSION['getfrom'][$_SESSION['mcount']]."&brickId=".$_SESSION['getbrick'][$_SESSION['mcount']]);
				}else{
					$_SESSION["auto"]++;
				}
			}else if($_SESSION['again']!=NULL){
				if($_SESSION["again"] == $_SESSION['acount']){
					$_SESSION['stime']=date('H:i:s');
					$_SESSION["again"]=NULL;
				}else{
					$_SESSION["again"]++;
				}
			}
		}else{
			$error=$game->error();
			if($error!=''){
				echo'<script>';
				echo'alert("'.$error.'");';
				echo'location.href="index.php"';
                echo'</script>';
			}
			$game->start();
			if(!($_POST['back']&&$_POST['automatic']&&$_POST['again'])){
				$game->go();
			}
			if($_POST['back']){
				$game->back();
			}
			if($_POST['auto']){
				$_SESSION['auto']='0';
			}
			if($_POST['again']){
				$_SESSION['acount']=$_SESSION['mcount'];
				$_SESSION['again']='0';
			}
		}
	?>
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/widgets.css" rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script>
		var auto='<?=$_SESSION['auto']?>';
		var again='<?=$_SESSION['again']?>';
		var over='<?=$_SESSION['over']?>';
		
		$(function(){
			if(over != ''){
				$(".success").removeAttr('hidden');
				setTimeout(function(){
					location.href='index.php';
				},1500)
			}
			
			$(".col").each(function(){
				$(this).find('.brick:not(:first)').mousedown(function(){
					alert('此盤子不再最上面');
				});
                $(this).find('.brick:first').draggable({revert:true});
            });
			$('.col').droppable({
				drop:function(e,u){
					var t=$(this);
					var drag=u.draggable;
					$.ajax({
						url:"session.php",
						success: function(){
							location.change({
								fromStackId:drag.parent().data('id'),
								toStackId:	t.data('id'),
								brickId:	drag.data('id')
							});
						}
					})
				}
			});
			
			$("#back,#again,#auto").submit(function(){
				$.ajax({
					url:"session.php"
				})
			})
			
			if(auto != ''){	
				setTimeout(function(){
					times();
				},500);
			}else if(again != ''){
				var time='<?=$_SESSION['time'][$_SESSION['again']]?>';
				setTimeout(function(){
					times();
				},time*1000);
			}
		})
		function btn(from,to){
			var brick=$("#stick"+from+" div:first").attr('data-id');
			$.ajax({
				url:"session.php",
				success: function(){
					location.change({
					fromStackId:from,
					toStackId:	to,
					brickId:	brick
				});
				}
			})
		}
		function times(){
			if(auto!=''){
				var name='<?=$_SESSION['mname']?>';
				var level='<?=$_SESSION['mlevel']?>';
				var from='<?=$_SESSION['autofrom'][$_SESSION["auto"]]?>';
				var to='<?=$_SESSION['autoto'][$_SESSION["auto"]]?>';
				var brick='<?=$_SESSION['autobrick'][$_SESSION["auto"]]?>';
			}else if(again!=''){
				var name='<?=$_SESSION['mname']?>';
				var level='<?=$_SESSION['mlevel']?>';
				var from='<?=$_SESSION['getfrom'][$_SESSION["again"]]?>';
				var to='<?=$_SESSION['getto'][$_SESSION["again"]]?>';
				var brick='<?=$_SESSION['getbrick'][$_SESSION["again"]]?>';
			}
			location.href='game.php?nickname='+name+'&difficulty='+level+'&fromStackId='+from+'&toStackId='+to+'&brickId='+brick;
		}
    </script>
    <script src="js/scripts.js"></script>
    <title>河內塔</title>
</head>

<body>
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
        foreach($_SESSION['autobrick'] as $key=>$val){
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
                    if($_SESSION['auto']!=NULL){
						$box=$_SESSION['nnn'][$_SESSION['auto']];
						for($i=2;$i>=0;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=0;$j<$_SESSION['mlevel'];$j++){
								if($box[$i][$j]>0){
									$math=20 * $box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
						}
					}else if($_SESSION['again']!=NULL){
						$box=$_SESSION['box'][$_SESSION['again']];
						for($i=2;$i>=0;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=0;$j<$_SESSION['mlevel'];$j++){
								if($box[$i][$j]>0){
									$math=20 * $box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
						}
					}else{
						$box=$_SESSION['box'][$_SESSION['mcount']];
						for($i=2;$i>=0;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=0;$j<$_SESSION['mlevel'];$j++){
								if($box[$i][$j]>0){
									$math=20 * $box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
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
                    <h2><?=$_SESSION['mname']?></h2>
                </div>
                <div class="mod" id="move">
                    <h4>移動次數</h4>
                    <h2><?=$_SESSION['mcount']?></h2>
                </div>
                <div class="mod" id="move">
                    <h4>最少移動次數</h4>
                    <h2><?=$_SESSION['allcount']?></h2>
                </div>
				 <div class="mod" id="asideFuncButtons">
                 	<?php
                    if($_SESSION['mcount']!='0'){
					?>
					<form method="post" id="back">
                    	<input type="submit" name="back" value="上一步">
                    </form>
                    <form method="post" id="again">
                    	<input type="submit" name="again" value="重播">
                    </form>
					<?php
					}else{
					?>
					<form method="post" id="auto">
                    	<input type="submit" name="auto" value="自動解答">
                    </form>
					<?php	
					}
					?>
                    
				 </div>
            </div>
        </div>
    </div>
</body>

</html>