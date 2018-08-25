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
		float:left;
		width:800px;
		height:100px;
		text-align:left;
	}
	.down{
		float:left;
		width:800px;
		height:600px;
		border:#000 solid 2px;
	}
	.left{
		float:left;
		width:200px;
		height:700px;
		text-align:center;
	}
	.right{
		float:right;
		width:200px;
		height:700px;
		text-align:center;
	}
	
	.top_box{
		margin-top:7px;
		margin-left:20px;
		width:30px;
		height:30px;
		border:#CCC solid 4px;
		display:inline-block;
	}
	.left_box{
		margin-top:20px;
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
	.aa{
		border:#000 solid 4px;
	}
	
	.btn{
		width:80%;
		height:50px;
		background-color:#69F;
		border:#36F solid 5px;
		font-size:23px;
		margin-top:20px;
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
                <img class="left_box" draggable="false" type="shape" p_shape="four" src="img/three.php">
                <img class="left_box" draggable="false" type="shape" p_shape="three" src="img/four.php">
                <img class="left_box" draggable="false" type="shape" p_shape="six" src="img/six.php">
                <img class="left_box" draggable="false" type="shape" p_shape="star" src="img/star.php">
            </div>
            <div id="btn" style="margin-top:20px;">
                <input class="btn" type="button" value="重播" id="reappear">
            </div>
        </div>
        <div class="top">
        	<div id="colors">
            	<div class="top_box" p_color="black" style="background-color:black;"></div>
                <div class="top_box" p_color="witch" style="background-color:whate;"></div>
                <div class="top_box" p_color="purple" style="background-color:purple;"></div>
                <div class="top_box" p_color="blue" style="background-color:blue;"></div>
                <div class="top_box" p_color="green" style="background-color:green;"></div>
                <div class="top_box" p_color="yellow" style="background-color:yellow;"></div>
                <div class="top_box" p_color="pink" style="background-color:pink;"></div>
                <div class="top_box" p_color="orange" style="background-color:orange;"></div>
                <div class="top_box" p_color="red" style="background-color:red;"></div>
            </div>
            <div id="lines">
            	<div class="top_box" p_line="1">
                	<div style="width:2px; height:2px; background-color:#000; margin-top:14px; margin-left:14px;"></div>
                </div>
                <div class="top_box" p_line="3">
                	<div style="width:5px; height:5px; background-color:#000; margin-top:13px; margin-left:13px;"></div>
                </div>
                <div class="top_box" p_line="5">
                	<div style="width:8px; height:8px; background-color:#000; margin-top:11px; margin-left:11px;"></div>
                </div>
                <div class="top_box" p_line="7">
                	<div style="width:11px; height:11px; background-color:#000; margin-top:10px; margin-left:10px;"></div>
                </div>
                <div class="top_box" p_line="9">
                	<div style="width:14px; height:14px; background-color:#000; margin-top:8px; margin-left:8px;"></div>
                </div>
                <div class="top_box" p_line="11">
                	<div style="width:17px; height:17px; background-color:#000; margin-top:7px; margin-left:7px;"></div>
                </div>
                <div class="top_box" p_line="13">
                	<div style="width:20px; height:20px; background-color:#000; margin-top:5px; margin-left:5px;"></div>
                </div>
                <div class="top_box" p_line="15">
                	<div style="width:23px; height:23px; background-color:#000; margin-top:4px; margin-left:4px;"></div>
                </div>
            </div>
        </div>
        <div class="right">
        	<div id="shape">
                <img class="left_box" draggable="false" type="ill" p_shape="png1" src="png/4good.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png2" src="png/good.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png3" src="png/小光.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png4" src="png/幻影承恩.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png5" src="png/失落敬恆.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png6" src="png/光傑.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png7" src="png/超good.png">
                <img class="left_box" draggable="false" type="ill" p_shape="png8" src="png/變態承恩.png">
            </div>
            <div id="btn" style="margin-top:20px;">
            	<input type="button" value="存成圖片檔" class="btn" id="save1">
                <input type="button" value="存成可編輯檔" class="btn" id="save2"><br/>
                <a id="download" hidden></a>
                <input type="button" value="載入可編輯檔" class="btn" id="open1"><br/>
                <input type="file" id="open2" hidden>
            </div>
        </div>
        <div class="down">
        	<canvas id="canvas" width="800px" height="600px"></canvas>
        </div>
    </div></h1></center>
</body>
</html>