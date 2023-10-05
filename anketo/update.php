<?php
//print_r($_POST);
include "funcs.php";
//バリデーションチェック
//error_reporting(0);
$vali = false;
if (validation($_POST["name"],"名前が入力されていません")) $vali = true;
if (validation($_POST["area"],"お住まいが選択されていません")) $vali = true;
if (validation($_POST["age"],"年代が選択されていません")) $vali = true;
if (validation($_POST["know_from"],"お知りになったメディアが選択されていません")) $vali = true;
if ($vali) exit ('<a href="details.php?id='. $_POST["id"] .'" class="btn">編集画面に戻る</a>');


$pdo = pdo_init();
$sql = "UPDATE posts SET name=:name,area=:area,age=:age,know_from=:know_from,comment=:comment WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
$stmt->bindValue(':area', $_POST["area"], PDO::PARAM_INT);
$stmt->bindValue(':age', $_POST["age"], PDO::PARAM_INT);
$know_from = implode(",", $_POST["know_from"]);
$stmt->bindValue(':know_from', $know_from, PDO::PARAM_STR);
$stmt->bindValue(':comment', $_POST["comment"], PDO::PARAM_STR);
$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: admin.php");
    exit;
}