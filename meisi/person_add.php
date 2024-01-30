<?php
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "SELECT * FROM company WHERE company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', $_GET["company_id"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $company = $stmt->fetch();
    
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
    <title>営業先掲示板(個人データ登録)</title>
  </head>

  <body>
    <!-- 青枠 -->
    <div class="background">
      <div class="content">
        <!-- コンテンツ幅のためのBOX -->
        <div class="wrapper">
            
          <!-- パンくずリスト -->
          <ul class="topic-path">
            <li><a href="index.php">TOP</a></li>
            <span>&gt;</span>
            <li><?php echo pankuzu(); ?></li>
            <span>&gt;</span>
            <li><a href="company.php?company_id=<?php echo $company['company_id'] ?>"><?php echo $company['company_name'] ?></a></li>
            <span>&gt;</span>
            <li>個人データ登録</li>
          </ul>
          
          <h1 class="form-title">
            個人データ登録
          </h1>
          <div class="line__form"></div>
          
          <form class="form" method="post" enctype="multipart/form-data" action="person_into.php?company_id=<?php echo $_GET['company_id']; ?>">
            
            <div class="form-item">
              <p class="form-item__label">氏名</p>
              <input type="text" name="person_name" class="form-item__input" placeholder="田中　太郎" required>
            </div>
            
            <div class="form-item">
              <p class="form-item__label">会社名</p>
              <p><?php echo $company['company_name']; ?></p>
            </div>
            
            <div class="form-item">
              <p class="form-item__label">所属</p>
              <input type="text" name="person_division" class="form-item__input" placeholder="総務部" required>
            </div>
            
            <div class="form-item">
              <p class="form-item__label form-flex">電話番号<span class="form-item__label_optional">任意</span></p>
              <input type="text" name="person_phone_number" class="form-item__input" placeholder="000-0000-0000">
            </div>
            
            <div class="form-item">
              <p class="form-item__label form-flex">メールアドレス<span class="form-item__label_optional">任意</span></p>
              <input type="text" name="person_mail_address" class="form-item__input" placeholder="aabbccdd@gmail.com">
            </div>
            
            
            <div class="form-item">
              <p class="form-item__label form-flex">名刺画像<span class="form-item__label_optional">任意</span></p>
              
              <div class="form-flex">
                <label class="input-file__btn">
                  <input id="input-file" type="file" name="person_image">ファイルを選択
                </label>
                <p class="input-file__name">ファイルが選択されていません</p>
              </div>
            </div>
            
            <div class="line__form"></div>
            
            <div class="form-item">
              <p class="form-item__label">登録者氏名</p>
              <input type="text" name="person_added_user" class="form-item__input" placeholder="田中　一郎" required>
            </div>  
            
            <!--<input type="submit" value="会社データ登録" id="submit" class="form-input__btn">-->
            
            <!-- 会社登録ボタン -->
           <!--<input type="submit" value="会社データ登録" id="submit" class="form-input__btn">-->
            
            <!-- 個人データ登録ボタン -->
            <input type="submit" value="個人データ登録" id="submit" class="form-input__btn">
          </form>
          
        </div> <!-- .wrapper -->
      </div> <!-- .content -->
    </div> <!-- .background -->
    <!---- JS ---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/form.js"></script>
    <script src="js/file.js"></script>
  </body>
</html>
