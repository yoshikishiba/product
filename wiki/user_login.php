<?php
include "funcs.php";
$pdo = pdo_init();

$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $result = $stmt->fetch();
}
if (isset($result['id'])){
}else{
    header("Location: user.php?error=1");
    exit;
}
if (password_verify($_POST['password'], $result['password'])){
    session_start();
    $_SESSION['name'] = $result['userName'];
    $_SESSION['userNo'] = $result['userNo'];
    $_SESSION['authority'] = $result['authority'];
    header("Location: index.php");
}else{
    header("Location: user.php?error=1");
    exit;
}
?>