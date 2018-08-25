<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
	.body{
		width:1215px;
		height:820px;
		border:#000 solid 1px;
	}
	.top{
		width:800px;
		height:100px;
		float:left;
		text-align:left;
		border:#000 solid 1px;
	}
	.left{
		width:200px;
		height:800px;
		float:left;
		border:#000 solid 1px;
	}
	.right{
		width:200px;
		height:800px;
		float:right;
		border:#000 solid 1px;
	}
	.down{
		width:800px;
		height:700px;
		border:#000 solid 1px;
		float:left;
	}
	.topbox{
		width:30px;
		height:30px;
		border:#CCC solid 3px;
		display:inline-block;
		margin-top:7px;
		margin-left:10px;
	}
	.lbox{
		width:70px;
		height:70px;
		border:#CCC solid 3px;
		margin-top:30px;
	}
	.topbox:hover{
		border:#69F solid 3px;
	}
	.lbox:hover{
		border:#69F solid 3px;
	}
	.aaa{
		border:#000 solid 3px;
	}
	
	.btn{
		width:80%;
		height:70px;
		background-color:#69F;
		border:#06F solid 3px;
		margin-top:30px;
		font-size:20px;
	}
	.btn:hover{
		background-color:#96F;
	}
</style>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/script.js"></script>
</head>

<body>
	<center><h1>
    	<div class="body">
        	<div class="left">
            	<div id="img">
                	<img src="img/no.png" type="shape" shape="no" class="lbox">
                    <img type="shape" shape="g" class="lbox" src="img/g.png">
                    <img type="shape" shape="line" class="lbox" src="img/line.png">
                    <img type="shape" shape="arc" class="lbox" src="img/arc.png">
                    <img type="shape" shape="three" class="lbox" src="img/three.png">
                    <img type="shape" shape="four" class="lbox" src="img/four.png">
                    <img type="shape" shape="six" class="lbox" src="img/six.png">
                    <img type="shape" shape="star" class="lbox" src="img/star.png">
                </div>
                <div>
                	<input type="button" value="重播" id="again" class="btn">
                </div>
            </div>
            <div class="top">
            	<div id="color">
                	<div class="topbox" color="black" style="background-color:black;"></div>
                    <div class="topbox" color="white" style="background-color:white;"></div>
                    <div class="topbox" color="purple" style="background-color:purple;"></div>
                    <div class="topbox" color="blue" style="background-color:blue;"></div>
                    <div class="topbox" color="green" style="background-color:green;"></div>
                    <div class="topbox" color="yellow" style="background-color:yellow;"></div>
                    <div class="topbox" color="pink" style="background-color:pink;"></div>
                    <div class="topbox" color="orange" style="background-color:orange;"></div>
                    <div class="topbox" color="red" style="background-color:red;"></div>
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
                    <img type="ill" ill="img1" class="lbox" src="img/1.png">
                    <img type="ill" ill="img2" class="lbox" src="img/4good.png">
                    <img type="ill" ill="img3" class="lbox" src="img/good.png">
                    <img type="ill" ill="img4" class="lbox" src="img/失落敬恆.png">
                    <img type="ill" ill="img5" class="lbox" src="img/光傑.png">
                    <img type="ill" ill="img6" class="lbox" src="img/超good.png">
                    <img type="ill" ill="img7" class="lbox" src="img/變態承恩.png">
                    <img type="ill" ill="img8" class="lbox" src="img/c0.png">
                </div>
                <div>
                	<input type="button" value="存成圖片檔" id="save1" class="btn">
                    <input type="button" value="存成可編輯檔" id="save2" class="btn">
                    <a id="download"></a>
                    <input type="button" value="開啟可編輯檔" id="open1" class="btn"><br/>
                    <input type="file" id="open2" style=" width:0px; height:0px;">
                    
                </div>
            </div>
            <div class="down">
            	<canvas id="canvas"></canvas>
            </div>
        </div>
    </h1></center>
</body>
</html>