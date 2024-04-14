<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Publication</title>
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
            color: white;
            text-align: center;
            padding: 10px;
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
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #9c9c9c;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"], a.annuler-button {
            display: inline-block;
            padding: 10px;
            background-color: #9c9c9c;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover, a.annuler-button:hover {
            background-color: #2980b9;
        }

        a {
            color: #9c9c9c;
            text-decoration: none;
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
    <h1>IsepChat</h1>
</header>
<nav>
    <a href="accueil.php">Accueil</a>
    <a href="description.php">Description</a>
    <a href="membre.php">Membres</a>
    <a href="publication.php">Publications</a>
    <a href="logout.php">Déconnexion</a>
</nav>

<h1>Ajouter Publication</h1>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $description = $_POST["description"];

    // Vérifier si un fichier a été téléchargé
    if ($_FILES["image"]["error"] == 0) {
        // Récupérer le nom du fichier téléchargé
        $image_name = $_FILES["image"]["name"];

        // Déplacer le fichier téléchargé vers le répertoire uploads
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($image_name);

        // Vérifier si le fichier a été déplacé avec succès
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Le fichier a été téléchargé avec succès
            // Connexion à la base de données 
            $con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

            // Préparation de la requête avec des paramètres liés
                $req1 = "INSERT INTO publication (titre, image, description) VALUES (?, ?, ?)";

                // Préparation de la déclaration
                $stmt = mysqli_prepare($con, $req1);

                // Liaison des valeurs aux paramètres
                mysqli_stmt_bind_param($stmt, 'sss', $titre, $image_name, $description);

                // Exécution de la déclaration
                $result = mysqli_stmt_execute($stmt);

                // Vérification du résultat
                if ($result) {
                    echo "<p class='success'>La publication a été ajoutée avec succès.</p>";
                    // Redirection vers une autre page si nécessaire
                    header("Location: publication.php");
                    exit();
                } else {
                    echo "<p class='error'>Erreur lors de l'ajout de la publication : " . mysqli_error($con) . "</p>";
                }

                // Fermeture de la déclaration
                mysqli_stmt_close($stmt);

            if ($result) {
                echo "<p class='success'>La publication a été ajoutée avec succès.</p>";
                // Rediriger vers une autre page si nécessaire
                header("Location: publication.php");
                exit();
            } else {
                echo "<p class='error'>Erreur lors de l'ajout de la publication : " . mysqli_error($con) . "</p>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($con);
        } else {
            echo "<p class='error'>Erreur lors du déplacement de l'image téléchargée.</p>";
        }
    } else {
        echo "<p class='error'>Erreur lors du téléchargement de l'image : " . $_FILES["image"]["error"] . "</p>";
    }
}
?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre">
        <label for="description">Description :</label>
        <textarea id="description" name="description"></textarea>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image">
        <input type="submit" value="Ajouter">
        <a class="annuler-button" href="publication.php">Annuler</a>
    </form>

    <a href="publication.php">Voir les publications</a>
    <footer>
        &copy; 2024 IsepChat
    </footer>
</body>
</html>
