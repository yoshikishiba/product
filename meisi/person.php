<?php
    include "funcs.php";
    $pdo = pdo_init();
    $sql = "SELECT * FROM person WHERE person_id = :person_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':person_id', $_GET["person_id"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $person = $stmt->fetch();
    if($stmt -> rowCount() == 0){
        header("Location: index.php");
        exit;
    }

    $sql = "SELECT * FROM company WHERE company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', $person['company_id'], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $company = $stmt->fetch();
?>


<!DOCTYPE html>
<html lang="Ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---- Googleフォント ---->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic:wght@400;700&display=swap" rel="stylesheet">
    <!---- CSS ---->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>営業先掲示板(社員情報)</title>
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
              <li><a href="company.php?company_id=<?php echo $person['company_id'] ?>"><?php echo $company['company_name'] ?></a></li>
              <span>&gt;</span>
              <li><?php echo $person['person_name']; ?></li>
          </ul>
          
          <div class="detail_per">
            <div class="per-img">
            <img class="no-image" src="<?php 
              if ( $person['person_image_pass'] != null )
              { 
                  echo $person['person_image_pass']; 
              }else{
                  echo "img/no-image.jpg";
              }
            ?>">
            </div>
            
            <div class="per-text">
              <h1 class="per-name"><?php echo $person['person_name']; ?></h1>
              <dl class="per-info">
                <dt>所属</dt>
                <dd><?php echo $person['person_division']; ?></dd>
                <dt>電話番号</dt>
                <dd><?php echo $person['person_phone_number']; ?></dd>
                <dt>メールアドレス</dt>
                <dd><?php echo $person['person_mail_address']; ?></dd>
              </dl>
            </div>
          </div>
          
          <div class="flex">
            <!-- 登録情報 -->
            <dl class="register">
              <dt>登録者</dt>
              <dd><?php echo $person['person_added_user']; ?></dd>
              <dt>登録日</dt>
              <dd><?php echo $person['person_added_date']; ?></dd>
            </dl>
            
            <!-- 更新情報 -->
            <dl class="update">
              <dt>最終更新者</dt>
              <dd><?php echo $person['person_updated_user']; ?></dd>
              <dt>最終更新日</dt>
              <dd><?php echo $person['person_updated_date']; ?></dd>
            </dl>
          </div> <!-- .flex -->
          
          <!-- ライン -->
          <div class="line"></div>
          
          <!-- ページ下部 -->
          <div class="lower">
          
            <!-- 個人編集ボタン -->
            <a href="person_edit.php?person_id=<?php echo $person['person_id']; ?>" class="btn-edit">
              個人データ<br class="sp">編集
            </a> 
            <!-- 個人削除ボタン -->
            <a href="#" class="btn-delete" id="delete">
              個人データ<br class="sp">削除
            </a>
          </div> <!-- .lower -->
        </div> <!-- .wrapper -->
      </div> <!-- .content -->
    </div> <!-- .background -->
    
    <!---- JS ---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $("#delete").on("click",function(){
            if(confirm('会社情報を削除してもよろしいですか？この操作は取り消せません。')){
                window.location.href = "person_delete.php?person_id=<?php echo $person['person_id']; ?>";
            }else{
                return false;
            }
        });
    </script>
  </body>
</html>