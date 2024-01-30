<?php
    include "funcs.php";
    print_r($_POST);
    $pdo = pdo_init();

    $sql = "INSERT INTO company(company_name,company_post_code,company_address,company_added_user,company_added_date)
    VALUES(:company_name,:company_post_code,:company_address,:company_added_user,:company_added_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_name', $_POST["company_name"], PDO::PARAM_STR);
    $stmt->bindValue(':company_post_code', $_POST["company_post_code"], PDO::PARAM_STR);
    $stmt->bindValue(':company_address', $_POST["company_address"], PDO::PARAM_STR);
    $stmt->bindValue(':company_added_user', $_POST["company_added_user"], PDO::PARAM_STR);
    $stmt->bindValue(':company_added_date', date('Y-m-d'), PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }



    header("Location: company.php?company_id=". $pdo -> lastInsertId());
    exit;
?>