<?php
    session_start();
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "SELECT MAX(orderNo) FROM genre";
    $stmt = $pdo -> prepare($sql); 
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        $result = $stmt->fetch();
    }
    if ($_GET["orderNo"] != $result["MAX(orderNo)"]){

        $sql = "UPDATE genre SET orderNo = :newOrder WHERE orderNo = :oldOrder";
        $stmt = $pdo -> prepare($sql); 
        $stmt->bindValue('newOrder',0,PDO::PARAM_INT);
        $stmt->bindValue('oldOrder',($_GET["orderNo"]+1),PDO::PARAM_INT);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }

        $sql = "UPDATE genre SET orderNo = :newOrder WHERE orderNo = :oldOrder";
        $stmt = $pdo -> prepare($sql); 
        $stmt->bindValue('newOrder',($_GET["orderNo"]+1),PDO::PARAM_INT);
        $stmt->bindValue('oldOrder',$_GET["orderNo"],PDO::PARAM_INT);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }

        $sql = "UPDATE genre SET orderNo = :newOrder WHERE orderNo = :oldOrder";
        $stmt = $pdo -> prepare($sql); 
        $stmt->bindValue('newOrder',$_GET["orderNo"],PDO::PARAM_INT);
        $stmt->bindValue('oldOrder',0,PDO::PARAM_INT);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }
    }

    header("Location: genre_order.php");
    exit;
?>