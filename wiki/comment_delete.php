<?php
    session_start();
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "UPDATE comment SET deleteFlag = TRUE WHERE commentNo = :commentNo";
    $stmt = $pdo -> prepare($sql); 
    $stmt->bindValue('commentNo',$_GET["commentNo"],PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }

    header("Location: page.php?pageNo=" . $_GET["pageNo"] . "&updateNo=" . $_GET["updateNo"] );
    exit;
?>