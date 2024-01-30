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
    <title>営業先掲示板(会社データ登録)</title>
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
            <li><a href="index.php?search=&page_no=1">1ページ目</a></li>
            <span>&gt;</span>
            <li>会社データ登録</li>
          </ul>
          
          <h1 class="form-title">
            会社データ登録
          </h1>
          <div class="line__form"></div>
          
          <form class="form h-adr" method="post" action="company_into.php">
            <div class="form-item">
              <p class="form-item__label">会社名</p>
              <input type="text" name="company_name" class="form-item__input" placeholder="〇〇株式会社" required>
            </div>
          
            <div class="form-item">
              <span class="p-country-name" style="display:none;">Japan</span>
              <p class="form-item__label">郵便番号</p>
              <div class="form__flex">
                <input type="text" id="zip" name="company_post_code" class="form-item__input p-postal-code" placeholder="xxx-xxxx" required>
                <input type="button" id="btn" name="company_zip" class="input-zip__btn" value="検索">
              </div>
            </div>
            
            <div class="form-item">
              <p class="form-item__label">住所</p>
              <input type="text" id="address" name="company_address" class="form-item__input p-region p-locality p-street-address p-extended-address" placeholder="〇〇県〇〇市" required>
            </div>
            
            <div class="line__form"></div>
            
            <div class="form-item">
              <p class="form-item__label">登録者氏名</p>
              <input type="text" name="company_added_user" class="form-item__input" placeholder="田中　一郎" required>
            </div>  
            
            <!-- 会社登録ボタン -->
            <input type="submit" value="会社データ登録" id="submit" class="form-input__btn">
          </form>
          
        </div> <!-- .wrapper -->
      </div> <!-- .content -->
    </div> <!-- .background -->
    <!---- JS ---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <script src="js/form.js"></script>
    <script src="js/yuubin.js"></script>
  </body>
</html>
