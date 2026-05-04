Atelier professionnel - Gestion de projet appliquée à
GameHub
Activité : organiser l’évolution du projet GameHub
Travail : en binôme
Outils utilisés :
● UMLetino pour les diagrammes UML : https://www.umletino.com/umletino.html
● Trello pour le tableau Kanban : https://trello.com
● Projet GameHub déjà commencé en cours
1. Contexte
Vous travaillez sur le projet GameHub, un mini-site web consacré aux jeux vidéo.
Dans les ateliers précédents, le projet GameHub permet déjà de travailler sur :
● l’inscription d’un utilisateur ;
● la connexion d’un utilisateur ;
● l’utilisation d’une session PHP ;
● l’ajout de jeux vidéo ;
● l’enregistrement des données en base MySQL ;
● l’affichage de tous les jeux ;
● l’affichage des jeux ajoutés par l’utilisateur connecté.
La partie 2 du projet prévoit notamment une table users, une table games, ainsi qu’un
champ user_id permettant de savoir quel utilisateur a ajouté un jeu.
Aujourd’hui, vous allez prendre du recul sur le projet.
L’objectif n’est pas seulement de coder, mais aussi de comprendre comment une équipe
organise le travail avant de développer de nouvelles fonctionnalités.
2. Objectifs de l’activité
À la fin de l’activité, vous devez être capables de :
● comprendre un cahier des charges simple ;
● identifier les acteurs et les fonctionnalités d’une application ;
● produire des diagrammes UML simples ;
● organiser le travail avec un tableau Kanban ;
1/11
● rédiger des tickets de développement ;
● commencer à développer une ou plusieurs évolutions du projet.
3. Travail à faire
Cas n°1 — Vous n’avez pas terminé GameHub
Si votre projet GameHub n’est pas terminé, vous devez d’abord finaliser les fonctionnalités
obligatoires du projet actuel :
● inscription ;
● connexion ;
● session PHP ;
● ajout d’un jeu ;
● affichage des jeux sur la page d’accueil ;
● affichage des jeux de l’utilisateur connecté.
Une fois cette partie terminée, vous passez à l’activité d’évolution du projet.
Cas n°2 — Vous avez terminé GameHub
Si votre projet GameHub fonctionne déjà, vous commencez directement l’activité suivante.
Vous devez organiser une nouvelle version du projet GameHub à partir du cahier des
charges ci-dessous.
4. Cahier des charges — Évolution de GameHub
4.1. Besoin du client
Le client souhaite améliorer le site GameHub.
Actuellement, un utilisateur peut s’inscrire, se connecter, ajouter un jeu vidéo et consulter
ses jeux.
Le client souhaite maintenant ajouter plusieurs fonctionnalités afin de rendre le site plus
complet et plus agréable à utiliser.
4.2. Fonctionnalités demandées
La nouvelle version de GameHub devra permettre :
1. de se déconnecter ;
2. de protéger l’accès à la page Mes jeux ;
3. de modifier un jeu ajouté par l’utilisateur connecté ;
4. de supprimer un jeu ajouté par l’utilisateur connecté ;
2/11
5. de rechercher un jeu par titre ;
6. de filtrer les jeux par genre ;
7. d’afficher le login du créateur d’un jeu ;
8. d’afficher un message clair lorsqu’aucun jeu n’est disponible ou lorsqu’aucun résultat
ne correspond à la recherche.
Ces évolutions sont cohérentes avec les bonus déjà proposés dans le projet GameHub,
notamment le bouton de déconnexion, la protection de favorites.php, l’affichage du login
du créateur et l’amélioration du design.
4.3. Règles de gestion
Règle 1 — Déconnexion
Un utilisateur connecté doit pouvoir se déconnecter.
Après la déconnexion :
● la session est détruite ;
● l’utilisateur revient à la page d’accueil ;
● le message “Bonjour [login]” ne doit plus apparaître.
Règle 2 — Protection de la page “Mes jeux”
La page Mes jeux ne doit être accessible qu’aux utilisateurs connectés.
Si un visiteur non connecté tente d’accéder à cette page :
● il doit être redirigé vers la page de connexion ;
● ou un message clair doit lui indiquer qu’il doit se connecter.
Règle 3 — Modification d’un jeu
Un utilisateur connecté peut modifier uniquement les jeux qu’il a lui-même ajoutés.
Il peut modifier :
● le titre ;
● le genre ;
● la description ;
● le nom du fichier image.
Il ne doit pas pouvoir modifier les jeux ajoutés par un autre utilisateur.
Règle 4 — Suppression d’un jeu
Un utilisateur connecté peut supprimer uniquement les jeux qu’il a lui-même ajoutés.
Il ne doit pas pouvoir supprimer les jeux ajoutés par un autre utilisateur.
3/11
Une confirmation avant suppression est souhaitable.
Règle 5 — Recherche par titre
Un visiteur ou un utilisateur connecté peut rechercher un jeu par titre depuis la page
d’accueil.
La recherche doit afficher les jeux dont le titre contient le mot saisi.
Si aucun jeu ne correspond, un message clair doit être affiché.
Règle 6 — Filtre par genre
Un visiteur ou un utilisateur connecté peut filtrer les jeux par genre.
Exemples de genres possibles :
● Action ;
● Aventure ;
● RPG ;
● Sport ;
● Stratégie ;
● Simulation.
Si aucun jeu ne correspond au genre demandé, un message clair doit être affiché.
Règle 7 — Affichage du créateur
Sur la page d’accueil, chaque carte de jeu doit afficher le login de l’utilisateur qui a ajouté le
jeu.
Exemple :
Ajouté par : playerOne
5. Analyse du cahier des charges
Dans votre document de rendu, répondez aux questions suivantes.
Questions
1. Quels sont les acteurs de l’application ?
2. Quelles fonctionnalités existent déjà dans GameHub ?
3. Quelles nouvelles fonctionnalités sont demandées par le client ?
4. Quelles fonctionnalités nécessitent d’être connecté ?
5. Quelles fonctionnalités sont accessibles à un visiteur non connecté ?
6. Quelles données sont manipulées par l’application ?
4/11
7. Quelles règles de sécurité faut-il respecter ?
8. Quelle fonctionnalité vous semble prioritaire ? Justifiez votre réponse.
6. Diagramme de cas d’utilisation
Vous devez réaliser un diagramme de cas d’utilisation avec UMLetino.
Outil à utiliser
Allez sur :
https://www.umletino.com/umletino.html
Acteurs à représenter
Vous devez au minimum représenter :
● le visiteur ;
● l’utilisateur connecté.
Cas d’utilisation attendus
Votre diagramme doit faire apparaître les cas d’utilisation suivants :
● consulter les jeux ;
● rechercher un jeu ;
● filtrer les jeux par genre ;
● s’inscrire ;
● se connecter ;
● se déconnecter ;
● ajouter un jeu ;
● consulter mes jeux ;
● modifier un jeu ;
● supprimer un jeu.
À insérer dans le rendu
Vous devez insérer dans votre document Word :
● une capture du diagramme ;
7. Diagramme de classes
Vous devez réaliser un diagramme de classes simplifié avec UMLetino.
5/11
Classes attendues
Votre diagramme doit contenir au minimum les deux classes suivantes :
Utilisateur
- id
- login
- email
- password
Jeu
- id
- title
- genre
- description
- image
- user_id
Relation attendue
Vous devez représenter la relation suivante :
Un utilisateur peut ajouter plusieurs jeux.
Un jeu appartient à un seul utilisateur.
Attention
Le diagramme doit rester simple.
Il ne s’agit pas de représenter tout le code PHP, mais les principales données manipulées
par l’application.
À insérer dans le rendu
Vous devez insérer dans votre document Word :
● une capture du diagramme
8. Diagramme de séquence
Vous devez réaliser un diagramme de séquence avec UMLetino.
Scénario imposé
Vous devez représenter le scénario suivant :
6/11
Modifier un jeu
Éléments à faire apparaître
Votre diagramme doit faire apparaître au minimum :
● l’utilisateur connecté ;
● la page “Mes jeux” ;
● le script ou la page de modification ;
● la session ;
● la base de données.
Déroulement attendu
Votre diagramme doit représenter les grandes étapes suivantes :
1. L’utilisateur connecté clique sur “Modifier” pour un jeu.
2. Le système récupère l’identifiant du jeu.
3. Le système vérifie que l’utilisateur est connecté.
4. Le système vérifie que le jeu appartient bien à l’utilisateur connecté.
5. Le formulaire de modification est affiché.
6. L’utilisateur modifie les informations du jeu.
7. Le système enregistre les modifications en base de données.
8. L’utilisateur est redirigé vers la page “Mes jeux”.
À insérer dans le rendu
Vous devez insérer dans votre document Word :
● une capture du diagramme ;
9. Création du tableau Kanban sur Trello
Vous devez créer un tableau Kanban sur Trello.
Outil à utiliser
Allez sur :
https://trello.com
Nom du tableau
Votre tableau doit s’appeler :
GameHub - evolution - Nom1 Nom2
7/11
Colonnes à créer
Votre tableau doit contenir les colonnes suivantes :
Backlog
À faire
En cours
À tester
Terminé
Rôle des colonnes
Backlog
Liste des fonctionnalités possibles à réaliser.
À faire
Tickets sélectionnés pour être réalisés.
En cours
Tickets actuellement en cours de développement ou de préparation.
À tester
Tickets terminés techniquement, mais qui doivent être vérifiés.
Terminé
Tickets réalisés et testés.
10. Rédaction des tickets
Vous devez créer les tickets correspondant aux fonctionnalités demandées.
Fonctionnalités à transformer en tickets
Vous devez créer au minimum un ticket pour chacune des fonctionnalités suivantes :
1. ajouter un bouton de déconnexion ;
2. protéger l’accès à la page “Mes jeux” ;
3. modifier un jeu ;
4. supprimer un jeu ;
5. rechercher un jeu par titre ;
6. filtrer les jeux par genre ;
7. afficher le login du créateur d’un jeu ;
8/11
8. afficher un message lorsqu’il n’y a aucun résultat.
Format obligatoire d’un ticket
Chaque ticket doit contenir :
Titre :
Description :
Critères d’acceptation :
Priorité :
Difficulté estimée :
Responsable :
Exemple de ticket
Vous pouvez vous aider de l’exemple suivant.
Titre :
Ajouter un bouton de déconnexion
Description :
En tant qu’utilisateur connecté,
je veux pouvoir me déconnecter,
afin de quitter ma session.
Critères d’acceptation :
- Le lien “Déconnexion” apparaît uniquement si l’utilisateur est connecté.
- Le clic détruit la session PHP.
- L’utilisateur est redirigé vers la page d’accueil.
- Le message “Bonjour [login]” ne s’affiche plus après la déconnexion.
Priorité :
Haute
Difficulté estimée :
Facile
Responsable :
Nom de l’élève ou des élèves responsables
Priorités possibles
Vous devez choisir une priorité pour chaque ticket :
Haute
Moyenne
Basse
9/11
Exemple :
● une fonctionnalité indispensable : priorité haute ;
● une amélioration utile : priorité moyenne ;
● une amélioration secondaire : priorité basse.
Difficultés possibles
Vous devez estimer la difficulté de chaque ticket :
Facile
Moyenne
Difficile
Il ne s’agit pas forcément d’avoir raison, mais de justifier votre estimation.
11. Choix des tickets à développer
Une fois les tickets créés, vous devez choisir au moins un ticket à développer dans le projet
GameHub.
Tickets conseillés pour commencer
Pour commencer, vous pouvez choisir un ticket simple :
● ajouter un bouton de déconnexion ;
● protéger la page “Mes jeux” ;
● afficher un message si aucun jeu n’est disponible ;
● afficher le login du créateur.
Tickets plus difficiles
Les tickets suivants sont plus complets :
● modifier un jeu ;
● supprimer un jeu ;
● rechercher un jeu par titre ;
● filtrer les jeux par genre.
12. Développement et tests
Si vous développez un ticket, vous devez compléter dans votre document de rendu :
Ticket choisi :
Fichiers modifiés :
10/11
Description de ce qui a été codé :
Tests réalisés :
Résultat obtenu :
Difficultés rencontrées :
Exemple de tests attendus
Pour le bouton de déconnexion :
Test 1 :
Je me connecte avec un utilisateur.
Résultat attendu : le message “Bonjour [login]” apparaît.
Test 2 :
Je clique sur “Déconnexion”.
Résultat attendu : la session est détruite et je reviens à l’accueil.
Test 3 :
Je recharge la page.
Résultat attendu : le message “Bonjour [login]” n’apparaît plus.
13. Travail à rendre
Vous devez rendre un document Word contenant :
1. les noms des élèves du binôme ;
2. les réponses aux questions d’analyse ;
3. le diagramme de cas d’utilisation ;
4. le diagramme de classes ;
5. le diagramme de séquence ;
6. une capture du tableau Trello ;
7. la liste des tickets créés ;
8. le ou les tickets choisis pour le développement ;
9. les captures du résultat si une fonctionnalité a été codée ;
10. les tests réalisés ;
11. les difficultés rencontrées.
11/11