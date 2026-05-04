<?php
session_start();
require 'db.php';

$search = trim($_GET['search'] ?? '');
$genre = trim($_GET['genre'] ?? '');

$query = 'SELECT g.*, u.login AS creator FROM games g JOIN users u ON g.user_id = u.id';
$conditions = [];
$params = [];

if ($search !== '') {
    $conditions[] = 'g.title LIKE ?';
    $params[] = '%' . $search . '%';
}

if ($genre !== '') {
    $conditions[] = 'g.genre = ?';
    $params[] = $genre;
}

if (!empty($conditions)) {
    $query .= ' WHERE ' . implode(' AND ', $conditions);
}

$query .= ' ORDER BY g.id DESC';

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$games = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">GameHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Accueil</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item"><a class="nav-link" href="add_game.html">Ajouter un jeu</a></li>
                    <li class="nav-item"><a class="nav-link" href="favorites.php">Mes jeux</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="register.html">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<header class="py-5 bg-secondary-subtle text-dark">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Bienvenue sur GameHub</h1>
        <p class="lead mt-3">
            Découvrez et partagez des jeux vidéo ajoutés par la communauté.
        </p>
        <?php if (isset($_SESSION['login'])) : ?>
            <p class="text-light">Bonjour <?php echo htmlspecialchars($_SESSION['login']); ?></p>
        <?php endif; ?>
    </div>
</header>

<main class="container py-5">
    <section class="mb-4">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <label for="search" class="form-label">Rechercher par titre</label>
                <input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Entrez un titre...">
            </div>
            <div class="col-md-4">
                <label for="genre" class="form-label">Filtrer par genre</label>
                <select class="form-select" id="genre" name="genre">
                    <option value="">Tous les genres</option>
                    <option value="Action" <?php if ($genre === 'Action') echo 'selected'; ?>>Action</option>
                    <option value="Aventure" <?php if ($genre === 'Aventure') echo 'selected'; ?>>Aventure</option>
                    <option value="RPG" <?php if ($genre === 'RPG') echo 'selected'; ?>>RPG</option>
                    <option value="Sport" <?php if ($genre === 'Sport') echo 'selected'; ?>>Sport</option>
                    <option value="Stratégie" <?php if ($genre === 'Stratégie') echo 'selected'; ?>>Stratégie</option>
                    <option value="Simulation" <?php if ($genre === 'Simulation') echo 'selected'; ?>>Simulation</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
            </div>
        </form>
    </section>
    <section class="mb-5">
        <h2 class="mb-3">Tous les jeux</h2>
        <?php if (empty($games)) : ?>
            <?php if ($search !== '' || $genre !== '') : ?>
                <div class="alert alert-info">Aucun jeu ne correspond à votre recherche.</div>
            <?php else : ?>
                <div class="alert alert-info">Aucun jeu n'a encore été ajouté.</div>
            <?php endif; ?>
        <?php else : ?>
            <div class="row g-4">
                <?php foreach ($games as $game) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm bg-body-tertiary">
                            <img src="images/<?php echo htmlspecialchars($game['image']); ?>" class="card-img-top" alt="Image du jeu <?php echo htmlspecialchars($game['title']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($game['title']); ?></h5>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($game['description'])); ?></p>
                            </div>
                            <div class="card-footer d-flex flex-column gap-1">
                                <small class="text-muted">Genre : <?php echo htmlspecialchars($game['genre']); ?></small>
                                <small class="text-muted">Ajouté par : <?php echo htmlspecialchars($game['creator']); ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<footer class="bg-black text-center py-3 border-top border-secondary">
    <p class="mb-0">GameHub - Projet fil rouge BTS SIO SLAM</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
