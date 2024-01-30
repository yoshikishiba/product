<?php
    include "funcs.php";
    $pdo = pdo_init();
    //前日以前に入力された予定を自動削除するSQL
    $sql = "DELETE FROM board WHERE created_date != :today";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':today', date('Y-m-d'), PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }
    
    //データベースから予定を取得するSQL
    $sql = "SELECT * FROM board WHERE created_date = :today ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':today', date('Y-m-d'), PDO::PARAM_STR);
    $status = $stmt->execute();
    if ($status == false) {
        sqlError($stmt);
    }else{
        //データベースから取得した予定を表示する
        $msg="";
        $msg .= '<section class="display__section">';
        //データベースから取得した予定の件数分、表示処理を繰り返す
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $msg .= '<div class="name"><p>';
            $msg .= $result['name'];
            $msg .= '</p></div>';
            $msg .= '<div class="time"><p>';
            $msg .= $result['start_time']."~".$result['finish_time'];
            $msg .= '</p></div>';
            $msg .= '<div class="content"><p>';
            $msg .= $result['content'];
            $msg .= '</p></div>';
            //予定の削除ボタンはここで生成。押下時に予定IDをdelete.phpにPOSTする。
            $msg .= '<div class="button"><form method="post" action="delete.php"><input type="hidden" name="id" value="'.$result['id'].'"><input type="submit" value="削除する"></form></div>';
            $msg .= '<div class="spacer"></div>';
        }
        $msg .= '</section>';
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>行先掲示板表示</title>
</head>
<body>
<h1>行先掲示板システム</h1>

<?=$msg?>
<br>

<!--追加ボタン押下時に予定の追加に必要な情報をinsert.phpにPOSTする-->
<form method="post" action="insert.php">
    <section class="input__section">
    <div class="name">
        <select name="name" required>
            <!--営業部メンバーに入れ替わりがあった場合、以下の選択肢を編集すること-->
            <option value="木下 吉彦">木下 吉彦</option>
            <option value="遠藤 孝幸">遠藤 孝幸</option>
            <option value="沖中 宏之">沖中 宏之</option>
            <option value="澤村 聡">澤村 聡</option>
            <option value="土橋 高明">土橋 高明</option>
            <option value="鶴岡 祐樹">鶴岡 祐樹</option>
            <option value="佐々木 千鶴">佐々木 千鶴</option>
            <option value="中山 奈津美">中山 奈津美</option>
            <option value="渡辺 亜美">渡辺 亜美</option>
            <option value="大森 満">大森 満</option>
        </select></div>
    <div class="time">
    <p><select name="start_hour" required>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8" selected>8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
        </select>
        :
        <select name="start_minute" required>
            <option value="00" selected>00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select></p>
        <div class="spacer"></div><p>~<p><div class="spacer"></div>
    <p><select name="end_hour" required>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17" selected>17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
        </select>
        :
        <select name="end_minute" required>
            <option value="00" selected>00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select></p></div>
    <div class="content">
    <textarea name="content" maxlength="30" placeholder="予定の内容を全角30文字まで" required></textarea></div>
    <div class="button"><input type="submit" value="追加する"></div>
    </section>    
</form>

</body>
</html>