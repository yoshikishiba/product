<?php
    include "funcs.php";
    $top = loginCheck();
    $side = menuLoad();
    $newComment = newCommentLoad();

    $pdo = pdo_init();
    $sql = "SELECT * FROM page INNER JOIN genre ON page.genreNo = genre.genreNo INNER JOIN user ON page.userNo = user.userNo where pageNo = :pageNo ORDER BY updateNo DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pageNo', $_GET["pageNo"], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        $view = '';
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<tr>';
            $view .= '<td>';
            $view .= '<a href="page.php?pageNo='. $result["pageNo"] .'&updateNo='. $result["updateNo"] .'">'. $result["title"] .'</a>  ';
            $view .= '　</td>';
            $view .= '<td>';
            $view .= $result["genre"];
            $view .= '　</td>';
            $view .= '<td>';
            $view .= $result["userName"];
            $view .= '　</td>';
            $view .= '<td>';
            $view .= $result["createdAt"];
            $view .= '　</td>';
            $view .= '</tr>';
        }
    }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI記事編集</title>
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
        <h1>編集履歴</h1>
        <table>
            <thead>
                <tr>
                    <th align="left">タイトル　</th>
                    <th align="left">ジャンル　</th>
                    <th align="left">編集者名　</th>
                    <th align="left">編集日　</th>
                </tr>
            </thead>
            <tbody>
        <?=$view?>
        </tbody>
</div>
</body>
</html>