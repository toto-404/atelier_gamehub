<?php
session_start();
require 'db.php';

$login = trim($_POST['login'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$errors = [];
$patternLogin = '/^[A-Za-z0-9]{5,}$/';
$patternPassword = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';

if ($login === '' || $email === '' || $password === '' || $confirmPassword === '') {
    $errors[] = 'Tous les champs doivent être remplis.';
}

if ($login !== '' && !preg_match($patternLogin, $login)) {
    $errors[] = 'Le login doit contenir au moins 5 caractères alphanumériques.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'L’adresse email n’est pas valide.';
}

if ($password !== '' && !preg_match($patternPassword, $password)) {
    $errors[] = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.';
}

if ($password !== '' && $confirmPassword !== '' && $password !== $confirmPassword) {
    $errors[] = 'La confirmation du mot de passe ne correspond pas.';
}

if (empty($errors)) {
    $stmt = $pdo->prepare('SELECT login, email FROM users WHERE login = ? OR email = ?');
    $stmt->execute([$login, $email]);

    while ($row = $stmt->fetch()) {
        if ($row['login'] === $login) {
            $errors[] = 'Ce login est déjà utilisé.';
        }
        if ($row['email'] === $email) {
            $errors[] = 'Cette adresse email est déjà utilisée.';
        }
    }
}

if (!empty($errors)) {
    foreach ($errors as $message) {
        echo '<p style="color:red;">Erreur : ' . htmlspecialchars($message) . '</p>';
    }
    echo '<p><a href="register.html">Retour au formulaire</a></p>';
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (login, email, password) VALUES (?, ?, ?)');
$stmt->execute([$login, $email, $passwordHash]);

echo '<p style="color:green;">Inscription réussie. Vous pouvez maintenant vous connecter.</p>';
echo '<p><a href="login.html">Aller à la connexion</a></p>';
