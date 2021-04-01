<?php

$title = $_REQUEST['title'];
$coment =  $_REQUEST['coment'];
$id =  $_REQUEST['id'];


try {
  
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
    $stmt = $pdo->prepare("UPDATE instagraam SET title='.$title.',coment='.$coment.' WHERE id='.$id.'");
    

    
}catch (Exception $e){
    echo 'エラーが発生しました。:'.$e->getMessage();
}

   if($stmt->execute()){

    echo "更新しました。";

   }else{
       echo "更新に失敗しました。";
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" initial-scale=1.0 >
    <title>投稿削除</title>
</head>
<body>
    <p><a href="select.php">投稿一覧へ</a></p>
    <p><a href="index.php">新規投稿へ</a></p>
</body>
</html>