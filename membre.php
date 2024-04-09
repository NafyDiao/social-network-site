<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membres</title>
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
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #black;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #9c9c9c;
            color: #333;
        }

        a.button {
            display: inline-block;
            padding: 10px;
            background-color: #9c9c9c;
            color: #black;
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
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
        <h1 style="font-size: 36px; margin-bottom: 10px;"></h1>
        <p style="font-size: 18px;"></p>
    </header>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="description.php">Présentation</a>
        <a href="membre.php">Membres</a>
        <a href="publication.php">Publication</a>
        <a href="logout.php">Déconnexion</a>
    </nav>



    <?php
    
    //  votre connexion à la base de donnée
    $con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

    // Récupérez la liste des membres depuis la base de donnée
    $query = "SELECT * FROM membre";
    $result = mysqli_query($con, $query);
    ?>

    <h1>Membres</h1>

    <?php
    // Vérifiez s'il y a des membres à afficher
    if ($result && mysqli_num_rows($result) > 0) {
    ?>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Actions</th>
            </tr>

            <?php
            // j'ffiche chaque membre dans une ligne du tableau
            while ($membre = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$membre['nom']}</td>";
                echo "<td>{$membre['prenom']}</td>";
                echo "<td>{$membre['sexe']}</td>";

                // Ajout des actions avec des liens
                echo "<td>";
                echo "<a href='modifier_membres.php?id={$membre['id']}'>Modifier</a> | ";
                echo "<a href='supprimer_membres.php?id={$membre['id']}'>Supprimer</a>";
                echo "</td>";

                echo "</tr>";

            }
            ?>
        </table>

        <!-- Ajoutez le bouton "Ajouter membre" -->
        <a href='ajouter_membres.php' class="button">Ajouter membre</a>

    <?php
    } else {
        echo "<p>Aucun membre trouvé.</p>";
    }

    //  fermer la connexion à la base de données
    mysqli_close($con);
    
    ?>
    <footer>
        &copy; 2024 IsepChat
    </footer>
    

</body>
</html>
