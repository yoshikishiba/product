<?php
    session_start();
    function pdo_init(){
        try {
            $pdo = new PDO("mysql:dbname=meisi;charset=utf8;host=localhost", "root", "");
            return $pdo;
        } catch (PDOException $e) {
            try {
                $pdo = new PDO("", "", "");
                return $pdo;
            } catch (PDOException $e) {
                exit('DB-Connection-Error:'.$e->getMessage());
            }
        }
    }
    /*
    SQLの実行時にエラーがあった場合のエラーメッセージ表示を簡略化する関数
    */
    function sqlError($stmt){ 
        $error = $stmt->errorInfo();
        exit("ErrorSQL:".$error[2]);
    }
    function pankuzu(){
        return ' <a href="index.php?search='.$_SESSION['search'].'&page_no='. $_SESSION['page_no'] .'">'. $_SESSION['search'] . $_SESSION['page_no'] .'ページ目</a> ';
    }
?>