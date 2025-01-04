<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];

    $stmt = $pdo->prepare('INSERT INTO bookmarks (title, url, created_at) VALUES (:title, :url, NOW())');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);
    $stmt->execute();

    header('Location: select.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ブックマーク登録</title>
</head>
<body>
    <h1>ブックマーク登録</h1>
    <form action="insert.php" method="post">
        <p>タイトル: <input type="text" name="title"></p>
        <p>URL: <input type="text" name="url"></p>
        <button type="submit">登録</button>
    </form>
</body>
</html>