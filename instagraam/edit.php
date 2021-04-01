<?php

require_once('funcs.php');

try {
    //ID:'root', Password: 'root' ここはてデータベース名
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }


  $stmt = $pdo->prepare('SELECT * FROM instagraam WHERE id=?');
  $status = $stmt->execute([$_REQUEST['id']]);


  $view = "";
  if ($status == false) {
      $error = $stmt->errorInfo();
      exit('ErrorQuery:' . print_r($error, true));
  }else{
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
          // 配列の中の何を抜き出すか
          $img = h($result['name']);
          $view = '<p>'.h($result['created_at']).'   '.'<a href=delete.php?id='.h($result['id']).'>削除する</a>'.'</p>';
          
          echo '<form method="post" action="update.php">';
          echo '<div style="margin-bottom:60px">'.'<img width="400px" height="400px" src= "img/'.$img.'">'.'</br>';
          echo '<label><input type="hidden" name="id" value="'.h($result['id']).'"></label>';
          echo '<label>タイトル：<input type="text" name="title" value="'.h($result['title']).'"></label>';
          echo '<label>コメント:<textarea type="text" name="coment" rows="5">'.h($result['coment']).'</textarea></label>';
          echo '<input type="submit" value="更新"></div>';
          echo '</form>';
      }
      }



// '<a href=delete.php?id='.h($result['id']).'>削除する</a>'


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <div class="container jumbotron"><?= $view ?></div>
    </div>
    <div>
    <p><a class="" href="select.php">投稿一覧へ</p>
    </div>
</body>
</html>