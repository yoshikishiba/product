<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>五周年イベント食事会予約フォーム</title>
<style>
.error{
	color:red;
	font-size: 10px;
}
</style>
</head>
<body>

<h1>ステーキタイガー</h1>
<h2>五周年イベント食事会予約フォーム</h2>

<form method="post" action="mail2.php">
<p>お名前:<input type="text" id="name" name="name" size="20" placeholder="入力必須"/></p>
<div id="name_error" class="error"></div>
<p>人数：<input type="number" id="num" name="num" step="1" value="1" min="1" max="5"/>※5人まで
<div id="num_error" class="error"></div>
<p>MAIL:<input type="text" id="mail" name="mail" size="20" placeholder="入力必須"/></p>
<div id="mail_error" class="error"></div>
<p><input type="submit" value="送信" id="submit" disabled/></p>
</form>

<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous">
</script>
<script>
let name_check = false;
let num_check = true;
let mail_check = false;
$("#name").on("keyup",function(){
	const name = $("#name").val();
	if(name.length!=0){
		name_check = true;
		$("#name_error").html('');
	}else{
		name_check = false;
		$("#name_error").html('名前は必須です');
	}
	button_prop();
})
$("#name").on("focusout",function(){
	const name = $("#name").val();
	if(name.length!=0){
		name_check = true;
		$("#name_error").html('');
	}else{
		name_check = false;
		$("#name_error").html('名前は必須です');
	}
	button_prop();
})
$("#num").on("change",function(){
	const num = $("#num").val();
	if(num.length!=0){
		num_check = true;
		$("#num_error").html('');
	}else{
		num_check = false;
		$("#num_error").html('人数は必須です');
	}
	button_prop();
})
$("#mail").on("keyup",function(){
	const mail = $("#mail").val();
	if(mail.length!=0){
		mail_check = true;
		$("#mail_error").html('');
	}else{
		mail_check = false;
		$("#mail_error").html('メールアドレスは必須です');
	}
	button_prop();
})
$("#mail").on("focusout",function(){
	const mail = $("#mail").val();
	if(mail.length!=0){
		mail_check = true;
		$("#mail_error").html('');
	}else{
		mail_check = false;
		$("#mail_error").html('メールアドレスは必須です');
	}
	button_prop();
})
function button_prop(){
	if(name_check && num_check && mail_check){
		$("#submit").prop("disabled", false);
	}else{
		$("#submit").prop("disabled", true);
	}
}

</script> 
</body>
</html>
