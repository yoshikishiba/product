<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKIログアウト</title>
</head>
<body>
<p>ログアウトしました。</p>
<a href="index.php">ホームページへ</a>
</body>
</html>
