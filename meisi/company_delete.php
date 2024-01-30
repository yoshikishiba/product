<?php
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "DELETE FROM company WHERE company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', $_GET['company_id'], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        header("Location: index.php");
        exit;
    }
?>