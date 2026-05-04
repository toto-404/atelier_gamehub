<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

require 'db.php';

$id = $_GET['id'] ?? '';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        echo '<p><a href="edit_game.php?id=' . htmlspecialchars($id) . '">Retour au formulaire</a></p>';
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE games SET title = ?, genre = ?, description = ?, image = ? WHERE id = ? AND user_id = ?');
        $stmt->execute([$title, $genre, $description, $image, $id, $_SESSION['user_id']]);
        header('Location: favorites.php');
        exit;
    } catch (PDOException $e) {
        echo '<p style="color:red;">Erreur lors de la modification du jeu : ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GameHub - Modifier un jeu</title>
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
<li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
<li class="nav-item"><a class="nav-link" href="add_game.html">Ajouter un jeu</a></li>
<li class="nav-item"><a class="nav-link active" href="favorites.php">Mes jeux</a></li>
<li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
</ul>
</div>
</div>
</nav>
<header class="py-5 bg-secondary-subtle text-dark">
<div class="container text-center">
<h1 class="display-5 fw-bold">Modifier un jeu vidéo</h1>
<p class="lead mt-3">Modifiez les informations de votre jeu.</p>
</div>
</header>
<main class="container py-5">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card shadow-sm border-0">
<div class="card-body p-4">
<h2 class="h4 mb-4 text-dark">Formulaire de modification</h2>
<form action="edit_game.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
<div class="mb-3">
<label for="title" class="form-label text-dark">Titre du jeu</label>
<input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($game['title']); ?>" required>
</div>
<div class="mb-3">
<label for="genre" class="form-label text-dark">Genre</label>
<input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($game['genre']); ?>" required>
</div>
<div class="mb-3">
<label for="description" class="form-label text-dark">Description</label>
<textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($game['description']); ?></textarea>
</div>
<div class="mb-4">
<label for="image" class="form-label text-dark">Nom du fichier image</label>
<input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($game['image']); ?>" required>
<div class="form-text">L’image doit déjà être placée dans le dossier <strong>images/</strong>.</div>
</div>
<div class="d-flex gap-2">
<button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
<a href="favorites.php" class="btn btn-outline-secondary">Annuler</a>
</div>
</form>
</div>
</div>
</div>
</div>
</main>
<footer class="bg-black text-center py-3 border-top border-secondary">
<p class="mb-0">GameHub - Projet fil rouge BTS SIO SLAM</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>