<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/script.js"></script>
<style>
	.body{
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
		border:#000 solid 3px;
		float:left;
	}
	
	.topbox{
		width:30px;
		height:30px;
		border:#CCC solid 3px;
		display:inline-block;
		margin-left:20px;
		margin-top:5px;
	}
	.topbox:hover{
		border:#69F solid 3px;
	}
	.lbox{
		width:70px;
		height:70px;
		border:#CCC solid 3px;
		display:inline-block;
		margin-top:20px;
	}
	.lbox:hover{
		border:#69F solid 3px;
	}
	.btn{
		width:80%;
		height:70px;
		background-color:#69F;
		border:#96F solid 3px;
		font-size:21px;
		margin-top:20px;
	}
	.btn:hover{
		background-color:#06F;
	}
	
	.cl{
		border:#000 solid 3px;
	}
</style>
</head>

<body>
	<center><h1>
    	<div class="body">
            <div class="left">
            	<div id="img">
                	<img class="lbox" width="70px" height="70px" type="shape" shape="no" src="img/no.png">
                	<img class="lbox" width="70px" height="70px" type="shape" shape="g" src="img/g.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="line" src="img/line.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="arc" src="img/arc.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="three" src="img/three.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="four" src="img/four.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="six" src="img/five.png">
                    <img class="lbox" width="70px" height="70px" type="shape" shape="star" src="img/star.png">
                </div>
                <div>
                	<input type="button" value="重播" id="again" class="btn">
                </div>
            </div>
            <div class="top">
            	<div id="color">
                	<div class="topbox" style="background-color:black;" color="black"></div>
                    <div class="topbox" style="background-color:white;" color="white"></div>
                    <div class="topbox" style="background-color:purple;" color="purple"></div>
                    <div class="topbox" style="background-color:blue;" color="blue"></div>
                    <div class="topbox" style="background-color:green;" color="green"></div>
                    <div class="topbox" style="background-color:yellow;" color="yellow"></div>
                    <div class="topbox" style="background-color:pink;" color="pink"></div>
                    <div class="topbox" style="background-color:orange;" color="orange"></div>
                    <div class="topbox" style="background-color:red;" color="red"></div>
                </div>
                <div id="line">
                	<div class="topbox" line="2">
                    	<div style="width:2px; height:2px; margin-top:14px; margin-left:14px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="4">
                    	<div style="width:4px; height:4px; margin-top:13px; margin-left:13px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="6">
                    	<div style="width:6px; height:6px; margin-top:12px; margin-left:12px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="8">
                    	<div style="width:8px; height:8px; margin-top:11px; margin-left:11px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="10">
                    	<div style="width:10px; height:10px; margin-top:10px; margin-left:10px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="12">
                    	<div style="width:12px; height:12px; margin-top:9px; margin-left:9px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="14">
                    	<div style="width:14px; height:14px; margin-top:8px; margin-left:8px; background-color:#000;"></div>
                    </div>
                    <div class="topbox" line="16">
                    	<div style="width:16px; height:16px; margin-top:7px; margin-left:7px; background-color:#000;"></div>
                    </div>
                </div>
            </div>
            <div class="right">
            	<div id="img">
                	<img class="lbox" width="70px" height="70px" type="ill" ill="png1" src="img/1.png">
                	<img class="lbox" width="70px" height="70px" type="ill" ill="png2" src="img/4good.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png3" src="img/c0.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png4" src="img/good.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png5" src="img/失落敬恆.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png6" src="img/光傑.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png7" src="img/超good.jpg">
                    <img class="lbox" width="70px" height="70px" type="ill" ill="png8" src="img/變態承恩.jpg">
                </div>
                <div>
                	<input type="button" value="儲存成圖片檔" id="save1" class="btn">
                    <input type="button" value="儲存成可編輯檔" id="save2" class="btn">
                    <a id="download" hidden></a>
                    
                    <input type="button" value="開啟可編輯檔" id="open1" class="btn"><br/>
                    <input type="file" id="open2" name="open2" style="width:0px;height:0px;">
                </div>
            </div>
            <div class="down">
            	<canvas id="canvas" width="800px" height="600px"></canvas>
            </div>
        </div>
    </h1></center>
</body>
</html>