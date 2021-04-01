<?php
// おもてに出すときはJS対策をしましょうね
// function h($str){
//     return htmlspecialchars($str,ENT_QUOT);
// }

require_once('funcs.php');

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成　prepareのあとにSQLを書く。取得するだけなのでこれで終了。
$stmt = $pdo->prepare("SELECT * FROM instagraam");
$status = $stmt->execute();
// $sql = $pdo->prepare('SELECT * FROM images WHERE image_id = :image_id LIMIT 1');
// $status2 = $sql->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    // 1個1個情報を取得して＄result に入れているというイメージ
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        // 配列の中の何を抜き出すか
        $img = h($result['name']);
        $view .= '<p style="margin-bottom:60px">'.'<img width="400px" height="400px" src= "img/'.$img.'">'.'</br>'.'title:'.h($result['title']).
        '</br>'.h($result['coment']).'</br>'.h($result['created_at']).'   '.'<a href=edit.php?id='.h($result['id']).'>編集する</a>'.'</p>';
       
    }
    // while( $result2 = $sql->fetch(PDO::FETCH_ASSOC)){
    //     // 配列の中の何を抜き出すか
        
    // }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>投稿一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <nav>
    <div class="container-fluid">
        <h1>
        投稿一覧
        </h1>
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">新規投稿をする</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
