<?php
    include "funcs.php";
    $top = loginCheck();
    $top .= ' <a href="image_upload.php"  target="blank">画像アップロード</a>';
    $pdo = pdo_init();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI新規記事作成</title>
</head>
<body>
    <h1 class="top"><a href="index.php">ポートフォリオWIKIへようこそ</a></h1>
    <header>
    <?=$top?><form method="post" action="search.php"><input type="text" name="search" size="50" required><input type="submit" value="検索"></form>
    </header>
    <hr>

    <h1>新規記事作成</h1>
    <form method="post" action="page_into.php">
    <div>タイトル：<input type="text" name="title" required></div>
    <div>ジャンル：<input type="text" name="genre" required></div>
    <div class="edit">
        <div class="html"> 
            <div class="tag">
                <div id="h2">h2　</div>
                <div id="h3">h3　</div>
                <div id="p">p　</div>
                <div id="ul">ul　</div>
                <div id="a">a　</div>
                <div id="img">img　</div>
                <div id="br">br　</div>
                <a href="image_display.php" target="blank">imgファイル名検索</a>
            </div>
            <textarea name="content" id="area"></textarea>
        </div>
        
        <div class="preview main">
        <p class="inline">プレビュー<p>
            <div class="box" id="box"></div>
        </div>
    </div>
    <input type="submit" value="作成する"></form>
    <script src="js/editor.js"></script>  
</body>
</html>
