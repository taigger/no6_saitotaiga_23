<?php
// 画像から各種データを取得
$title = $_POST['title'];
$coment = $_POST['coment'];
// $name = $_FILES['image']['name'];
$type = $_FILES['image']['type'];
$tmp_name = $_FILES['image']['tmp_name'];
$size = $_FILES['image']['size'];
$image = uniqid(mt_rand(), true);
$image  .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file = "images/$image";

//2. DB接続します
try {
  //ID:'root', Password: 'root' ここはてデータベース名
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}
//３．データ登録SQL作成
// 1. SQL文を用意　ここはファイル名
$stmt = $pdo->prepare("INSERT INTO 
                        instagraam(id,title,coment,name,type,tmp_name,size,created_at) 
                        VALUES(NULL,:title,:coment,:name,:type,:tmp_name,:size,sysdate())");
                        //:はフォームからSQL分が送られてきたときに無効化するため
//  2. バインド変数を用意
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':coment', $coment, PDO::PARAM_STR); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $image, PDO::PARAM_STR);  
$stmt->bindValue(':type', $type, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tmp_name', $tmp_name, PDO::PARAM_STR); 
$stmt->bindValue(':size', $size, PDO::PARAM_INT); 
// ここで画像をフォルダに保存
move_uploaded_file($tmp_name, './img/'.$image);
//  3. 実行
$status = $stmt->execute();
//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}else{
  
  header('location:index.php');

}

?>