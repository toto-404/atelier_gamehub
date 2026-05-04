<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

require 'db.php';

$title = trim($_POST['title'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$description = trim($_POST['description'] ?? '');
$image = trim($_POST['image'] ?? '');

$errors = [];
if ($title === '') {
    $errors[] = 'Le titre est obligatoire.';
}
if ($genre === '') {
    $errors[] = 'Le genre est obligatoire.';
}
if ($description === '') {
    $errors[] = 'La description est obligatoire.';
}
if ($image === '') {
    $errors[] = 'Le nom du fichier image est obligatoire.';
}

if (!empty($errors)) {
    foreach ($errors as $message) {
        echo '<p style="color:red;">Erreur : ' . htmlspecialchars($message) . '</p>';
    }
    echo '<p><a href="add_game.html">Retour au formulaire</a></p>';
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO games (title, genre, description, image, user_id) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$title, $genre, $description, $image, $_SESSION['user_id']]);
    echo '<p style="color:green;">Jeu ajouté avec succès.</p>';
    echo '<p><a href="favorites.php">Voir mes jeux</a> | <a href="index.php">Retour à l’accueil</a></p>';
} catch (PDOException $e) {
    echo '<p style="color:red;">Erreur lors de l’ajout du jeu : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
