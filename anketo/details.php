<?php
include "funcs.php";
$pdo = pdo_init();

$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    $result = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート</title>
</head>
<body>

    <h1>アンケート入力画面</h1>
    <form method="post" action="update.php">

        <div>・お名前</div>
        <input type="text" name="name" value=<?=$result["name"]?> required><br>

        <br><div>・お住まい</div>
        <select name="area">
        <?php
            $area= array('北海道','東北','関東','中部','近畿','中国','四国','九州');
            for($i = 0 ; $i < count($area) ; $i++){
                if($result["area"]==$i+1){
                    echo '<option value="'. ($i+1) .'" selected required>'. $area[$i] .'</option>';
                }else{
                    echo '<option value="'. ($i+1) .'">'. $area[$i] .'</option>';
                }
            }
        ?>
        </select><br>

        <br><div>・年代</div>
        <?php
            $age = array('10 代以下','20 代','30 代','40 代','50 代','60 代','70 代','80 代以上');
            for($i = 0 ; $i < count($age) ; $i++){
                if($result["age"]==$i+1){
                    echo '<input type="radio" name="age" value='. ($i+1) .' checked required>'. $age[$i] . "<br>";
                }else{
                    echo '<input type="radio" name="age" value='. ($i+1) .'>'. $age[$i] . "<br>";
                }
            }
        ?>
        
        <br><div>・当社の製品をどこでお知りになりましたか？（複数回答可）</div>
        <?php
            $know_from = array('インターネット','チラシ','新聞','口コミ','その他');
            $know = explode(",",$result["know_from"]);
            for($i = 0 ; $i < count($know_from) ; $i++){
                $cheaked = false;
                for($j = 0 ; $j < count($know) ; $j++){
                    if($know[$j]==$i+1){
                        echo '<input type="checkbox" name="know_from[]" value='. ($i+1) .' checked>'. $know_from[$i] . "<br>";
                        $cheaked = true;
                    }
                }
                if($cheaked == false)echo '<input type="checkbox" name="know_from[]" value='. ($i+1) .'>'. $know_from[$i] . "<br>";
            }
        ?>


        <br><div>・ご意見・ご要望</div>
        <textarea name="comment" rows="10" cols="40"><?=$result["comment"]?></textarea>
        <input type="hidden" name="id" value="<?= $result["id"] ?>">
        <br><input type="submit" value="送信する">
    </form>

</body>
</html>