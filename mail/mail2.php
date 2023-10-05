<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");


//初期化
$name    = $_POST["name"];
$num     = $_POST["num"];
$mail    = $_POST["mail"];
$subject = "[ステーキタイガー]ご予約を受け付けました";
if($num == 1){
    $message = "シェフが目の前で調理させていただく、カウンター席にてご案内いたします。";
}else{
    $message = "お連れ様とゆっくりとお過ごしいただけるよう、お座敷の個室にてご案内いたします。";
}
$comment = $name."様

本日はご予約いただきありがとうございます。
下記の内容にてご予約を受け付けました。

日時：20XX年12月10日　18時00分
メニュー内容：5周年特別コース
料金：1名様あたり10,000円（※オプションの追加などにより変更の可能性があります）
　　　お支払いは現金のみとさせていただきます。
ご予約者様お名前：".$name."様
ご予約人数：".$num."名

【お席について】
".$message."

【キャンセルについて】
キャンセルは予約日の3日前までにご連絡ください。
ご連絡なしにキャンセルされた場合、上記記載のサービス料金の10%（1,000円）を頂戴いたします。

それでは、当日".$name."様にお会いできますことを楽しみにお待ち申し上げております。";
$send    = "From: jobtra.it.shinsaibashi@generalpartners.co.jp";

//送信処理を以下に記述
$error = "";
$title = "入力内容に不備があります";
if ($name==""){
    $error = $error."名前を入力してください<br>";
}
if ($num<0 || $num>5 || $num==""){
    $error = $error."人数は1~5人で入力してください<br>";
}
if ($mail==""){
    $error = $error."メールアドレスを入力してください<br>";
}

if ($error == ""){
    if (mb_send_mail($mail, $subject, $comment, $send)) {
        $title = "予約が完了しました！";
        $str = "<h2>予約が完了しました</h2>入力したメールアドレスに予約完了メールが届いているか確認してください";
    } else {
        $str = "<h2>送信エラー</h2>電話でお問い合わせください";
    }
}else{
    $str = "<h2>入力内容に不備があります</h2><div>".$error."</div>戻って入力しなおしてください";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
div {color: red; }
</style>
<title><?= $title ?></title>
</head>
<body>
<?= $str ?>
</body>
</html>
