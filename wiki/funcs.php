<?php

function pdo_init(){
    try {
        $pdo = new PDO("mysql:dbname=wikidb;charset=utf8;host=localhost", "root", "");
        return $pdo;
    } catch (PDOException $e) {
        try {
            $pdo = new PDO("mysql:dbname=atgp-shinsai_shiba-yoshiki;charset=utf8;host=mysql659.db.sakura.ne.jp", "atgp-shinsai", "8VBFMF0jJJmsQpipyQTUxo9WWJZFNd__");
            return $pdo;
        } catch (PDOException $e) {
            exit('DB-Connection-Error:'.$e->getMessage());
        }
    }
    
}
function sqlError($stmt){ 
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
}
function firstPage(){
    $pdo = pdo_init();
    $sql = "SELECT * FROM page WHERE pageNo = 1";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    } else {
        if($stmt -> rowCount() == 0){
            $sql = 'INSERT INTO page(userNo,genreNo,title,content)
            VALUES(0,1,"トップページ","wikiが作成されました!")';
            $stmt = $pdo->prepare($sql);
            $status = $stmt->execute();
            if ($status == false) {
                sqlError($stmt);
            }
            $sql = 'INSERT INTO genre(genre,orderNo)
            VALUES("",1)';
            $stmt = $pdo->prepare($sql);
            $status = $stmt->execute();
            if ($status == false) {
                sqlError($stmt);
            }
        }
    }
}
function loginCheck(){
    session_start();
    $top = "";
    if (isset($_SESSION['name'])){
        $top .= $_SESSION['name'].'さん<a href="user_logout.php">[ログアウト]</a> <a href="page_create.php">新規ページ作成</a>';
        if($_SESSION['authority']=="admin"){
            $top .= ' <a href="genre_order.php">メニューの表示順変更</a>';
        }
    }else{
        $top .= '<a href="user.php">ログイン（新規登録）</a>';
    }
    return $top;
}
function menuLoad(){
    $pdo = pdo_init();
    $sql = "SELECT * FROM genre ORDER BY orderNo ASC";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $side = "";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        //$sql2 = "SELECT * FROM page WHERE genreNo = :genreNo AND page.updateNo = (SELECT MAX(page.updateNo) FROM page)";
        $sql2 = "SELECT * FROM page WHERE genreNo = :genreNo AND page.latest = TRUE AND deleteFlag = FALSE AND pageNo != 1 ORDER BY createdAt DESC";
        if (isset($_SESSION['authority'])){
            if ($_SESSION['authority']=="admin"){
                $sql2 = "SELECT * FROM page WHERE genreNo = :genreNo AND page.latest = TRUE AND pageNo != 1 ORDER BY createdAt DESC";
            }
        }
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindValue(':genreNo',$result["genreNo"] , PDO::PARAM_INT);
        $status = $stmt2->execute();
        if ($status == false) {
            sqlError($stmt2);
        }else{
            if($stmt2 -> rowCount() != 0){
                $side .= '<h3>'. $result["genre"] .'</h3>';
                $side .= "<ul>";
                while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    if ($result2["deleteFlag"]==TRUE){
                        if (isset($_SESSION['authority'])){
                            if ($_SESSION['authority']=="admin"){
                                $side .= '<li><a href="page.php?pageNo='. $result2["pageNo"]  .'">'. $result2["title"]."(削除済み)" .'</a></li>';
                            }
                        }
                    }else{
                        $side .= '<li><a href="page.php?pageNo='. $result2["pageNo"]  .'">'. $result2["title"] .'</a></li>';
                    }
                }
            }
            $side .= "</ul>";
        }   
    }
    return $side;
}
function newCommentLoad(){
    $pdo = pdo_init();
    $sql = "SELECT * FROM comment INNER JOIN page ON page.pageNo = comment.pageNo INNER JOIN genre ON page.genreNo = genre.genreNo WHERE page.deleteFlag = FALSE AND comment.deleteFlag = FALSE AND page.latest = TRUE ORDER BY commentNo DESC";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    $comment = "<h3>最新コメント5件</h3>";
    $count = 0;
    $comment .= "<ul>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        if ($count < 5){
            $comment .= '<li><p class="comment"><a href="page.php?pageNo='. $result["pageNo"] .'">'.$result["title"] .'</a>  ' . $result["comment"] . " - " . $result["name"] . "[" . $result["createdAt"] . "]</p></li>";
            $count++;
        }
        
    }
    $comment .= "</ul>";
    return $comment;
}

?>