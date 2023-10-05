<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>じぶんのて</h2>
    <?php
    $player = rand(0,2);
    switch ($player) {
    case 0:
        echo "グー";
        break;
    case 1:
        echo "チョキ";
        break;
    case 2:
        echo "パー";
        break;
    }
    ?>
    <h2>あいてのて</h2>
    <?php
    $enemy = rand(0,2);
    switch ($enemy) {
    case 0:
        echo "グー";
        break;
    case 1:
        echo "チョキ";
        break;
    case 2:
        echo "パー";
        break;
    }
    ?>
    <h2>けっか</h2>
    <?php
        if($player==$enemy){
            echo "ひきわけ";
        }else if(($player-$enemy+1)%3==0){
            echo "じぶんのかち";
        }else{
            echo "じぶんのまけ";
        }
    ?>


</body>
</html>