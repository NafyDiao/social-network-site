<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche</title>
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
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .post {
            margin-bottom: 20px;
            padding: 20px;
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

        .post h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .post p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .no-result {
            text-align: center;
            font-size: 18px;
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
        <h1>Résultats de la Recherche</h1>
    </header>
    <div class="container">
    <?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

// Vérifier si le paramètre de recherche est présent dans l'URL
if(isset($_GET['q']) && !empty($_GET['q'])) {
    // Nettoyer et sécuriser la valeur de recherche
    $search_query = mysqli_real_escape_string($con, $_GET['q']);

    // Requête SQL pour rechercher les publications contenant le terme de recherche dans le titre ou la description
    $req = "SELECT * FROM publication WHERE titre LIKE '%$search_query%' OR description LIKE '%$search_query%'";
    $result = mysqli_query($con, $req);

    // Vérifier s'il y a des résultats
    if(mysqli_num_rows($result) > 0) {
        // Afficher les résultats de la recherche
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='post'>";
            echo "<h2>{$row['titre']}</h2>";
            echo "<img src='/uploads/{$row['image']}' alt='Image de la Publication'>";
            echo "<p>{$row['description']}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun résultat trouvé pour votre recherche.</p>";
    }
} else {
    // Rediriger vers la page de publication si aucun terme de recherche n'est fourni
    header("Location: publication.php");
    exit;
}
?>
    </div>
    <footer>
        &copy; 2024 IsepChat
    </footer>
</body>
</html>

