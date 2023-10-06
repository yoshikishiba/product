<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKIログインページ</title>
</head>
<body>
    <h1>WIKIログインページ</h1>
    <h2>ログイン</h2>
    <form method="post" action="user_login.php">
    <div>ID　：<input type="text" name="id" required></div><br>
    <div>PASS：<input type="password" name="password" required></div><br>
    <input type="submit" value="ログインする"></form>
    <?php
    if (isset($_GET["error"])){
        if ($_GET["error"] == 1){
            echo 'IDかパスワードが間違っています';
        }
    }
    ?>
    <br><br><br>
    <h2>新規登録はこちら</h2>
    <form method="post" action="user_register.php">
    <div>名前：<input type="text" name="name" required>
    <?php
        if (isset($_GET["nameerror"])){
            echo '名前['.$_GET["nameerror"].']は使われています';
        }
    ?>
    </div><br>
    <div>ID　：<input type="text" name="id" pattern="^[0-9a-zA-Z]+$" placeholder="半角英数字のみ" required>
    <?php
        if (isset($_GET["iderror"])){
            echo 'ID['.$_GET["iderror"].']は使われています';
        }
    ?>
    </div><br>
    <div>PASS：<input type="password" name="password" minlength="8" maxlength="16" pattern="^[0-9a-zA-Z]+$" placeholder="8文字以上16文字以下" required></div><br>
    <input type="submit" value="新規登録する"></form>
</body>
</html>