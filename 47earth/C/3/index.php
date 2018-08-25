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
	.left{
		text-align:center;
		float:left;
		width:200px;
		height:700px;
	}
	.top{
		text-align:left;
		float:left;
		width:800px;
		height:100px;
	}
	.down{
		float:left;
		width:800px;
		height:600px;
		border:#000 solid 3px;
	}
	.right{
		float:right;
		width:200px;
		height:700px;
	}
	
	.top_box{
		border:#CCC solid 4px;
		margin-left:20px;
		margin-top:5px;
		width:30px;
		height:30px;
		display:inline-block;
	}
	.left_box{
		margin-top:10px;
		border:#CCC solid 4px;
		width:70px;
		height:70px;
	}
	.top_box:hover{
		border:#69F solid 4px;
	}
	.left_box:hover{
		border:#69F solid 4px;
	}
	
	.btn{
		border-radius:10px;
		margin-top:20px;
		width:80%;
		height:60px;
		border:#36F solid 5px;
		background-color:#69F;
		font-size:23px;
	}
	.btn:hover{
		background-color:#96F;
	}
	
	.open{
		width:0px;
		height:0px;
	}
	
	.active{
		border:#000 solid 4px;
	}
	
</style>
</head>

<body>
	<center><h1><div class="body">
    	<div class="left">
            <div id="shape">
                <img class="left_box" draggable="false" type="shape" p_shape="no" src="img/no.php">
                <img class="left_box" draggable="false" type="shape" p_shape="general" src="img/general.php">
                <img class="left_box" draggable="false" type="shape" p_shape="line" src="img/line.php">
                <img class="left_box" draggable="false" type="shape" p_shape="arc" src="img/arc.php">
                <img class="left_box" draggable="false" type="shape" p_shape="three" src="img/three.php">
                <img class="left_box" draggable="false" type="shape" p_shape="four" src="img/four.php">
                <img class="left_box" draggable="false" type="shape" p_shape="six" src="img/six.php">
                <img class="left_box" draggable="false" type="shape" p_shape="start" src="img/star.php">
            </div>
            <div id="btn" style="margin-top:20px;">
                <input class="btn" type="button" value="重播" id="reappear">
            </div>
        </div>
        <div class="top">
        	<div id="colors">
            	<div class="top_box" style="background-color:black" p_color="black"></div>
                <div class="top_box" style="background-color:witch" p_color="white"></div>
                <div class="top_box" style="background-color:purple" p_color="purple"></div>
                <div class="top_box" style="background-color:blue" p_color="blue"></div>
                <div class="top_box" style="background-color:green" p_color="green"></div>
                <div class="top_box" style="background-color:yellow" p_color="yellow"></div>
                <div class="top_box" style="background-color:pink" p_color="pink"></div>
                <div class="top_box" style="background-color:orange" p_color="orange"></div>
                <div class="top_box" style="background-color:red" p_color="red"></div>
            </div>
        	<div id="lines">
            	<div class="top_box" p_line="1">
                	<div style="width:3px; height:3px; margin-top:14px; margin-left:14px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="3">
                	<div style="width:6px; height:6px; margin-top:12px; margin-left:12px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="5">
                	<div style="width:9px; height:9px; margin-top:11px; margin-left:11px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="7">
                	<div style="width:12px; height:12px; margin-top:9px; margin-left:9px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="9">
                	<div style="width:15px; height:15px; margin-top:7px; margin-left:7px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="11">
                	<div style="width:18px; height:18px; margin-top:6px; margin-left:6px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="13">
                	<div style="width:21px; height:21px; margin-top:5px; margin-left:5px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="15">
                	<div style="width:24px; height:24px; margin-top:3px; margin-left:3px; background-color:#000;"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div id="shape">
                <img draggable="false" class="left_box" type="ill" p_shape="img1" src="png/4good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img2" src="png/good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img3" src="png/小光.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img4" src="png/幻影承恩.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img5" src="png/失落敬恆.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img6" src="png/光傑.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img7" src="png/超good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="img8" src="png/變態承恩.png">
            </div>
            <div id="btn" style="margin-top:20px;">
                <input class="btn" id="save_1" type="button" value="存成圖片檔">
                <input class="btn" id="save_2" type="button" value="存成可編輯檔">
                <a id="download" hidden></a>
                <input class="btn" id="open1" type="button" value="載入可編輯檔"><br/>
                <input class="open" id="open2" type="file">
            </div>
        </div>
        <div class="down">
        	<canvas id="canvas" height="600px" width="800px">您的瀏覽器不支援畫布功能</canvas>
        </div>
    </div></h1></center>
</body>
</html>