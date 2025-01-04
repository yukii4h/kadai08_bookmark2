<?php
require 'db_connect.php';

$stmt = $pdo->query('SELECT * FROM bookmarks ORDER BY created_at DESC');
$bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>ブックマーク一覧</title>
</head>
<body>
    <h1>ブックマーク一覧</h1>
    <ul>
    <?php foreach ($bookmarks as $bookmark): ?>
        <li>
            <a href="<?= htmlspecialchars($bookmark['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank">
                <?= htmlspecialchars($bookmark['title'], ENT_QUOTES, 'UTF-8') ?>
            </a>
            (登録日: <?= $bookmark['created_at'] ?>)
            | <a href="edit.php?id=<?= $bookmark['id'] ?>">編集</a>
            | <a href="delete.php?id=<?= $bookmark['id'] ?>" onclick="return confirm('削除しますか？')">削除</a>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>