<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/widgets.css" rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/scripts.js"></script>

    <title>河內塔</title>
</head>

<body>
    <div hidden class="success">
        <div class="container">
            <div class="message">
                遊戲成功!
            </div>
        </div>
    </div>
    <div id="container-game" class="gameRunning">
        <div class="row">
            <div class="layout">
                <h2>河內塔</h2>

                <div class="game">
                    <div class="clear colNumber">
                        <div class="col3">
                            <span>3</span>
                        </div>
                        <div class="col3">
                            <span>2</span>
                        </div>
                        <div class="col3">
                            <span>1</span>
                        </div>
                    </div>
                    <div class="col" data-id="3">
                        <div class='brick b1' data-id="1"></div>
                    </div>
                    <div class="col" data-id="2">
                    </div>
                    <div class="col" data-id="1">
                        <div class='brick b2' data-id="2"></div>
                        <div class='brick b3' data-id="3"></div>
                    </div>

                    <div class="clear moveButton">
                        <div class="col3">
                            <button>2</button>
                            <button>1</button>
                        </div>
                        <div class="col3">
                            <button>3</button>
                            <button>1</button>
                        </div>
                        <div class="col3">
                            <button>3</button>
                            <button>2</button>
                        </div>
                    </div>

                </div>
                <div class="desc left">
                    <a href="index.html" class="btn btn-secondary">回到設定頁面</a>
                </div>
            </div>
            <div class="module">
                <div class="mod">
                    <h4>暱稱</h4>
                    <h2>王小明</h2>
                </div>
                <div class="mod" id="move">
                    <h4>移動次數</h4>
                    <h2>1</h2>
                </div>
				 <div class="mod" id="asideFuncButtons">
					<button>上一步</button>
					<button>自動解答</button>
					<button>重播</button>
				 </div>
            </div>
        </div>
    </div>
</body>

</html>