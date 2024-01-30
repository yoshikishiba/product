<?php
    include "funcs.php";
    $pdo = pdo_init();
    //index.phpからPOSTされた情報をデータベースに追加
    $sql = "INSERT INTO board(name,start_time,finish_time,content,created_date) VALUES(:name,:start_time,:finish_time,:content,:created_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
    $stmt->bindValue(':start_time', $_POST["start_hour"].":".$_POST["start_minute"], PDO::PARAM_STR);
    $stmt->bindValue(':finish_time', $_POST["end_hour"].":".$_POST["end_minute"], PDO::PARAM_STR);
    $stmt->bindValue(':content', $_POST["content"], PDO::PARAM_STR);
    $stmt->bindValue(':created_date', date('Y-m-d'), PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        //エラーがなければindex.phpに戻る
        header("Location: index.php");
        exit;
    }
?>