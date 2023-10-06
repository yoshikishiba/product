<?php
$files = glob('images/*');
rsort($files);
$msg="";
foreach ($files as $key => $value) {
    $msg .= $value . "<br>";
	$msg .= '<img src="' .$value . '" ><br><br>';
}

?>

<h1>画像一覧</h1>
<a href="image_upload.php">画像アップロード</a><br>
<?=$msg?>