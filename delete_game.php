<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

require 'db.php';

$id = $_POST['id'] ?? '';
if ($id === '') {
    header('Location: favorites.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM games WHERE id = ? AND user_id = ?');
$stmt->execute([$id, $_SESSION['user_id']]);
$game = $stmt->fetch();

if (!$game) {
    header('Location: favorites.php');
    exit;
}

try {
    $stmt = $pdo->prepare('DELETE FROM games WHERE id = ? AND user_id = ?');
    $stmt->execute([$id, $_SESSION['user_id']]);
    header('Location: favorites.php');
    exit;
} catch (PDOException $e) {
    echo '<p style="color:red;">Erreur lors de la suppression du jeu : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>