<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8" />
<?php
    error_reporting(E_ALL &~ E_NOTICE);
    session_start();
    require_once("php.php");
    
    if($_GET['nickname']==NULL && $_GET['difficulty']==NULL && $_GET['fromSackId']==NULL && $_GET['toSackId']==NULL && $_GET['brickId']==NULL){
        header('location:index.php');
    }
    
    $mname=$_GET['nickname'];//名字
    $mlevel=$_GET['difficulty'];//難度
    $mfrom=$_GET['fromStackId'];//起始柱子
    $mto=$_GET['toStackId'];//結束柱子
    $mbrick=$_GET['brickId'];//方塊
	
    $game=new game;
    if($_SESSION["auto"] != null || $_SESSION["again"] != null){
		if($_SESSION["auto"] != null){
			echo $_SESSION["auto"];
			if($_SESSION["auto"] == $_SESSION['allcount']){
				$_SESSION["auto"]=null;
				
				$_SESSION['mfrom']=$_SESSION['getto'][$_SESSION['mcount']];
				$_SESSION['mto']=$_SESSION['getfrom'][$_SESSION['mcount']];
				$_SESSION['mbrick']=$_SESSION['getbrick'][$_SESSION['mcount']];
				
				header("location:game.php?nickname=".$_SESSION['mname']."&difficulty=".$_SESSION['mlevel']."&fromStackId=".$_SESSION['mfrom']."&toStackId=".$_SESSION['mto']."&brickId=".$_SESSION['mbrick']);
			}else{
				$_SESSION["auto"]++;
			}
		}elseif($_SESSION["again"] != null){
			if($_SESSION["again"] == $_SESSION['acount']){
				$_SESSION["again"]=null;
			}else{
				$_SESSION["again"]++;
			}
		}
    }else{
        if($_GET['fromStackId'] == NULL){
			$error=$game->start($mlevel,$mfrom,$mto,$mbrick);
			if($error != ""){
				echo "<script>alert('".$error."');</script>";
			}
		}else{
			$error=$game->error($mname,$mlevel,$mfrom,$mto,$mbrick);
			if($error == ""){//一般移動
				if(!$_POST['back'] && !$_POST['automatic'] && !$_POST['again']){
					$game->go($mname,$mlevel,$mfrom,$mto,$mbrick);
				}
				if($_POST['back']){//上一步
					$game->back($mlevel,$mfrom,$mto,$mbrick);
				}
				if($_POST['automatic']){//自動
					$_SESSION["auto"]="0";
					
					$_SESSION['nn']=null;
					$_SESSION['nnn']=null;
					
					$_SESSION['autofrom']=null;
					$_SESSION['autoto']=null;
					$_SESSION['autobrick']=null;
					
					$_SESSION['autofrom'][]=0;
					$_SESSION['autoto'][]=0;
					$_SESSION['autobrick'][]=0;
					
					$game->automatic('1','3','2',$mlevel);
					
					for($i=0;$i<$mlevel;$i++){
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
				if($_POST['again']){//重播
					$_SESSION['acount']=$_SESSION['mcount'];
					$_SESSION['again']='0';
				}
			}else{
				echo "<script>";
				echo "alert('".$error."');";
				echo 'location.href="index.php"';
				echo "</script>";
			}
		}
    }
    
?>
<link href="css/style.css" rel="stylesheet" />
<link href="css/widgets.css" rel="stylesheet" />
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/scripts.js"></script>
<script>
	var aut='<?=$_SESSION["auto"]?>';
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
			$(this).find('.brick:first').draggable({revert:true});
		});
		$('.col').droppable({
			drop:	function(e,u){
				var t=$(this);
				var drag=u.draggable;
				window.sessionStorage.move='move';
				location.change({
					fromStackId:drag.parent().data('id'),
					toStackId:	t.data('id'),
					brickId:	drag.data('id')
				});
			}
		});
		
        if(aut != '' || again != ''){
			setTimeout(function(){
				submitFun()
			}, 500);
		}
    })
    
	function submitFun(){//自動,重播
		if(aut!=''){
			var name='<?=$_SESSION['mname']?>';
			var level='<?=$_SESSION['mlevel']?>';
			var from='<?=$_SESSION['autofrom'][$_SESSION["auto"]]?>';
			var to='<?=$_SESSION['autoto'][$_SESSION["auto"]]?>';
			var brick='<?=$_SESSION['autobrick'][$_SESSION["auto"]]?>';
		}else if(again != ''){
			var name='<?=$_SESSION['mname']?>';
			var level='<?=$_SESSION['mlevel']?>';
			var from='<?=$_SESSION['getfrom'][$_SESSION['again']]?>';
			var to='<?=$_SESSION['getto'][$_SESSION['again']]?>';
			var brick='<?=$_SESSION['getbrick'][$_SESSION['again']]?>';
		}
		location.href='game.php?nickname='+name+'&difficulty='+level+'&fromStackId='+from+'&toStackId='+to+'&brickId='+brick;
	}
	
	function btn(from,to){//移動方塊按鈕
		var col='';
		brick=$("#stick"+from+" div:first").attr('data-id');
		
		if(brick != undefined){
			window.sessionStorage.btn='btn';
			location.change({
				fromStackId:from,
				toStackId:	to,
				brickId:	brick
			});
		}
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
					if($_SESSION["auto"]!=null){
						$box=$_SESSION['nnn'][$_SESSION['auto']];
						for($i=2; $i>=0; $i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($y=0;$y<$_SESSION['mlevel'];$y++){
								if($box[$i][$y]>0){
									echo "<div class='brick b".$box[$i][$y]."' data-id='".$y."'></div>";
								}
							}
							echo "</div>";
						}
					}else if($_SESSION["again"]!=null){
						$box=$_SESSION['box'][$_SESSION["again"]];
						for($i=2; $i>=0; $i--){
							echo "<div id='stick".$i."' class='col' data-id=".$i.">";
							for($y=0;$y<$_SESSION['mlevel'];$y++){
								if($box[$i][$y]>0){
									echo "<div class='brick b".$box[$i][$y]."' data-id='".$y."'></div>";
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
									echo "<div class='brick b".$box[$i][$y]."' data-id='".$y."'></div>";
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
                    <h2><?=$_SESSION['mname']?></h2>
                </div>
                <div class="mod" id="move">
                    <h4>移動次數</h4>
                    <h2><?=$_SESSION['mcount']?></h2>
                </div>
				<?php if($_SESSION['mcount']>0 || $_SESSION["auto"]!=null){?>
                <div class="mod" id="asideFuncButtons">
                    <form method="post">
                    	<input name="back" type="submit" value="上一步">
                    </form>
                    <form method="post" id="automatic">
                    	<input name="automatic" type="submit" value="自動解答">
                    </form><p/>
                    <form method="post" id="again">
                    	<input name="again" type="submit" value="重播">
                    </form><p/>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>

</html>