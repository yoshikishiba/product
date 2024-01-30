<?php
/*
データベースに接続する
①ローカル環境のMySQLに接続を試行する
②サーバー環境のMySQLに接続を試行する
①②どちらかに接続できればPDOをreturnする
どちらにも接続できない場合エラーメッセージを表示する
*/
function pdo_init(){
    try {
        $pdo = new PDO("mysql:dbname=boarddb;charset=utf8;host=localhost", "root", "");
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
?>