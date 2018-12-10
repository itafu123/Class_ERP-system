<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>register</title>
	<!-- 匯入my_css -->
	<link rel="stylesheet" href="css/my_css.css" type="text/css">
	<!-- 匯入bootstrap -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!-- 匯入jQuery --> 
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<!-- 匯入bootstrap javascript --> 
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
  	<script type="text/javascript">
		function chk_form(){
			var email = document.getElementById("email");
			if(email.value==""){
				alert("Email不能為空！");
				return false;
			}
			var name = document.getElementById("name");
			if(name.value==""){
				alert("姓名不能為空！");
				return false;
			}
			var account = document.getElementById("account");
			if(account.value==""){
				alert("帳號不能為空！");
				return false;
			}
			var psw = document.getElementById("psw");
			if(psw.value==""){
				alert("密碼不能為空！");
				return false;
			}
			var chk_psw = document.getElementById("chk_psw");
			if(chk_psw.value==""){
				alert("密碼不能為空！");
				return false;
			}else if(chk_psw.value!=psw.value){
				alert("確認密碼錯誤！");
				return false;
			}
			var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
			if(!preg.test(email.value)){ 
				alert("Email格式錯誤！");
				return false;
			}
		}
	</script>
</head>
<body>
	<p>register</p>
	<form method="POST" action="?action=register_data" onsubmit="return chk_form();">
		E-mail：<input type="text" class="input" name="email" id="email"><br/><br/>
		姓名：<input type="text" class="input" name="name" id="name"><br/><br/>
		密　碼：<input type="password" class="input" name="psw" id="psw"><br /> <br />
		確認密碼：<input type="chk_password" class="input" name="chk_psw" id="chk_psw"><br /> <br />
		<button>註冊</button>
		<a href="?action=login">回登入頁</a>&nbsp;&nbsp;
		<!-- <a href="?action=forgetPsw">忘記密碼?</a> -->
	</form>
</body>
</html>