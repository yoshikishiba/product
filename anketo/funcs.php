<?php

function pdo_init(){
    try {
        //$pdo = new PDO("mysql:dbname=andb;charset=utf8;host=localhost", "root", "");
        $pdo = new PDO("mysql:dbname=atgp-shinsai_shiba-yoshiki;charset=utf8;host=mysql659.db.sakura.ne.jp", "atgp-shinsai", "8VBFMF0jJJmsQpipyQTUxo9WWJZFNd__");
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