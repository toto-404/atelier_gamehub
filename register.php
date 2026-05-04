<?php
// register.php
$login = $_POST['login'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$errors = [];

// Validation patterns
$patternLogin = '/^[A-Za-z0-9]{5,}$/';
$patternEmail = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
$patternPassword = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';

// Check required fields
if (empty($login) || empty($email) || empty($password) || empty($confirmPassword)) {
    $errors[] = 'Tous les champs doivent être remplis.';
}

// Validate login
if (!empty($login) && !preg_match($patternLogin, $login)) {
    $errors[] = 'Le login doit contenir uniquement des lettres et des chiffres et comporter au moins 5 caractères.';
}

// Validate email
if (!empty($email) && !preg_match($patternEmail, $email)) {
    $errors[] = 'L\'adresse email n\'est pas valide.';
}

// Validate password
if (!empty($password) && !preg_match($patternPassword, $password)) {
    $errors[] = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.';
}

// Confirm password
if (!empty($password) && !empty($confirmPassword) && $password !== $confirmPassword) {
    $errors[] = 'La confirmation du mot de passe ne correspond pas.';
}

if (!empty($errors)) {
    foreach ($errors as $message) {
        echo '<p style="color:red;">Erreur : ' . htmlspecialchars($message) . '</p>';
    }
} else {
    echo '<p style="color:green;">Inscription réussie !</p>';
}