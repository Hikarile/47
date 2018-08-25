<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<?php
	session_start();
	error_reporting(E_ALL &~ E_NOTICE);
	
	if($_SESSION['mname']!=''){
		session_destroy();
	}
?>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/widgets.css" rel="stylesheet"/>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/scripts.js"></script>
<title>河內塔</title>
</head>

<body>
    <div id="container-game" style="width:620px !important">
        <div class="row">
            <div class="layout">
                <h2>河內塔</h2>
                <fieldset id="rule">
                    <legend>遊戲規則</legend>
                    <div>有三根竿子，例如由右至左編號分別為1、2和3，竿子上面可串中空圓盤。<br/>於竿子1放入N個盤子開始，盤子由下至上變小。 一次只能移動一個盤子。<br/>大盤子不能再小盤子上面。<br/>目標將全部盤子移動到竿子3。
                    </div>
                </fieldset>
                <div class="game" style="margin-top:10px">
                    <form method="get" action="game.php">
                        <div class="row">
                            <label for="nickname">暱稱</label>
                            <input type="text" id="nickname" name="nickname" required/>
                        </div>
                        <div class="row">
                            <label for="difficulty">難易度</label>
                            <select id="difficulty" name="difficulty">
								<?php
								for($i=3;$i<=10;$i++){
									echo'<option value="'.$i.'">'.$i.'</option>';
								}
								?>
                            </select>
                        </div>
                        <button type="submit" style="margin-left:113px">開始遊戲</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>