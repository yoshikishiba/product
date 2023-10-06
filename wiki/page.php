<?php
    include "funcs.php";
    $top = loginCheck();
    $side = menuLoad();
    $newComment = newCommentLoad();

    $pdo = pdo_init();
    if(isset($_GET["updateNo"])){
        $sql = "SELECT * FROM page INNER JOIN genre ON page.genreNo = genre.genreNo WHERE pageNo = :pageNo AND updateNo = :updateNo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pageNo', $_GET["pageNo"], PDO::PARAM_INT);
        $stmt->bindValue(':updateNo', $_GET["updateNo"], PDO::PARAM_INT);
    }else{
        $sql = "SELECT * FROM page INNER JOIN genre ON page.genreNo = genre.genreNo WHERE pageNo = :pageNo AND latest = TRUE";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pageNo', $_GET["pageNo"], PDO::PARAM_INT);
    }
    $status = $stmt->execute();

    if ($status == false) {
        sqlError($stmt);
    } else {
        $result = $stmt->fetch();
        if ($result["latest"] == FALSE){
            $top .= ' <a href="page_history.php?pageNo='.$_GET["pageNo"].'">編集履歴へ戻る</a>';
            $msg = 'これは過去のページを表示しています。記事の編集は最新ページから行ってください。';
        }else{
            $msg ="";
            if (isset($_SESSION['name'])){
                $top .= ' <a href="page_edit.php?pageNo='.$_GET["pageNo"].'&updateNo='.$result["updateNo"].'">編集する</a>';
                if ($_SESSION['authority'] == "admin") {
                    if ($result["deleteFlag"] == FALSE){
                        $top .= ' <a href="page_delete.php?pageNo='.$_GET["pageNo"].'&updateNo='.$result["updateNo"].'">削除する</a>';
                    }else{
                        $top .= ' <a href="page_restore.php?pageNo='.$_GET["pageNo"].'&updateNo='.$result["updateNo"].'">復元する</a>';
                        $msg = '※このページは削除されています';
                    }
                }
            }
        }
    }

    $sql = "SELECT * FROM comment  WHERE pageNo = :pageNo ORDER BY commentNo DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pageNo', $_GET["pageNo"], PDO::PARAM_INT);
    $status = $stmt->execute();
    $comment ="";
    while ($result2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if(isset($_SESSION['authority'])){
            if($_SESSION['authority']=="admin"){
                if($result2["deleteFlag"]==FALSE)$comment .= '<a href="comment_delete.php?commentNo='.$result2["commentNo"].'&pageNo='.$_GET["pageNo"].'&updateNo='.$result["updateNo"].'">削除</a>';
                if($result2["deleteFlag"]==TRUE)$comment .= '<a href="comment_restore.php?commentNo='.$result2["commentNo"].'&pageNo='.$_GET["pageNo"].'&updateNo='.$result["updateNo"].'">復元</a>';
                $comment .= "・" . $result2["comment"] . " - " . $result2["name"] . "[" . $result2["createdAt"] . "]<br>" ;
            }else{
                if($result2["deleteFlag"]==FALSE){
                    $comment .= "・" . $result2["comment"] . " - " . $result2["name"] . "[" . $result2["createdAt"] . "]<br>" ;
                }else{
                    $comment .= "・このコメントは管理者によって削除されました<br>" ;
                }
            }
        }else{
            if($result2["deleteFlag"]==FALSE){
                $comment .= "・" . $result2["comment"] . " - " . $result2["name"] . "[" . $result2["createdAt"] . "]<br>" ;
            }else{
                $comment .= "・このコメントは管理者によって削除されました<br>" ;
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$result["title"]?></title>
</head>
<body>
    <h1 class="top"><a href="index.php">ポートフォリオWIKIへようこそ</a></h1>
    <header>
    <?=$top?><form method="get" action="search.php"><input type="text" name="search" size="50" required><input type="submit" value="検索"></form>
    </header>
    <?=$msg?>
    <hr>
    <div class="sidemenu">
        <?=$side?>
        <?=$newComment?>
    </div>
    <div class="page">
    <div class="main">
    <h1><?=$result["title"]?></h1>
    <?=$result["content"]?>
    <br><br><br>
    <form method="post" action="comment.php">
    コメント：<input type="text" name="comment" size="50" required>　名前：<input type="text" name="name">
    <input type="hidden" name="pageNo" value="<?=$_GET["pageNo"]?>">
    <input type="submit" value="コメントする"></form>
    <?=$comment?>
    </div>
    </div>
</body>
</html>
