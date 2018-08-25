<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="js/jquery.js"></script>
<script src="js/js.js"></script>
<style>
	.body{
		width:1210px;
		height:700px;
		position:relative;
	}
	.top{
		width:800px;
		height:100px;
		float:left;
		text-align:left;
	}
	.down{
		width:800px;
		height:600px;
		float:left;
		border:#000 solid 3px;
	}
	.left{
		width:200px;
		height:700px;
		text-align:center;
		float:left;
	}
	.right{
		width:200px;
		height:700px;
		text-align:center;
		float:right;
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
	}
	.top_box:hover{
		border:#69F solid 3px;
	}
	.left_box:hover{
		border:#69F solid 3px;
	}
	.aaa{
		border:#000 solid 3px;
	}
	
	.btn{
		width:80%;
		height:60px;
		border:#36F solid 3px;
		background-color:#69F;
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
            	<img draggable="false" class="left_box" type="shape" p_shape="no" src="img/no.php">
                <img draggable="false" class="left_box" type="shape" p_shape="general" src="img/general.php">
                <img draggable="false" class="left_box" type="shape" p_shape="line" src="img/line.php">
                <img draggable="false" class="left_box" type="shape" p_shape="arc" src="img/arc.php">
                <img draggable="false" class="left_box" type="shape" p_shape="three" src="img/four.php">
                <img draggable="false" class="left_box" type="shape" p_shape="four" src="img/three.php">
                <img draggable="false" class="left_box" type="shape" p_shape="six" src="img/six.php">
                <img draggable="false" class="left_box" type="shape" p_shape="star" src="img/star.php">
            </div>
        	<div id="btn">
            	<input type="button" value="重播" class="btn" name="again">
            </div>
        </div>
        <div class="top">
        	<div id="color">
            	<div class="top_box" p_color="black" style="background-color:black;"></div>
                <div class="top_box" p_color="white" style="background-color:white;"></div>
                <div class="top_box" p_color="purple" style="background-color:purple;"></div>
                <div class="top_box" p_color="blue" style="background-color:blue;"></div>
                <div class="top_box" p_color="green" style="background-color:green;"></div>
                <div class="top_box" p_color="yellow" style="background-color:yellow;"></div>
                <div class="top_box" p_color="pink" style="background-color:pink;"></div>
                <div class="top_box" p_color="orange" style="background-color:orange;"></div>
                <div class="top_box" p_color="red" style="background-color:red;"></div>
            </div>
        	<div id="line">
            	<div class="top_box" p_line="1">
                	<div style="width:4px; height:4px; margin-top:13px; margin-left:13px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="3">
                	<div style="width:7px; height:7px; margin-top:12px; margin-left:12px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="5">
                	<div style="width:10px; height:10px; margin-top:10px; margin-left:10px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="7">
                	<div style="width:13px; height:13px; margin-top:9px; margin-left:9px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="9">
                	<div style="width:16px; height:16px; margin-top:7px; margin-left:7px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="11">
                	<div style="width:19px; height:19px; margin-top:6px; margin-left:6px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="13">
                	<div style="width:22px; height:22px; margin-top:4px; margin-left:4px; background-color:#000;"></div>
                </div>
                <div class="top_box" p_line="15">
                	<div style="width:25px; height:25px; margin-top:3px; margin-left:3px; background-color:#000;"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div id="shape">
                <img draggable="false" class="left_box" type="ill" p_shape="png1" src="png/4good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png2" src="png/good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png3" src="png/小光.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png4" src="png/幻影承恩.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png5" src="png/失落敬恆.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png6" src="png/光傑.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png7" src="png/超good.png">
                <img draggable="false" class="left_box" type="ill" p_shape="png8" src="png/變態承恩.png">
            </div>
        	<div id="dtn">
            	<input type="button" value="存成圖片檔" class="btn" id="save1">
                <input type="button" value="存成可編輯檔" class="btn" id="save2"><br/>
                <a id="download"></a>
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