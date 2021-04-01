<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>instagaam </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav>
            <div class="container-fluid">
                <h1 class="navbar-header" >新規投稿をする</h1>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="insert.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>instagaam</legend>
                <label>タイトル：<input type="text" name="title"></label><br>
                <label>コメント：<textarea type="text" name="coment" rows="5"></textarea></label><br>
                <label>画像を選択</label><input name="image" type="file" required>
                <input type="submit" value="投稿！">
            </fieldset>
        </div>
        <div>
            <p><a class="" href="select.php">投稿一覧へ</p>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
