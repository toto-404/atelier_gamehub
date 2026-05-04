<?php
$host = '127.0.0.1';
$dbName = 'gamehub';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbName`");

    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            login VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS games (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(150) NOT NULL,
            genre VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            image VARCHAR(255) NOT NULL,
            user_id INT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    echo 'Base de données "' . $dbName . '" et tables créées avec succès.';
} catch (PDOException $e) {
    echo 'Erreur lors de la création de la base : ' . $e->getMessage();
}
