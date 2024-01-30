<?php
    include "funcs.php";

    if(isset($_GET["page_no"])){
        $page_no = $_GET["page_no"];
    }else{
        $page_no = 1;
    }
    $_SESSION['page_no'] = $page_no;
    

    $pdo = pdo_init();

    
    $search = "";
    if(isset($_GET["search"])){
        $search = $_GET["search"];
        $sql = "SELECT * FROM company WHERE company_name LIKE :search ORDER BY company_id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', "%" . $search . "%", PDO::PARAM_STR);
    }else{
        $sql = "SELECT * FROM company ORDER BY company_id DESC";
        $stmt = $pdo->prepare($sql);
    }
    $_SESSION['search'] = $search;

    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    $i = 0;
    //会社一覧
    $content_num = 10;
    $count=$stmt->rowCount();
    $page_count = ceil($count / $content_num);
    $company = "";
    $company .= '<ul class="campany-list">';
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if($i >= ($page_no - 1) * $content_num && $i < ($page_no - 1) * $content_num + $content_num){
            $company .= '<li>
            <a href="company.php?company_id='. $result['company_id'] .'"  class="company__button">'. $result['company_name'] .'</a>
            </li>
            ';
        }
        $i++;
    }
    $company .= '</ul>';
    //ページネーション
    $page ="";
    $page .= '<ul class="pagination">
    ';
    if ($page_no != 1){
        $page .= '<li>
        <a href="index.php?search=' . $search . '&page_no='. ($page_no-1) .'">&lt;</a>
        </li>
        ';
        $page .= '<li>
        <a href="index.php?search=' . $search . '&page_no='. 1 .'">1</a>
        </li>
        ';
    } else {
        $page .= '<li class="disabled">
        <a href="index.php?search=' . $search . '&page_no='. ($page_no-1) .'">&lt;</a>
        </li>
        ';
        $page .= '<li class="active">
        <a href="index.php?search=' . $search . '&page_no='. 1 .'">1</a>
        </li>
        ';
    }

    for($j = 2; $j < $page_count; $j++){
        if($page_no != $j){
            if($j > $page_no - 3 && $j < $page_no + 3){
                $page .= '<li>
                <a href="index.php?search='.$search.'&page_no='. $j .'">'. $j .'</a>
                </li>
                ';
            }else if($j == $page_no - 3 || $j == $page_no + 3){
                $page .= '<li  class="disabled">
                <a>...</a>
                </li>
                ';
            }
        }
        else $page .= '<li class="disabled">
        <a href="index.php?search='.$search.'&page_no='. $j .'">'. $j .'</a>
        </li>
        ';
    }

    if ($page_no != $page_count){
        if ($page_count != 1 && $page_count != 0) $page .= '<li>
        <a href="index.php?search=' . $search . '&page_no='. $page_count .'">' . $page_count . '</a>
        </li>
        ';
        $page .= '<li>
        <a href="index.php?search=' . $search . '&page_no='. ($page_no+1) .'">&gt;</a>
        </li>
        ';
    }else{
        if ($page_count != 1 && $page_count != 0) $page .= '<li class="active">
        <a href="index.php?search=' . $search . '&page_no='. $page_count .'">' . $page_count . '</a>
        </li>
        ';
        $page .= '<li class="disabled">
        <a href="index.php?search=' . $search . '&page_no='. ($page_no+1) .'">&gt;</a>
        </li>';
    }

    $page .= '
    </ul>';
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
    <title>営業先掲示板</title>
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
            <li><?php echo $_SESSION['search'] . $_SESSION['page_no'] .'ページ目</a> '; ?></li>
          </ul>
          
          <!-- ページ上部 -->
          <div class="upper">
            
            <!-- 検索ボックス -->
            <form method="get" action="index.php" class="search-box">
              <button type="submit" value="検索" id="submit" aria-label="検索"></button>
              <label>
                <input type="text" name="search" placeholder="会社名で検索">
              </label>
            </form>
            
            <!-- 会社登録ボタン -->
            <a href="company_add.php" class="btn-new">
                会社データ<br class="sp">登録
            </a>
            
          </div>
          
          <!-- 会社リスト -->
          <?php echo $company; ?>
          
          <!-- ページネーション -->
          <?php echo $page; ?>

        </div> <!-- .wrapper -->
      </div> <!-- .content -->
    </div> <!-- .background -->
  </body>
</html>
