<?php
    session_start();
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "UPDATE page SET deleteFlag = TRUE WHERE pageNo = :pageNo AND updateNo = :updateNo";
    $stmt = $pdo -> prepare($sql); 
    $stmt->bindValue('pageNo',$_GET["pageNo"],PDO::PARAM_INT);
    $stmt->bindValue('updateNo',$_GET["updateNo"],PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }

    header("Location: page.php?pageNo=" . $_GET["pageNo"] . "&updateNo=" . $_GET["updateNo"] );
    exit;
?>