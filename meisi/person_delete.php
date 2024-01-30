<?php
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "SELECT * FROM person WHERE person_id = :person_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':person_id', $_GET["person_id"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $company = $stmt->fetch();

    $sql = "DELETE FROM person WHERE person_id = :person_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':person_id', $_GET['person_id'], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        header("Location: company.php?company_id=".$company['company_id']);
        exit;
    }
?>