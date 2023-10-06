<?php
    date_default_timezone_set ('Asia/Tokyo');
    if (isset($_POST['upload'])) {//送信ボタンが押された場合
        $image = date('YmdHis');//ファイル名をユニーク化→日付時刻
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
        $file = "images/$image";
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            move_uploaded_file($_FILES['image']['tmp_name'], $file);//imagesディレクトリにファイル保存
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                $message = '画像をアップロードしました.<br>';
                $message .= $file ."<br>";
                $message .= '<img src="' . $file . '" >';
            } else {
                $message = '画像ファイルではありません';
                unlink('./images/' . $image);
            }
        }
    }
?>

<h1>画像アップロード</h1>
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
    <p><?php echo $message; ?></p>
    <p><a href="image_display.php">画像一覧へ</a></p>
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <p>アップロード画像</p>
        <input type="file" name="image">
        <button><input type="submit" name="upload" value="送信"></button>
    </form>
<?php endif;?>