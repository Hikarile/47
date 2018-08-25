<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include("cd.php");
	include("login.php");
	
	$id=$_GET['id'];
	
	$te=$mysql->query("SELECT * FROM `text` where `id` = '$id'");
	$text=mysqli_fetch_array($te);
	$q=$mysql->query("SELECT * FROM `qa` where `text_id` = '$id'");
?>
<style>
	.box1{
		position:absolute;
		top:50px;
		right:100px;
	}
	.box2{
		width:400px;
		border: #F93 solid 3px;
    	background-color: #FC6;
		padding:30px;
	}
	.text{
		width:200px;
		height:25px;
		font-size:20px;
	}
	.out{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FFFF99;
		font-size:20px;
	}
	.sub{
		border:#36F solid 4px;
		background-color:#69F;
		width:120px;
		height:60px;
		font-size:25px;
		border-radius:20px;
	}
	.btn{
		width:150px;
		height:50px;
		border:#F93 solid 5px;
		background-color:#FC3;
		font-size:20px;
	}
	.out:hover{
		background-color:#C63;
	}
	.sub:hover{
		background-color:#6CF;
	}
	.btn:hover{
		background-color:#C63;
	}
	.t{
		max-width:100%;
		max-height:150px;
		min-width:100%;
		min-height:150px;
		font-size:25px;
	}
	.corrext{
		width:50px;
		height:40px;
		font-size:20px;
	}
	.table{
		font-size:40px;
	}
</style>
</head>

<body bgcolor="#FFFF99">
	<center><h1>
    	<?=$text['text_number']?><p>&nbsp;<p/>
        <div class="box1"><input type="button" value="返回" onClick="location.href='menu.php'" class="out"></div>
        
        <form>
        <?php
		$i=0;
        while($qa=mysqli_fetch_array($q)){
		$i++;
		?>
		<table border="1" bgcolor="#FF9933" width="80%" height="150px" class="table">
        	<tr>
            	<th width="15%"><?=$i?></th>
                <td>
					<?=$qa['q']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    if($qa['type']=='1'){
                    ?>
                    <samp style="color:#F00">是非題</samp><p/>
                    <input class="corrext" type="radio" name="da" value="是">是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="corrext" type="radio" name="da" value="是">否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    }if($qa['type']=='2'){
                        $da=explode(',',$qa['da']);
                    ?>
                    <samp style="color:#F00">單選題</samp><p/>
                    <input class="corrext" type="radio" name="da" value="<?=$da[0]?>"><?=$da[0]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="corrext" type="radio" name="da" value="<?=$da[1]?>"><?=$da[1]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="corrext" type="radio" name="da" value="<?=$da[2]?>"><?=$da[2]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="corrext" type="radio" name="da" value="<?=$da[3]?>"><?=$da[3]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    }if($qa['type']=='3'){
                        $da=explode(',',$qa['da']);
                    ?>
                    <samp style="color:#F00">多選題</samp><p/>
                    <?php
                    foreach($da as $key => $val){
                        if($val !=''){
                    ?>
                    <input class="corrext" type="checkbox" name="da3[<?=$i?>]" id="da3<?=$i?>" value="<?=$val?>"><?=$val?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                        }
                    }
                    }
                    ?>
                </td>
            </tr>
        </table>
		<?php
		}
		?><p/>
        <input class="sub" type="submit" name="ok" value="確定">
        </form>
    </h1></center>
</body>
</html>