<?php
session_start();

$identifier = $_POST['identifier'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($identifier) || empty($password)) {
    echo '<p style="color:red;">Erreur : les deux champs sont obligatoires.</p>';
    exit;
}

// Connexion simulée
$validIdentifier = 'MamaMia';
$validPassword = 'MotDePasse1234';

if ($identifier === $validIdentifier && $password === $validPassword) {
    $_SESSION['login'] = $identifier;
    header('Location: index.php');
    exit;
}

echo '<p style="color:red;">Erreur : identifiant ou mot de passe invalide.</p>';