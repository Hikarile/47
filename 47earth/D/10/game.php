<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <?php
		include("cd.php");
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
				header("location:game.php?nickname=".$_SESSION['name']."&difficulty=".$_SESSION['level']."&fromStackId=".$_SESSION['from'][$_SESSION['count']]."&toStackId=".$_SESSION['to'][$_SESSION['count']]."&brickId=".$_SESSION['brick'][$_SESSION['count']]);
				exit();
			}
		}
		
		$name=$_GET['nickname'];
		$level=$_GET['difficulty'];
		$from=$_GET['fromStackId'];
		$to=$_GET['toStackId'];
		$brick=$_GET['brickId'];
		
		$game=new game(['name'=>$name,'level'=>$level,'from'=>$from,'to'=>$to,'brick'=>$brick]);
		if($_SESSION['again']!=NULL || $_SESSION['auto']!=NULL){
			if($_SESSION['again']!=NULL ){
				if($_SESSION['again']==$_SESSION['count']){
					$_SESSION['stime']=date("H:i:s");
					$_SESSION['again']=NULL;
				}else{
					$_SESSION['again']++;
				}
			}
			if($_SESSION['auto']!=NULL){
				if($_SESSION['auto']==$_SESSION['allcount']){
					$_SESSION['auto']=NULL;
					$_SESSION['over']='over';
				}else{
					$_SESSION['auto']++;
				}
			}
		}else{
			$game->start();
			if(!($_POST['back']&&$_POST['again']&&$_POST['auto'])){
				$game->go();
			}
			if($_POST['back']){
				$game->back();
			}
			if($_POST['again']){
				$_SESSION['again']='0';
			}
			if($_POST['auto']){
				$_SESSION['auto']='0';
			}
		}
	?>
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/widgets.css" rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/scripts.js"></script>
    <script>
    	var again='<?=$_SESSION['again']?>';
		var auto='<?=$_SESSION['auto']?>';
		var over='<?=$_SESSION['over']?>';
		
		$(function(){
			if(over !=''){
				$(".success").removeAttr('hidden');
				setTimeout(function(){
					location.href='index.php';
				},1500);
			}
			
			$(".col").each(function(){
				$(this).find('div:not(:first)').mousedown(function(){
					alert('請選擇最上面的盤子');
				})
               $(this).find('div:first').draggable({revert:true});
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
			
			if(again!=''){
				time='<?=$_SESSION['time'][$_SESSION['again']]?>';
				setTimeout(function(){
					times();
				},1000*time);
			}else if(auto!=''){
				setTimeout(function(){
					times();
				},500);
			}
		})
		
		function btn(from,to){
			var brick=$("#stick"+from+" div:first").attr('data-id');
			$.ajax({
				url:"session.php",
				success: function(){
					location.change({
						fromStackId:from,
						toStackId:to,
						brickId:brick
					})
				}
			})
		}
		
		function times(){
			if(again!=''){
				var from='<?=$_SESSION['from'][$_SESSION['again']]?>';
				var to='<?=$_SESSION['to'][$_SESSION['again']]?>';
				var brick='<?=$_SESSION['brick'][$_SESSION['again']]?>';
			}else if(auto!=''){
				var from='<?=$_SESSION['autofrom'][$_SESSION['auto']]?>';
				var to='<?=$_SESSION['autoto'][$_SESSION['auto']]?>';
				var brick='<?=$_SESSION['autobrick'][$_SESSION['auto']]?>';
			}
			$.ajax({
				url:"session.php",
				success: function(){
					location.change({
						fromStackId:from,
						toStackId:to,
						brickId:brick
					})
				}
			})
		}
		
    </script>
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
                    if($_SESSION['again']!=NULL){
						$box=$_SESSION['box'][$_SESSION['again']];
						for($i=3;$i>=1;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=1;$j<=$_SESSION['level'];$j++){
								if($box[$i][$j]>0){
									$math=20*$box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
						}
					}else if($_SESSION['auto']!=NULL){
						$box=$_SESSION['nn'][$_SESSION['auto']];
						for($i=3;$i>=1;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=1;$j<=$_SESSION['level'];$j++){
								if($box[$i][$j]>0){
									$math=20*$box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
						}
					}else{
						$box=$_SESSION['box'][$_SESSION['count']];
						for($i=3;$i>=1;$i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($j=1;$j<=$_SESSION['level'];$j++){
								if($box[$i][$j]>0){
									$math=20*$box[$i][$j];
									echo "<div style='width:{$math}px;' class='brick' data-id='".$j."'></div>";
								}
							}
							echo'</div>';
						}
					}
					?>

                    <div class="clear moveButton">
                        <div class="col3">
                        	<input type="submit"  value="2" onClick="btn(3,2)">
                            <input type="submit"  value="1" onClick="btn(3,1)">
                        </div>
                        <div class="col3">
                        	<input type="submit"  value="3" onClick="btn(2,3)">
                            <input type="submit"  value="1" onClick="btn(2,1)">
                        </div>
                        <div class="col3">
                        	<input type="submit"  value="3" onClick="btn(1,3)">
                            <input type="submit"  value="2" onClick="btn(1,2)">
                        </div>
                    </div>

                </div>
                <div class="desc left">
                	<?php
                    if($_SESSION['auto']==NULL && $_SESSION['again']==NULL){
					echo'<a href="index.php" class="btn btn-secondary">回到設定頁面</a>';
					}
					?>
                </div>
            </div>
            <div class="module">
                <div class="mod">
                    <h4>暱稱</h4>
                    <h2><?=$_SESSION['name']?></h2>
                </div>
                <div class="mod" id="move">
                    <h4>移動次數</h4>
                    <h2><?=$_SESSION['count']?></h2>
                </div>
                <div class="mod">
                    <h4>最少移動次數</h4>
                    <h2><?=$_SESSION['allcount']?></h2>
                </div>
				 <div class="mod" id="asideFuncButtons">
                 	<?php
					if($_SESSION['auto']==NULL && $_SESSION['again']==NULL){
                    if($_SESSION['count']>0){
					?>
					<form method="post" id="back">
                    	<input type="submit" value="上一步" name="back">
                    </form>
                    <form method="post" id="again">
                    	<input type="submit" value="重播" name="again">
                    </form>
					<?php
					}else{
					?>
					<form method="post" id="auto">
                    	<input type="submit" value="自動解答" name="auto">
                    </form>
					<?php
					}
					}
					?>
				 </div>
            </div>
        </div>
    </div>
</body>

</html>