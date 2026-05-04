<?php
session_start();
require 'db.php';

$identifier = trim($_POST['identifier'] ?? '');
$password = $_POST['password'] ?? '';

if ($identifier === '' || $password === '') {
    echo '<p style="color:red;">Erreur : les deux champs sont obligatoires.</p>';
    echo '<p><a href="login.html">Retour à la connexion</a></p>';
    exit;
}

$stmt = $pdo->prepare('SELECT id, login, password FROM users WHERE login = ? OR email = ?');
$stmt->execute([$identifier, $identifier]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    echo '<p style="color:red;">Erreur : identifiant ou mot de passe invalide.</p>';
    echo '<p><a href="login.html">Retour à la connexion</a></p>';
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['login'] = $user['login'];
header('Location: index.php');
exit;
