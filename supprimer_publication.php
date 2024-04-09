<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Publication</title>
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

        p {
            margin-bottom: 20px;
        }

        form {
            display: inline-block;
        }

        .delete-button {
            padding: 10px 20px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }

        .cancel-button {
            padding: 10px 20px;
            background-color: #ccc;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-left: 20px;
        }

        .cancel-button:hover {
            background-color: #999;
        }
    </style>
</head>
<body>
    <header>
        <h1>Confirmation de Suppression</h1>
    </header>
    <div class="container">
        <?php
        // Vérifier si un identifiant de publication à supprimer est passé en paramètre
        if(isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
            // Récupérer l'identifiant de la publication à supprimer
            $delete_id = $_POST['delete_id'];
            echo "<p>Êtes-vous sûr de vouloir supprimer cette publication ?</p>";
            // Afficher le formulaire de confirmation de suppression
            echo "<form method='post' action='supprimer_publication.php'>";
            echo "<input type='hidden' name='confirm_delete' value='$delete_id'>";
            echo "<input type='submit' class='delete-button' value='Confirmer'>";
            echo "<a href='publication.php' class='cancel-button'>Annuler</a>";
            echo "</form>";
        } else {
            // Rediriger vers la page de publication si aucun identifiant de publication n'est fourni
            header("Location: publication.php");
            exit;
        }
        ?>
    </div>
</body>
</html>
