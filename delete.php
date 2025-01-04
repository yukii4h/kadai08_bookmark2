<?php
require 'db_connect.php';

$id = $_GET['id'] ?? null;

if ($id === null) {
    echo 'IDが指定されていません';
    exit;
}

$stmt = $pdo->prepare('DELETE FROM bookmarks WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: select.php');
exit;
?>