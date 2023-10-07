<?php

function pdo_init(){
    try {
        $pdo = new PDO("mysql:dbname=andb;charset=utf8;host=localhost", "root", "");
        return $pdo;
    } catch (PDOException $e) {
        exit('DB-Connection-Error:'.$e->getMessage());
    }
}
function sqlError($stmt){ 
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
}
function validation($post,$message){
    if (!isset($post) || empty($post)) {
        echo $message."<br>";
        return true;
    }
    return false;
}
?>