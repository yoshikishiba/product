<?php
$id = $_GET["id"];
include "funcs.php";
$pdo = pdo_init();

//２．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: admin.php");
    exit;
}
?>