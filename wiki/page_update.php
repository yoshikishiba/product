<?php
    session_start();
    include "funcs.php";

    $pdo = pdo_init();
    //入力されたジャンルがすでにあるか
    $sql = "SELECT * FROM genre WHERE genre = :genre";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':genre', $_POST["genre"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $result = $stmt->fetch();

    if(isset($result["genreNo"])){
        //入力されたジャンルが既存→ジャンルNO取得
        $genreNo = $result["genreNo"];
    }else{
        //入力されたジャンルが既存でない→新規追加
        $sql = "INSERT INTO genre(genre) VALUES(:genre)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':genre', $_POST["genre"], PDO::PARAM_STR);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }
        
        //新規追加したジャンルの表示順を初期設定
        $genreNo = $pdo -> lastInsertId();
        $sql = "UPDATE genre SET orderNo=:genreNo WHERE genreNo=:genreNo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':genreNo', $genreNo, PDO::PARAM_INT);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }
    }

    //更新記事を追加
    $sql = "INSERT INTO page(pageNo,updateNo,userNo,genreNo,title,content)
    VALUES(:pageNo,:updateNo,:userNo,:genreNo,:title,:content)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pageNo', $_POST["pageNo"], PDO::PARAM_INT);
    $stmt->bindValue(':updateNo', $_POST["updateNo"]+1, PDO::PARAM_INT);
    $stmt->bindValue(':userNo', $_SESSION["userNo"], PDO::PARAM_INT);
    $stmt->bindValue(':genreNo', $genreNo, PDO::PARAM_INT);
    $stmt->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(':content', $_POST["content"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }

    //修正前の記事の最新フラグを解除
    $sql = "UPDATE page SET latest=false WHERE pageNo =:pageNo AND updateNo =:updateNo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pageNo', $_POST["pageNo"], PDO::PARAM_INT);
    $stmt->bindValue(':updateNo', $_POST["updateNo"], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    } else {
        header("Location: page.php?pageNo=".$_POST["pageNo"]."&updateNo=".($_POST["updateNo"]+1));
        exit;
    }


?>