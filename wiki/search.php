<?php
    include "funcs.php";
    firstPage();
    $top = loginCheck();
    $side = menuLoad();
    $newComment = newCommentLoad();

    $pdo = pdo_init();
    $sql = "SELECT * FROM page WHERE latest = TRUE AND (content LIKE :search OR title LIKE :search)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%" . $_GET["search"] . "%", PDO::PARAM_STR);
    $status = $stmt->execute();
    $page = "";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $page .= '<a href="page.php?pageNo='. $result["pageNo"] .'&updateNo='. $result["updateNo"] .'">'. $result["title"] .'</a><br>';
    }


    //ヒットしたページ番号をかぶり内容に配列に入れる
    $sql = "SELECT * FROM comment WHERE comment LIKE :search OR name LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%" . $_GET["search"] . "%", PDO::PARAM_STR);
    $status = $stmt->execute();

    $pages = array();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (in_array($result["pageNo"], $pages) != 1) {
            array_push($pages,$result["pageNo"]);
        }
    }
    $comment ="";
    foreach( $pages as $val ) {
        $sql = "SELECT * FROM page WHERE pageNo = :pageNo AND page.latest = TRUE";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pageNo', $val, PDO::PARAM_INT);
        $status = $stmt->execute();
        $result = $stmt->fetch();
        $comment .= '<a href="page.php?pageNo='. $result["pageNo"] .'&updateNo='. $result["updateNo"] .'">'. $result["title"] .'</a><br>';
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI検索結果</title>
</head>
<body>
    <h1 class="top"><a href="index.php">ポートフォリオWIKIへようこそ</a></h1>
    <header>
    <?=$top?><form method="get" action="search.php"><input type="text" name="search" size="50" required><input type="submit" value="検索"></form>
    </header>
    <hr>
    <div class="sidemenu">
        <?=$side?>
        <?=$newComment?>
    </div>
    <div class="main">
    <h1>検索結果</h1>
    <p>検索ワード:<?=$_GET["search"]?></p>
    <h2>本文にヒット</h2>
    <?=$page?>
    <h2>コメントにヒット</h2>
    <?=$comment?>
    </div>
</body>
</html>
