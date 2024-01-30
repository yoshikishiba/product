<?php
    include "funcs.php";
    //print_r($_POST);

    //画像のアップロード
    $image = "";
    $msg = "";
    if (!empty($_FILES['person_image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
        $image = uniqid("",false);//ファイル名の一意化
        $image .= strrchr($_FILES['person_image']['name'], '.');//アップロードされたファイルの拡張子を取得
        $file = "gazou/$image";//ファイル配置場所
        move_uploaded_file($_FILES['person_image']['tmp_name'], $file);//gazouディレクトリにファイル保存
        if (!exif_imagetype($file)) {//画像ファイルかのチェック
            unlink($file);//画像ファイルでないなら削除する
            $image = "error";
            $msg .= "対応している画像ファイルではありません。<br>ブラウザの戻るボタンからやり直してください。<br><br><br>";
        }
    }

    //画像アップロードに問題なければDB追加
    if($image != "error"){
        $pdo = pdo_init();
        $sql = "INSERT INTO person(person_name,company_id,person_division,person_phone_number,person_mail_address,person_added_user,person_added_date)
        VALUES(:person_name,:company_id,:person_division,:person_phone_number,:person_mail_address,:person_added_user,:person_added_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':person_name', $_POST["person_name"], PDO::PARAM_STR);
        $stmt->bindValue(':company_id', $_GET["company_id"], PDO::PARAM_STR);
        $stmt->bindValue(':person_division', $_POST["person_division"], PDO::PARAM_STR);
        $stmt->bindValue(':person_phone_number', $_POST["person_phone_number"], PDO::PARAM_STR);
        $stmt->bindValue(':person_mail_address', $_POST["person_mail_address"], PDO::PARAM_STR);
        $stmt->bindValue(':person_added_user', $_POST["person_added_user"], PDO::PARAM_STR);
        $stmt->bindValue(':person_added_date', date('Y-m-d'), PDO::PARAM_STR);
        $status = $stmt->execute();
        if ($status == false) {
            sqlError($stmt);
        }
        $person_id = $pdo -> lastInsertId();
        //画像を指定している場合、ファイルパスをDB追加
        if($image != ""){
            $sql = "UPDATE person SET person_image_pass = :person_image_pass WHERE person_id = :person_id";
            $stmt = $pdo -> prepare($sql); 
            $stmt->bindValue(':person_id', $person_id, PDO::PARAM_INT);
            $stmt->bindValue(':person_image_pass', $file, PDO::PARAM_STR);
            $status = $stmt->execute();
            if ($status == false) {
                sqlError($stmt);
            }
        }
        header("Location: person.php?person_id=". $person_id);
        exit;
    }
?>

<!doctype html>
<html lang="Ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---- Googleフォント ---->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic:wght@400;700&display=swap" rel="stylesheet">
    <!---- CSS ---->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>営業先掲示板 画像エラー</title>
  </head>
  <body>
    <div class="background">
      <div class="content">
        <!-- コンテンツ幅のためのBOX -->
        <div class="wrapper">
            <p><?php echo $msg; ?></p>
        </div> <!-- .wrapper -->
      </div> <!-- .content -->
    </div> <!-- .background -->
  </body>
</html>