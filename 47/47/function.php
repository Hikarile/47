<?php
	
	function checkInput($name,$phone,$email,$text,$number){
		if($name==''||$phone==''||$email==''||$text==''||$number==''){
			return '<script>alert("未填寫完成")</script>';
		}else{return '';}
	}
	

	