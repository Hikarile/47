<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/js.js"></script>
<style>
	.body{
		width:1210px;
		height:800px;
	}
	.top{
		width:800px;
		height:100px;
		float:left;
		text-align:left;
	}
	.left{
		width:200px;
		height:800px;
		float:left;
	}
	.right{
		width:200px;
		height:800px;
		float:right;
	}
	.down{
		width:800px;
		height:700px;
		border:#000 solid 3px;
		float:left;
	}
	
	.topbox{
		width:30px;
		height:30px;
		border:#CCC solid 3px;
		margin-top:10px;
		margin-left:10px;
		display:inline-block;
	}
	.lbox{
		width:70px;
		height:70px;
		border:#CCC solid 3px;
		margin-top:20px;
		margin-left:10px;
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
		border:#96F solid 3px;
		font-size:20px;
		margin-top:20px;
	}
	.btn:hover{
		background-color:#39F;
	}
	
</style>
</head>

<body>
	<center><h1>
    	<div class="body">
        	<div class="left">
                <div id="img">
                    <img class="lbox" type="shape" shape="no" src="png/no.png">
                    <img class="lbox" type="shape" shape="g" src="png/g.png">
                    <img class="lbox" type="shape" shape="line" src="png/line.png">
                    <img class="lbox" type="shape" shape="arc" src="png/arc.png">
                    <img class="lbox" type="shape" shape="three" src="png/three.png">
                    <img class="lbox" type="shape" shape="four" src="png/four.png">
                    <img class="lbox" type="shape" shape="six" src="png/six.png">
                    <img class="lbox" type="shape" shape="star" src="png/star.png">
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
                    	<div style="background-color:#000; width:2px; height:2px; margin-top:14px; margin-left:14px;"></div>
                    </div>
                    <div class="topbox" line="4">
                    	<div style="background-color:#000; width:4px; height:4px; margin-top:13px; margin-left:13px;"></div>
                    </div>
                    <div class="topbox" line="6">
                    	<div style="background-color:#000; width:6px; height:6px; margin-top:12px; margin-left:12px;"></div>
                    </div>
                    <div class="topbox" line="8">
                    	<div style="background-color:#000; width:8px; height:8px; margin-top:11px; margin-left:11px;"></div>
                    </div>
                    <div class="topbox" line="10">
                    	<div style="background-color:#000; width:10px; height:10px; margin-top:10px; margin-left:10px;"></div>
                    </div>
                    <div class="topbox" line="12">
                    	<div style="background-color:#000; width:12px; height:12px; margin-top:9px; margin-left:9px;"></div>
                    </div>
                    <div class="topbox" line="14">
                    	<div style="background-color:#000; width:14px; height:14px; margin-top:8px; margin-left:8px;"></div>
                    </div>
                    <div class="topbox" line="16">
                    	<div style="background-color:#000; width:16px; height:16px; margin-top:7px; margin-left:7px;"></div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div id="img">
                    <img class="lbox" type="ill" ill="png1" src="png/1.png">
                    <img class="lbox" type="ill" ill="png2" src="png/4good.png">
                    <img class="lbox" type="ill" ill="png3" src="png/good.png">
                    <img class="lbox" type="ill" ill="png4" src="png/失落敬恆.png">
                    <img class="lbox" type="ill" ill="png5" src="png/光傑.png">
                    <img class="lbox" type="ill" ill="png6" src="png/超good.png">
                    <img class="lbox" type="ill" ill="png7" src="png/變態承恩.png">
                    <img class="lbox" type="ill" ill="png7" src="png/吃貨重任.png">
                </div>
                <div>
                	<input type="button" value="存成圖片檔" class="btn" id="save1">
                    <input type="button" value="存成可編輯檔" class="btn" id="save2">
                    <a id="download"></a>
                    <input type="button" value="編輯可編輯檔" class="btn" id="open1"><br/>
                    <input type="file" class="btn" id="open2" style="width:0px; height:0px;" hidden>
                </div>
            </div>
            <div class="down">
                <canvas id="canvas" width="800px" height="700px"></canvas>
            </div>
        </div>
    </h1></center>
</body>
</html>