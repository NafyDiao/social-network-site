<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Membres</title>
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
        <a href="logout.php">Déconnexion</a>
    </nav>

    <h1>Ajouter Membres</h1>

    <?php
    // Vérification du rôle de l'utilisateur
$role = '1';

// Si l'utilisateur est un administrateur, affichez le formulaire d'ajout
if ($role === '1') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
     }
      }

    // Vérifier si le formulaire a été soumis
    if (isset($_POST["ajouter"])) {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $age = $_POST["sexe"];

        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

        // Insertion des données dans la table 'joueur'
        $req1 = "INSERT INTO membre (nom, prenom, sexe) VALUES ('$nom', '$prenom', '$sexe')";
        $result = mysqli_query($con, $req1);

        if ($result) {
            echo "<p class='success'>Le membre a été ajouté avec succès.</p>";
            header("Location: membre.php");
    exit();
        } else {
            echo "<p class='error'>Erreur lors de l'ajout du membre : " . mysqli_error($con) . "</p>";
        }

        // Fermer la connexion à la base de données
        mysqli_close($con);
    }
    ?>

    <form action="ajouter_membres.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="sexe">Sexe:</label>
        <input type="text" id="sexe" name="sexe" required>

        <input type="submit" name="ajouter" value="Ajouter">
        <a class="annuler-button" href="membre.php">Annuler</a>
    </form>

    <a href="membre.php">Voir la liste des membres</a>
    <footer>
        &copy; 2024 IsepChat
    </footer>
</body>
</html>
