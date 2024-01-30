<?php
    include "funcs.php";
    print_r($_POST);
    $pdo = pdo_init();

    $sql = "UPDATE company 
    SET company_name = :company_name,company_post_code = :company_post_code,company_address = :company_address,company_updated_user = :company_updated_user,company_updated_date = :company_updated_date 
    WHERE company_id = :company_id";
    $stmt = $pdo -> prepare($sql); 
    $stmt->bindValue(':company_id', $_GET['company_id'], PDO::PARAM_INT);
    $stmt->bindValue(':company_name', $_POST["company_name"], PDO::PARAM_STR);
    $stmt->bindValue(':company_post_code', $_POST["company_post_code"], PDO::PARAM_STR);
    $stmt->bindValue(':company_address', $_POST["company_address"], PDO::PARAM_STR);
    $stmt->bindValue(':company_updated_user', $_POST["company_updated_user"], PDO::PARAM_STR);
    $stmt->bindValue(':company_updated_date', date('Y-m-d'), PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }



    header("Location: company.php?company_id=". $_GET['company_id']);
    exit;
?>