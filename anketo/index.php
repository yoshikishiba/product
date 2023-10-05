<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート</title>
</head>
<body>

    <h1>アンケート入力画面</h1>
    <form method="post" action="submit.php">

        <div>・お名前</div>
        <input type="text" name="name" required><br>

        <br><div>・お住まい</div>
        <select name="area">
        <?php
            $area = array('北海道','東北','関東','中部','近畿','中国','四国','九州');
            for ($i = 0 ; $i < count($area) ; $i++) {
                 echo '<option value="'. ($i+1) .'" required>'. $area[$i] .'</option>';
            }
        ?>
        </select><br>

        <br><div>・年代</div>
        <?php
            $age = array('10 代以下','20 代','30 代','40 代','50 代','60 代','70 代','80 代以上');
            for ($i = 0 ; $i < count($age) ; $i++) {
                 echo '<input type="radio" name="age" value='. ($i+1) .' required>'. $age[$i] . "<br>";
            }
        ?>
        
        <br><div>・当社の製品をどこでお知りになりましたか？（複数回答可）</div>
        <?php
            $know_from = array('インターネット','チラシ','新聞','口コミ','その他');
            for ($i = 0 ; $i < count($know_from) ; $i++) {
                 echo '<input type="checkbox" name="know_from[]" value='. ($i+1) .'>'. $know_from[$i] . "<br>";
            }
        ?>


        <br><div>・ご意見・ご要望</div>
        <textarea name="comment" rows="10" cols="40"></textarea>
        <br><input type="submit" value="送信する">
    </form>

</body>
</html>