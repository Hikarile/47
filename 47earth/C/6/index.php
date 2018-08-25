<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="js/jquery.js"></script>
<script src="js/js.js"></script>
<style>
	.body{
		position:relative;
		width:1210px;
		height:705px;
	}
	.left{
		width:200px;
		height:700px;
		float:left;
	}
	.top{
		width:800px;
		height:100px;
		float:left;
		text-align:left;
	}
	.right{
		width:200px;
		height:700px;
		float:right;
	}
	.down{
		width:800px;
		height:600px;
		float:left;
		border:#000 solid 3px;
	}
	
	.top_box{
		width:30px;
		height:30px;
		border:#CCC solid 3px;
		margin-top:7px;
		margin-left:20px;
		display:inline-block;
	}
	.left_box{
		width:70px;
		height:70px;
		border:#CCC solid 3px;
		margin-top:10px;
	}
	.top_box:hover{
		border:#69F solid 3px;
	}
	.left_box:hover{
		border:#69F solid 3px;
	}
	
	.btn{
		width:80%;
		height:60px;
		border:#36F solid 4px;
		background-color:#69F;
		font-size:23px;
		margin-top:10px;
	}
	.btn:hover{
		background-color:#96F;
	}
	
	.aaa{
		border:#000 solid 3px;
	}
</style>
</head>

<body>
	<center><h1><div class="body">
    	<div class="left">
        	<div id="shape">
            	<img class="left_box" type="shape" shape="no" src="img/no.php">
                <img class="left_box" type="shape" shape="general" src="img/general.php">
                <img class="left_box" type="shape" shape="line" src="img/line.php">
                <img class="left_box" type="shape" shape="arc" src="img/arc.php">
                <img class="left_box" type="shape" shape="three" src="img/four.php">
                <img class="left_box" type="shape" shape="four" src="img/three.php">
                <img class="left_box" type="shape" shape="six" src="img/six.php">
                <img class="left_box" type="shape" shape="star" src="img/star.php">
            </div>
            <div id="btn">
            	<input type="button" id="again" class="btn" value="重播">
            </div>
        </div>
    	<div class="top">
        	<div id="color">
            	<div class="top_box" color="black" style="background-color:black;"></div>
                <div class="top_box" color="white" style="background-color:white;"></div>
                <div class="top_box" color="purple" style="background-color:purple;"></div>
                <div class="top_box" color="blue" style="background-color:blue;"></div>
                <div class="top_box" color="green" style="background-colorgreen;"></div>
                <div class="top_box" color="yellow" style="background-color:yellow;"></div>
                <div class="top_box" color="pink" style="background-color:pink;"></div>
                <div class="top_box" color="orange" style="background-color:orange;"></div>
                <div class="top_box" color="red" style="background-color:red;"></div>
            </div>
            <div id="line">
            	<div class="top_box" line="1">
                	<div style="width:4px; height:4px; background-color:#000; margin-top:13px; margin-left:13px;"></div>
                </div>
                <div class="top_box" line="3">
                	<div style="width:6px; height:6px; background-color:#000; margin-top:12px; margin-left:14px;"></div>
                </div>
                <div class="top_box" line="5">
                	<div style="width:8px; height:8px; background-color:#000; margin-top:11px; margin-left:11px;"></div>
                </div>
                <div class="top_box" line="7">
                	<div style="width:10px; height:10px; background-color:#000; margin-top:10px; margin-left:10px;"></div>
                </div>
                <div class="top_box" line="9">
                	<div style="width:12px; height:12px; background-color:#000; margin-top:9px; margin-left:9px;"></div>
                </div>
                <div class="top_box" line="11">
                	<div style="width:14px; height:14px; background-color:#000; margin-top:8px; margin-left:8px;"></div>
                </div>
                <div class="top_box" line="13">
                	<div style="width:16px; height:16px; background-color:#000; margin-top:7px; margin-left:7px;"></div>
                </div>
                <div class="top_box" line="15">
                	<div style="width:18px; height:18px; background-color:#000; margin-top:6px; margin-left:6px;"></div>
                </div>
            </div>
        </div>
        <div class="right">
        	<div id="shape">
            	<img class="left_box" type="ill" shape="img_1" src="png/4good.png">
                <img class="left_box" type="ill" shape="img_2" src="png/good.png">
                <img class="left_box" type="ill" shape="img_3" src="png/小光.png">
                <img class="left_box" type="ill" shape="img_4" src="png/幻影承恩.png">
                <img class="left_box" type="ill" shape="img_5" src="png/失落敬恆.png">
                <img class="left_box" type="ill" shape="img_6" src="png/光傑.png">
                <img class="left_box" type="ill" shape="img_7" src="png/超good.png">
                <img class="left_box" type="ill" shape="img_8" src="png/變態承恩.png">
            </div>
            <div id="btn">
            	<input type="button" class="btn" value="存成圖片檔" id="save1">
                <input type="button" class="btn" value="存成可編輯檔" id="save2">
                <a id="download" hidden></a>
                
                <input type="button" class="btn" value="載入可編輯檔" id="open1">
                <input type="file" id="open2" hidden style="width:0px; height:0px;">
            </div>
        </div>
        <div class="down">
        	<canvas id="canvas" width="800px" height="600px"></canvas>
        </div>
    </div></h1></center>
</body>
</html>