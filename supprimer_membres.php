<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer membre</title>
    <style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
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
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #9c9c9c;
    color: #fff;
    cursor: pointer;
}

a.add-button {
    display: inline-block;
    padding: 10px;
    background-color: #333;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
}

a.add-button:hover {
    background-color: #2980b9;
}

p {
    color: #333;
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

    // Sélection des informations du membre à supprimer
    $query = "SELECT * FROM membre WHERE id = $id_membre";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $membre = mysqli_fetch_assoc($result);

        if (isset($_POST['confirmer'])) {
            // Suppression du membre
            $delete_query = "DELETE FROM membre WHERE id=$id_membre";
            $delete_result = mysqli_query($con, $delete_query);

            if ($delete_result) {
                // Succès de la suppression, redirigez vers la liste des membres
                header("Location: membre.php");
                exit(); // Assurez-vous de terminer le script après la redirection
            } else {
                echo "<p class='error'>Erreur lors de la suppression du membre : " . mysqli_error($con) . "</p>";
            }
        }
?>
        <h1>Suppression</h1>

        <p>Voulez-vous vraiment supprimer le membre <?php echo $membre['nom'] . ' ' . $membre['prenom']; ?> ?</p>
        
        <form action="supprimer_membres.php?id=<?php echo $id_membre; ?>" method="post">
            <input type="submit" name="confirmer" value="Confirmer">
            <a href="membre.php"><input type="button" value="Annuler"></a>

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

