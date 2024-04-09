<?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));


// Récupérer les publications depuis la base de données
$req = "SELECT * FROM publication";
$result = mysqli_query($con, $req);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Publication</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .post img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .post p {
            margin-bottom: 10px;
        }

        .add-post-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .add-post-button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>

</head>
<body>
<header>
    <h1 style="font-size: 36px; margin-bottom: 10px;">Publications</h1>
    <p style="font-size: 18px;">IsepChat</p>
</header>
<nav>
    <a href="accueil.php">Accueil</a>
    <a href="description.php">Description</a>
    <a href="membre.php">Membres</a>
    <a href="publication.php">Publication</a>
    <a href="logout.php">Déconnexion</a>
</nav>
<div class="container">
<form action="recherche.php" method="GET">
            <input type="text" name="q" placeholder="Rechercher...">
            <button type="submit">Rechercher</button>
        </form>
    <?php
    //  JE Vérifie s'il y a des publications
    if (mysqli_num_rows($result) > 0) {
        // J'Affiche chaque publication
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='post'>";
            echo "<h2>{$row['titre']}</h2>";
            echo "<img src='/uploads/{$row['image']}' alt='Image de la Publication'>";
            echo "<p>{$row['description']}</p>";
             // Formulaire de modification
            echo "<form method='post' action='modifier_publication.php'>";
            echo "<input type='hidden' name='modifier_id' value='{$row['id']}'>";
            echo "<input type='submit' value='Modifier'>";
            echo "</form>";
             // Formulaire de suppression
            echo "<form method='post' action='supprimer_publication.php'>";
            echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
            echo "<input type='submit' value='Supprimer'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucune publication disponible.</p>";
    }
    ?>
</div>

<a href="ajouter_publication.php" class="add-post-button">Ajouter une Publication</a>
<footer>
    &copy; 2024 IsepChat
</footer>
</body>
</html>
