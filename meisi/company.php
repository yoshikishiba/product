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
    if($stmt -> rowCount() == 0){
        header("Location: index.php");
        exit;
    }
    
    $sql = "SELECT * FROM person WHERE company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', $_GET["company_id"], PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $msg="";
    $msg.='<ul class="person-list">';
    while($person = $stmt->fetch(PDO::FETCH_ASSOC)){
        $msg .= '
        <li>
        <a href="person.php?person_id='.$person['person_id'].'" class="person__button">'.$person['person_name'].'</a>
        </li>
        ';
    }
    $msg.='</ul>';
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
    <title>営業先掲示板(会社情報)</title>
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
            <li><?php echo $company['company_name']; ?></li>
          </ul>
          
          <!-- ページ上部(その2) -->
          <div class="upper-02">
            
            <!-- 会社登録ボタン -->
            <a href="person_add.php?company_id=<?php echo $company['company_id']; ?>" class="btn-new">
                個人データ<br class="sp">登録
            </a> 
          </div>
          
          <!-- 会社詳細 -->
          <div class="detail_com">
            <h1 class="com-name"><?php echo $company['company_name']; ?></h1>
            <div class="com-address">
              <p><?php echo "〒".$company['company_post_code']; ?></p>
              <p><?php echo $company['company_address']; ?></p>
            </div>
            
            <div class="flex">
            <!-- 登録情報 -->
            <dl class="register">
              <dt>登録者</dt>
              <dd><?php echo $company['company_added_user']; ?></dd>
              <dt>登録日</dt>
              <dd><?php echo $company['company_added_date']; ?></dd>
            </dl>
            
            <!-- 更新情報 -->
            <dl class="update">
              <dt>最終更新者</dt>
              <dd><?php echo $company['company_updated_user']; ?></dd>
              <dt>最終更新日</dt>
              <dd><?php echo $company['company_updated_date']; ?></dd>
            </dl>
            </div> <!-- .flex -->
            
          </div> <!-- .detail_com -->
          
          <!-- ライン -->
          <div class="line"></div>
          
          <!-- 社員リスト -->
          <?php echo $msg; ?>

          <!-- ページ下部 -->
          <div class="lower">
          
            <!-- 会社編集ボタン -->
            <a href="company_edit.php?company_id=<?php echo $company['company_id']; ?>" class="btn-edit">
              会社データ<br class="sp">編集
            </a> 
            <!-- 会社削除ボタン -->
            <a href="#" class="btn-delete" id="delete">
              会社データ<br class="sp">削除
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
                window.location.href = "company_delete.php?company_id=<?php echo $company['company_id']; ?>";
            }else{
                return false;
            }
        });
    </script>
  </body>
</html>
