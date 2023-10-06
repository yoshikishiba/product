<?php
    include "funcs.php";
    $top = loginCheck();
    $side = menuLoad();
    $newComment = newCommentLoad();

    $pdo = pdo_init();
    $sql = "SELECT * FROM genre WHERE genreNo != 1 ORDER BY orderNo ASC";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $msg ="";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $msg .= $result["genre"].' <a href="genre_up.php?orderNo='.$result["orderNo"].'">上へ</a> <a href="genre_down.php?orderNo='.$result["orderNo"].'">下へ</a><br>';
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI表示順変更</title>
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
    <h1>トップページの表示順変更</h1>
    <?=$msg?>
    </div>
</body>
</html>