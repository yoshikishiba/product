<?php
include "funcs.php";
$pdo = pdo_init();

$sql = "SELECT * FROM user WHERE userName = :userName";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userName', $_POST["name"], PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $result = $stmt->fetch();
    if (isset($result['name'])){
        header("Location: user.php?nameerror=".$_POST["name"]);
        exit;
    }
}

$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $result = $stmt->fetch();
    if (isset($result['id'])){
        header("Location: user.php?iderror=".$_POST["id"]);
        exit;
    }
}


$sql = "INSERT INTO user(userName,id,password) VALUES(:userName,:id,:password)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userName', $_POST["name"], PDO::PARAM_STR);
$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_STR);
$stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $num = $pdo -> lastInsertId();
    if($num == 1){
        $sql = 'UPDATE user SET authority = "admin" WHERE userNo = 1';
        $stmt = $pdo->prepare($sql);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI登録完了</title>
</head>
<body>
<p>登録出来ました。</p>
<a href="user.php">続けてログインへ</a>
</body>
</html>