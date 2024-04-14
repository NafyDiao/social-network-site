<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Publication</title>
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
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type='text'], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type='submit'] {
            padding: 10px 20px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        input[type='submit']:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Modifier Publication</h1>
    </header>
    <div class="container">
    <?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

// Vérifier si un identifiant de publication à modifier est passé en paramètre
if(isset($_POST['modifier_id']) && !empty($_POST['modifier_id'])) {
    // Récupérer l'identifiant de la publication à modifier
    $modifier_id = $_POST['modifier_id'];

    // Requête SQL pour récupérer les données de la publication à modifier
    $req = "SELECT * FROM publication WHERE id = $modifier_id";
    $result = mysqli_query($con, $req);

    // Vérifier si la requête a réussi
    if($result) {
        // Vérifier s'il y a des données à afficher
        if(mysqli_num_rows($result) > 0) {
            // Récupérer les données de la publication
            $publication = mysqli_fetch_assoc($result);
            $titre = $publication['titre'];
            $description = $publication['description'];
            
            // Afficher le formulaire de modification avec les champs pré-remplis
            echo "<form method='post' action='modifier_publication.php'>
                <input type='hidden' name='modifier_id' value='$modifier_id'>
                <label for='titre'>Titre:</label><br>
                <input type='text' id='titre' name='titre' value='$titre' placeholder='Entrez le titre'><br>
                <label for='description'>Description:</label><br>
                <textarea id='description' name='description' placeholder='Entrez la description'>$description</textarea><br>
                <input type='submit' value='Modifier'>
            </form>";
        } else {
            echo "Aucune publication trouvée.";
        }
    } else {
        echo "Erreur lors de la récupération des données de publication: " . mysqli_error($con);
    }
} else {
    // Rediriger vers la page de publication si aucun identifiant de publication n'est fourni
    header("Location: publication.php");
    exit;
}
?>

</body>
</html>
