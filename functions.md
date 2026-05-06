# Codes du Projet GameHub - Explications Simples

## 1. Ajouter un bouton de déconnexion

**Fichier :** index.php (dans la navigation)

```php
<?php if (isset($_SESSION['user_id'])) : ?>
    <li class="nav-item"><a class="nav-link" href="add_game.html">Ajouter un jeu</a></li>
    <li class="nav-item"><a class="nav-link" href="favorites.php">Mes jeux</a></li>
    <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
<?php else : ?>
    <li class="nav-item"><a class="nav-link" href="register.html">Inscription</a></li>
    <li class="nav-item"><a class="nav-link" href="login.html">Connexion</a></li>
<?php endif; ?>
```

**Explication simple :** Si tu es connecté (comme si tu as une clé magique), tu vois le bouton "Déconnexion". Sinon, tu vois "Inscription" et "Connexion". C'est comme un panneau qui change selon si tu es à la maison ou pas.

**Fichier :** logout.php

```php
<?php
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit;
?>
```

**Explication simple :** Ce code efface ta "clé magique" (session) et te ramène à la page d'accueil. C'est comme ranger tes jouets et rentrer chez toi.

## 2. Protéger l’accès à la page “Mes jeux”

**Fichier :** favorites.php (au début)

```php
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
```

**Explication simple :** Avant de voir la page, le code vérifie si tu as ta "clé magique". Si non, il te renvoie à la page de connexion. C'est comme un garde qui ne laisse entrer que les amis avec la bonne clé.

## 3. Modifier un jeu

**Fichier :** favorites.php (dans la carte du jeu)

```php
<a href="edit_game.php?id=<?php echo $game['id']; ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
```

**Explication simple :** Un bouton qui t'emmène à une page pour changer ton jeu. C'est comme un crayon pour dessiner à nouveau sur ton dessin.

**Fichier :** edit_game.php (partie principale)

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... validation ...
    $stmt = $pdo->prepare('UPDATE games SET title = ?, genre = ?, description = ?, image = ? WHERE id = ? AND user_id = ?');
    $stmt->execute([$title, $genre, $description, $image, $id, $_SESSION['user_id']]);
    header('Location: favorites.php');
    exit;
}
```

**Explication simple :** Quand tu envoies le formulaire, le code change les infos du jeu dans la base de données, mais seulement si c'est ton jeu. Puis il te ramène à ta liste. C'est comme corriger une erreur dans ton cahier.

## 4. Supprimer un jeu

**Fichier :** favorites.php (dans la carte du jeu)

```php
<form method="POST" action="delete_game.php" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce jeu ?');">
    <input type="hidden" name="id" value="<?php echo $game['id']; ?>">
    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
</form>
```

**Explication simple :** Un bouton qui demande "Es-tu sûr ?" avant de supprimer. C'est comme demander la permission avant de jeter un jouet.

**Fichier :** delete_game.php

```php
$stmt = $pdo->prepare('DELETE FROM games WHERE id = ? AND user_id = ?');
$stmt->execute([$id, $_SESSION['user_id']]);
header('Location: favorites.php');
exit;
```

**Explication simple :** Le code efface le jeu de la base, mais seulement si c'est le tien. Puis il te ramène à ta liste. C'est comme mettre un jouet à la poubelle.

## 5. Rechercher un jeu par titre

**Fichier :** index.php (formulaire de recherche)

```php
<form method="GET" class="row g-3">
    <div class="col-md-6">
        <label for="search" class="form-label">Rechercher par titre</label>
        <input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Entrez un titre...">
    </div>
    <!-- ... -->
    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Rechercher</button>
    </div>
</form>
```

**Explication simple :** Un champ où tu tapes un mot, et le bouton cherche les jeux avec ce mot dans le titre. C'est comme chercher un livre dans une bibliothèque en disant "celui avec 'chat'".

**Fichier :** index.php (requête SQL)

```php
$query = 'SELECT g.*, u.login AS creator FROM games g JOIN users u ON g.user_id = u.id';
$conditions = [];
if ($search !== '') {
    $conditions[] = 'g.title LIKE ?';
    $params[] = '%' . $search . '%';
}
// ... exécution
```

**Explication simple :** La requête regarde dans la base si le titre contient ton mot. C'est comme le bibliothécaire qui trouve les livres avec ton mot.

## 6. Filtrer les jeux par genre

**Fichier :** index.php (menu déroulant)

```php
<select class="form-select" id="genre" name="genre">
    <option value="">Tous les genres</option>
    <option value="Action" <?php if ($genre === 'Action') echo 'selected'; ?>>Action</option>
    <!-- autres options -->
</select>
```

**Explication simple :** Un menu pour choisir un genre, comme choisir "voitures" ou "poupées" dans tes jouets.

**Fichier :** index.php (requête SQL)

```php
if ($genre !== '') {
    $conditions[] = 'g.genre = ?';
    $params[] = $genre;
}
```

**Explication simple :** La requête ne montre que les jeux de ce genre. C'est comme trier tes jouets par couleur.

## 7. Afficher le login du créateur d’un jeu

**Fichier :** index.php (dans la carte)

```php
<small class="text-muted">Ajouté par : <?php echo htmlspecialchars($game['creator']); ?></small>
```

**Explication simple :** Sur chaque carte, on voit qui a ajouté le jeu. C'est comme voir le nom de l'artiste sur un dessin.

**Fichier :** index.php (requête SQL)

```php
SELECT g.*, u.login AS creator FROM games g JOIN users u ON g.user_id = u.id
```

**Explication simple :** La requête joint les tables pour prendre le login de l'utilisateur. C'est comme relier le dessin à son créateur.

## 8. Afficher un message lorsqu’il n’y a aucun résultat

**Fichier :** index.php (message)

```php
<?php if (empty($games)) : ?>
    <?php if ($search !== '' || $genre !== '') : ?>
        <div class="alert alert-info">Aucun jeu ne correspond à votre recherche.</div>
    <?php else : ?>
        <div class="alert alert-info">Aucun jeu n'a encore été ajouté.</div>
    <?php endif; ?>
<?php endif; ?>
```

**Explication simple :** Si rien n'est trouvé, un message dit "rien ici". C'est comme dire "pas de jouets dans cette boîte" si elle est vide.

Similar code found with 1 license type