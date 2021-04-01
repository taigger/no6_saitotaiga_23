<?php

try {
  
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
    $stmt = $pdo->prepare('DELETE FROM instagraam WHERE id=?');
    $stmt->execute([$_REQUEST['id']]);
    echo "削除しました。";
}catch (Exception $e){
    echo 'エラーが発生しました。:'.$e->getMessage();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>投稿削除</title>
</head>
<body>
    <p><a href="select.php">投稿一覧へ</a></p>
    <p><a href="index.php">新規投稿へ</a></p>
</body>
</html>