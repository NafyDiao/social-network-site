<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membres</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #555;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        nav {
            background-color: #555;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        .membre {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        a.button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px;
            background-color: #9c9c9c;
            color: #000;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.button:hover {
            background-color: #2980b9;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <h1>Membres</h1>
    
</header>
<nav>
    <a href="accueil.php">Accueil</a>
    <a href="description.php">Présentation</a>
    <a href="membre.php">Membres</a>
    <a href="publication.php">Publication</a>
    <a href="logout.php">Déconnexion</a>
</nav>
<?php
    //  Connexion à la base de données
    $con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

    // Récupération de la liste des membres depuis la base de données
    $query = "SELECT * FROM membre";
    $result = mysqli_query($con, $query);
?>
<h1>Membres</h1>
<!-- Formulaire de recherche -->
<form method="get" action="membre.php">
        <label for="search">Rechercher membre :</label>
        <input type="text" id="search" name="search" placeholder="Nom ou prénom">
        <button type="submit">Rechercher</button>
    </form>
<?php
// je Vérifie si une recherche a été effectuée
if(isset($_GET['search']) && !empty($_GET['search'])) {
    // je Nettoye la chaîne de recherche pour éviter les injections SQL
    $search = mysqli_real_escape_string($con, $_GET['search']);
    // j'ajoute une clause WHERE à la requête SQL pour filtrer les résultats
    $query .= " WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%'";
}
$result = mysqli_query($con, $query);
    // Vérification s'il y a des membres à afficher
    if ($result && mysqli_num_rows($result) > 0) {
        // Affichage de chaque membre
        while ($membre = mysqli_fetch_assoc($result)) {
?>
            <div class="membre">
                <h3><?= $membre['nom'] ?> <?= $membre['prenom'] ?></h3>
                <p>Sexe: <?= $membre['sexe'] ?></p>
                <a href="modifier_membres.php?id=<?= $membre['id'] ?>">Modifier</a> | <a href="supprimer_membres.php?id=<?= $membre['id'] ?>">Supprimer</a>
            </div>
<?php
        }
    } else {
        echo "<p>Aucun membre trouvé.</p>";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($con);
?>
<!-- Bouton pour ajouter un membre -->
<a href='ajouter_membres.php' class="button">Ajouter membre</a>
<footer>
    &copy; 2024 IsepChat
</footer>
</body>
</html>
