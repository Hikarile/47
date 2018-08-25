<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>小畫家</title>
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
	.on{
		float:left;
		width:800px;
		height:100px;
		text-align:left;
	}
	.down{
		width:800px;
		height:600px;
		border:#000 solid 3px;
		float:left;
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
		margin-left:20px;
		margin-top:5px;
		width:30px;
		height:30px;
		display:inline-block;
	}
	.left_box:hover{
		margin-top:10px;
		border:#69F solid 4px;
		width:70px;
		height:70px;
	}
	.active {
		border:#000 solid 4px;
	}
	
	
	.btn{
		padding:5px;
		margin-top:20px;
		border:#06F solid 3px;
		background-color:#69F;
		width:150px;
		height:50px;
		font-size:18px;
	}
	.btn:hover{
		background-color:#96F;
		font-size:23px;
	}
	.open{
		opacity:0;
		width:0px;
		height:0px;
	}
</style>
<script src="js/jquery.js"></script>
<script src="js/shapes.js"></script>
</head>

<body>
    <center><h1>
        <div class="body">
            
            <div class="left">
            	<div id="shape">
                	<img draggable="false" class="left_box" type="shape" p_shape="nono" src="png/arrow.php">
                	<img draggable="false" class="left_box" type="shape" p_shape="general" src="png/general.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="line" src="png/line.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="round" src="png/round.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="rectangle" src="png/rectangle.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="polygon" src="png/polygon.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="triangle" src="png/triangle.php">
                    <img draggable="false" class="left_box" type="shape" p_shape="star" src="png/star.php">
                </div>
                <div id="btn" style="margin-top:20px;">
                    <input class="btn" type="button" value="重播" id="reappear">
                </div>
            </div>
            
            <div class="on">
                <div id="colors">
                	<div p_color="black" class="top_box" style="background-color:black;"></div>
                    <div p_color="white" class="top_box" style="background-color:white;"></div>
                    <div p_color="blue" class="top_box" style="background-color:blue;"></div>
                    <div p_color="green" class="top_box" style="background-color:green;"></div>
                    <div p_color="orange" class="top_box" style="background-color:orange;"></div>
                    <div p_color="pink" class="top_box" style="background-color:pink;"></div>
                    <div p_color="purple" class="top_box" style="background-color:purple;"></div>
                    <div p_color="red" class="top_box" style="background-color:red;"></div>
                    <div p_color="yellow" class="top_box" style="background-color:yellow;"></div>
                </div>
                <div id="thickness">
                	<div p_width="1" class="top_box">
                        <div style="margin-top:12px; margin-left:12px; width:6px; height:6px; background-color:black;"></div>
                    </div>
                    <div p_width="3" class="top_box">
                        <div style="margin-top:11px; margin-left:11px; width:8px; height:8px; background-color:black;"></div>
                    </div>
                    <div p_width="7" class="top_box">
                        <div p_width="5" style="margin-top:10px; margin-left:10px; width:10px; height:10px; background-color:black;"></div>
                    </div>
                    <div p_width="9" class="top_box">
                        <div style="margin-top:9px; margin-left:9px; width:12px; height:12px; background-color:black;"></div>
                    </div>
                    <div p_width="11" class="top_box">
                        <div style="margin-top:8px; margin-left:8px; width:14px; height:14px; background-color:black;"></div>
                    </div>
                    <div p_width="13" class="top_box">
                        <div style="margin-top:7px; margin-left:7px; width:16px; height:16px; background-color:black;"></div>
                    </div>
                    <div p_width="15" class="top_box">
                        <div style="margin-top:6px; margin-left:6px; width:18px; height:18px; background-color:black;"></div>
                    </div>
                </div>
            </div>
            
            <div class="right" id="test">
            	<div id="shape">
                	<img draggable="false" class="left_box" type="illustration" p_shape="img_1" src="img/4good.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_2" src="img/good.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_3" src="img/小光.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_4" src="img/幻影承恩.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_5" src="img/失落敬恆.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_6" src="img/吃貨重任.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_7" src="img/超good.jpg">
                    <img draggable="false" class="left_box" type="illustration" p_shape="img_8" src="img/變態承恩.jpg">
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
            	<canvas width="800" height="600" id="canvasid">您的瀏覽器不支援畫布功能</canvas>
            </div>
        </div>
    </h1></center>
</body>
</html>