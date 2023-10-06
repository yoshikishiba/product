<?php
    session_start();
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "INSERT INTO comment(pageNo,name,comment) VALUES(:pageNo,:name,:comment)";
    $stmt = $pdo->prepare($sql);
    if(empty($_POST["name"])){
        $name = "名無しさん";
    }else{
        $name = $_POST["name"];
    }

    $stmt->bindValue(':pageNo', $_POST["pageNo"], PDO::PARAM_INT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $_POST["comment"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }



    header("Location: page.php?pageNo=" . $_POST["pageNo"] );
    exit;
?>