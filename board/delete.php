<?php
    include "funcs.php";
    $pdo = pdo_init();
    //index.phpからPOSTされた予定IDに一致するレコードを削除する
    $sql = "DELETE FROM board WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        //エラーがなければindex.phpに戻る
        header("Location: index.php");
        exit;
    }
?>