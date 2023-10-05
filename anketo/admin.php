<?php
//print_r($_POST);
$area = array('北海道','東北','関東','中部','近畿','中国','四国','九州');
$age = array('10 代以下','20 代','30 代','40 代','50 代','60 代','70 代','80 代以上');
$know_from = array('インターネット','チラシ','新聞','口コミ','その他');

include "funcs.php";
$pdo = pdo_init();

$sql = "SELECT * FROM posts";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $view = '';
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<td>';
        $view .= $result["id"];
        $view .= '　</td>';
        $view .= '<td>';
        $view .= $result["name"];
        $view .= '　</td>';
        $view .= '<td>';
        $view .= $area[$result["area"]-1];
        $view .= '　</td>';
        $view .= '<td>';
        $view .= $age[$result["age"]-1];
        $view .= '　</td>';
        $view .= '<td>';
        $know = explode(",",$result["know_from"]);
        for($j = 0 ; $j < count($know) ; $j++){
            if($j!=0)$view .= ",";
            $view .= $know_from[$know[$j]-1];
        }
        $view .= '　</td>';
        $view .= '<td>';
        $view .= $result["create_at"];
        $view .= '　</td>';
        $view .= '<td>';
        $view .= '<a href="details.php?id='. $result["id"] .'" color="blue">編集</a>';
        $view .= '/';
        $view .= '<a href="delete.php?id='. $result["id"] .'" color="red">削除</a>';
        $view .= '　</td>';
        $view .= '</tr>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
</head>
<body>
    <a href="index.php" class="btn">入力画面に戻る</a>
    <h2>管理者画面</h2>
    <table>
    <thead>
        <tr>
            <th align="left">ID　</th>
            <th align="left">お名前　</th>
            <th align="left">お住まい　</th>
            <th align="left">年齢層　</th>
            <th align="left">知ったきっかけ　</th>
            <th align="left">作成日　</th>
            <th align="left">操作　</th>
        </tr>
    </thead>
    <tbody>

        <?=$view?>
    </tbody>
</table>
</body>
</html>