<?php
//print_r($_POST);
include "funcs.php";
//バリデーションチェック
//error_reporting(0);
$vali = false;
if (validation($_POST["name"], "名前が入力されていません")) $vali = true;
if (validation($_POST["area"], "お住まいが選択されていません")) $vali = true;
if (validation($_POST["age"], "年代が選択されていません")) $vali = true;
if (validation($_POST["know_from"], "お知りになったメディアが選択されていません"))$vali = true;
if ($vali) exit ('<a href="#" onclick="history.back()">前のページへ戻る</a>');



$pdo = pdo_init();
$sql = "INSERT INTO posts(name,area,age,know_from,comment,create_at)
VALUES(:name,:area,:age,:know_from,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
$stmt->bindValue(':area', $_POST["area"], PDO::PARAM_INT);
$stmt->bindValue(':age', $_POST["age"], PDO::PARAM_INT);
$know_from = implode(",", $_POST["know_from"]);
$stmt->bindValue(':know_from', $know_from, PDO::PARAM_STR);
$stmt->bindValue(':comment', $_POST["comment"], PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信完了</title>
</head>
<body>
    <h2>送信完了しました</h2>
    <button onclick="location.href='index.php'">戻る</button>
    <button onclick="location.href='admin.php'">管理画面</button>
</body>
</html>