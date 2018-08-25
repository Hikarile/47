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
		height:700px;
	}
	.top{
		width:800px;
		height:100px;
		float:left;
		text-align:left;
	}
	.left{
		width:200px;
		height:700px;
		float:left;
		
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
		margin-left:15px;
		display:inline-block;
	}
	.lr_box{
		width:70px;
		height:70px;
		border:#CCC solid 3px;
		margin-top:20px;
	}
	.top_box:hover{
		border:#69F solid 3px;
	}
	.lr_box:hover{
		border:#69F solid 3px;
	}
	
	.aaa{
		border:#000 solid 3px;
	}
	
	.btn{
		width:80%;
		height:60px;
		background-color:#69F;
		border:#39F solid 4px;
		font-size:23px;
		margin-top:20px;
	}
	.btn:hover{
		background-color:#96F;
	}
	
</style>
</head>

<body>
	<center><h1><div class="body">
    	<div class="left">
        	<div id="shape">
            	<img class="lr_box" type="shape" shape="no" src="img/no.php">
                <img class="lr_box" type="shape" shape="general" src="img/general.php">
                <img class="lr_box" type="shape" shape="line" src="img/line.php">
                <img class="lr_box" type="shape" shape="arc" src="img/arc.php">
                <img class="lr_box" type="shape" shape="three" src="img/three.php">
                <img class="lr_box" type="shape" shape="four" src="img/four.php">
                <img class="lr_box" type="shape" shape="six" src="img/six.php">
                <img class="lr_box" type="shape" shape="star" src="img/star.php">
            </div>
            <div id="btn">
            	<input type="button" value="重播" class="btn" id="again">
            </div>
        </div>
        <div class="top">
        	<div id="color">
            	<div class="top_box" color="black" style="background-color:black"></div>
                <div class="top_box" color="white" style="background-color:white"></div>
                <div class="top_box" color="purple" style="background-color:purple"></div>
                <div class="top_box" color="blue" style="background-color:blue"></div>
                <div class="top_box" color="green" style="background-color:green"></div>
                <div class="top_box" color="yellow" style="background-color:yellow"></div>
                <div class="top_box" color="pink" style="background-color:pink"></div>
                <div class="top_box" color="orange" style="background-color:orange"></div>
                <div class="top_box" color="red" style="background-color:red"></div>
            </div>
            <div id="line">
            	<div class="top_box" line="1">
                	<div style="width:2px; height:2px; margin-top:14px; margin-left:14px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="3">
                	<div style="width:4px; height:4px; margin-top:13px; margin-left:13px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="5">
                	<div style="width:6px; height:6px; margin-top:15px; margin-left:15px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="7">
                	<div style="width:8px; height:8px; margin-top:14px; margin-left:14px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="9">
                	<div style="width:10px; height:10px; margin-top:10px; margin-left:10px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="11">
                	<div style="width:12px; height:12px; margin-top:9px; margin-left:9px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="13">
                	<div style="width:14px; height:14px; margin-top:8px; margin-left:8px; background-color:#000;"></div>
                </div>
                <div class="top_box" line="15">
                	<div style="width:16px; height:16px; margin-top:7px; margin-left:7px; background-color:#000;"></div>
                </div>
            </div>
        </div>
        <div class="right">
        	<div id="shape">
            	<img class="lr_box" type="ill" ill="img1" src="png/4good.png">
                <img class="lr_box" type="ill" ill="img2" src="png/good.png">
                <img class="lr_box" type="ill" ill="img3" src="png/小光.png">
                <img class="lr_box" type="ill" ill="img4" src="png/幻影承恩.png">
                <img class="lr_box" type="ill" ill="img5" src="png/失落敬恆.png">
                <img class="lr_box" type="ill" ill="img6" src="png/光傑.png">
                <img class="lr_box" type="ill" ill="img7" src="png/超good.png">
                <img class="lr_box" type="ill" ill="img8" src="png/變態承恩.png">
            </div>
            <div id="btn">
            	<input type="button" value="存成圖片檔" class="btn" id="save1">
                <input type="button" value="存成可編輯檔" class="btn" id="save2">
                <a id="download" hidden></a>
                <input type="button" value="載入可編輯檔" class="btn" id="open1"><br/>
                <input type="file" id="open2" style="width:0px; height:0px;">
            </div>
        </div>
        <div class="down">
        	<canvas id="canvas" width="800px" height="600px"></canvas>
        </div>
    </div></h1></center>
</body>
</html>