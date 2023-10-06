<?php
    include "funcs.php";
    $top = loginCheck();
    $top .= ' <a href="image_upload.php" target="_blank">画像アップロード</a>';
    $top .= ' <a href="page_history.php?pageNo='.$_GET["pageNo"].'">編集履歴を確認する</a>';
    $pdo = pdo_init();
    $sql = "SELECT * FROM page INNER JOIN genre ON page.genreNo = genre.genreNo WHERE pageNo = :pageNo AND updateNo = :updateNo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pageNo', $_GET["pageNo"], PDO::PARAM_INT);
    $stmt->bindValue(':updateNo', $_GET["updateNo"], PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    } else {
        $result = $stmt->fetch();
    }

    date_default_timezone_set ('Asia/Tokyo');
    if (isset($_POST['upload'])) {//送信ボタンが押された場合
        $image = date('YmdHis');//ファイル名をユニーク化→日付時刻
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
        $file = "images/$image";
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            move_uploaded_file($_FILES['image']['tmp_name'], $file);//imagesディレクトリにファイル保存
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                $image = '<img src="' . $file . '" width="300" height="300">';
            } else {
                $image = '画像ファイルではありません';
                unlink('./images/' . $image);
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
    <title>WIKI記事編集</title>
</head>
<body>
    <h1 class="top"><a href="index.php">ポートフォリオWIKIへようこそ</a></h1>
    <header>
    <?=$top?><form method="post" action="search.php"><input type="text" name="search" size="50" required><input type="submit" value="検索"></form>
    </header>
    <hr>
    
    <h1><?=$result["title"]?>の編集</h1>
    <form method="post" action="page_update.php">
    <?php
    if($_GET["pageNo"]!=1){
        echo '<div>タイトル：<input type="text" name="title" value="'.$result["title"].'" required></div>';
        echo '<div>ジャンル：<input type="text" name="genre" value="'.$result["genre"].'" required></div>';
    }else{
        echo '<input type="hidden" name="title" value="トップページ">';
        echo '<input type="hidden" name="genre" value="">';
    }
    ?>
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
                <div id="img"><a href="image_display.php" target="_blank">画像一覧</a>　</div>
            </div>
            <textarea name="content" id="area"><?=$result["content"]?></textarea>
        </div>
        
        <div class="preview main">
        <p class="inline main">プレビュー</p>
            <div class="box" id="box"><?=$result["content"]?></div>
        </div>
    </div>


    <input type="hidden" name="pageNo" value="<?=$_GET["pageNo"]?>">
    <input type="hidden" name="updateNo" value="<?=$_GET["updateNo"]?>">
    <input type="submit" value="更新する"></form>
    <script src="js/editor.js"></script>
</body>
</html>
