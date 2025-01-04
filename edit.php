<?php
require 'db_connect.php';

$id = $_GET['id'] ?? null;

if ($id === null) {
    echo 'IDが指定されていません';
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM bookmarks WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$bookmark = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$bookmark) {
    echo 'データが見つかりません';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];

    $stmt = $pdo->prepare('UPDATE bookmarks SET title = :title, url = :url WHERE id = :id');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: select.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>編集</title>
</head>
<body>
    <h1>編集</h1>
    <form action="edit.php?id=<?= $bookmark['id'] ?>" method="post">
        <p>タイトル: <input type="text" name="title" value="<?= htmlspecialchars($bookmark['title'], ENT_QUOTES, 'UTF-8') ?>"></p>
        <p>URL: <input type="text" name="url" value="<?= htmlspecialchars($bookmark['url'], ENT_QUOTES, 'UTF-8') ?>"></p>
        <button type="submit">保存</button>
    </form>
    <a href="select.php">戻る</a>
</body>
</html>