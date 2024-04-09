<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
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
            background-color: #0000;
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

        input[type="submit"] {
            background-color: #9c9c9c;
            color: #black;
            cursor: pointer;
        }

        p {
            color: #9c9c9c;
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

<?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

if (isset($_GET['id'])) {
    $id_membre = $_GET['id'];

    // Récupération des données du membre depuis la base de données
    $query = "SELECT * FROM membre WHERE id = $id_membre";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $membre = mysqli_fetch_assoc($result);

        if (isset($_POST['modifier'])) {
            // Récupération des valeurs du formulaire
            $nouveau_nom = $_POST['nouveau_nom'];
            $nouveau_prenom = $_POST['nouveau_prenom'];
            $nouvel_sexe = $_POST['nouvel_sexe'];

            // Mise à jour des informations du membre
            $update_query = "UPDATE membre SET nom='$nouveau_nom', prenom='$nouveau_prenom', sexe='$nouvel_sexe' WHERE id=$id_membre";
            $update_result = mysqli_query($con, $update_query);

            if ($update_result) {
                echo "<p class='success'>Les informations du membres ont été mises à jour avec succès.</p>";
                header("Location: membre.php");
            } else {
                echo "<p class='error'>Erreur lors de la mise à jour des informations du membre : " . mysqli_error($con) . "</p>";
            }
        }
?>

        <h1>Modification</h1>

        <form action="modifier_membres.php?id=<?php echo $id_membre; ?>" method="post">
            <label for="nouveau_nom">Nom :</label>
            <input type="text" name="nouveau_nom" value="<?php echo $membre['nom']; ?>">
            
            <label for="nouveau_prenom">Prénom :</label>
            <input type="text" name="nouveau_prenom" value="<?php echo $membre['prenom']; ?>">
            
            <label for="nouvel_sexe">Sexe :</label>
            <input type="text" name="nouvel_sexe" value="<?php echo $membre['sexe']; ?>">
            
            <input type="submit" name="modifier" value="Modifier">
        </form>

<?php
    } else {
        echo "<p class='error'>membre non trouvé.</p>";
    }
} else {
    echo "<p class='error'>ID du membre non spécifié.</p>";
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>

<footer>
        &copy; 2024 IsepChat
    </footer>

</body>
</html>
