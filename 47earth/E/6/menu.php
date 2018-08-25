<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta name="viewport" content="width=device-width">
<style>
	.box1{
		width:400px;
		height:250px;
		border:#F60 solid 3px;
		background-color:#F93;
		margin:20px;
		padding:20px;
	}
	.text{
		width:50%;
		height:30px;
		font-size:23px;
	}
	.out{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#FF9;
		border-radius:20px;
		font-size:20px;
	}
	.out:hover{
		background-color:#F90;
	}
	.sub{
		width:100px;
		height:60px;
		border:#03F solid 3px;
		background-color:#69F;
		border-radius:20px;
		font-size:20px;
	}
	.sub:hover{
		background-color:#39F;
	}
	.btn{
		width:150px;
		height:60px;
		border:#F60 solid 3px;
		background-color:#F90;
		border-radius:20px;
		font-size:20px;
	}
	.btn:hover{
		background-color:#F63;
	}
</style>
<?php
	include("cd.php");
	include("login.php");
	
	
	
?>
<script src="jquery.js"></script>
<script>
	
</script>
</head>

<body bgcolor="#FFFF99">
	<div><input type="button" value="登出" onClick="location.href='out.php'" class="out"></div>
    <center><h1>
    	<samp>問卷管理<p/></samp>
    	
        <input type="button" value="新增問卷" onClick="location.href='addtext.php'" class="btn">
        
        <table border="1" width="90%">
        	<tr height="60px" bgcolor="#3366FF">
            	<th width="20%">試卷編號</th>
                <th width="30%">狀態</th>
                <th width="20%">編輯</th>
                <th width="10%">檢視</th>
                <th width="10%">考試</th>
            </tr>
            <?php
            if($_SESSION['id']==1){
				$t=$mysqli->query("SELECT * FROM `text`");
			}else{
				$t=$mysqli->query("SELECT * FROM `text` where `teacherid` = '".$_SESSION['id']."'");
			}
			while($text=mysqli_fetch_array($t)){
			?>
			<tr>
            	<th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>                
            </tr>
			<?php
			}
			?>
        </table>
        
    </h1></center>
</body>
</html>