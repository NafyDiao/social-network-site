<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présentation de l'Application</title>
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

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            font-size: 18px;
            line-height: 1.6;
        }

        a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        a:hover {
            color: #2980b9;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .image-description {
            font-style: italic;
            margin-bottom: 20px;
            font-size: 16px;
            color: #777;
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
        <h1 style="font-size: 36px; margin-bottom: 10px;">Bienvenue sur l'Application</h1>
        <p style="font-size: 18px;">IsepChat</p>
    </header>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="description.php">Description</a>
        <a href="membre.php">Membres</a>
        <a href="publication.php">Publication</a>
        <a href="logout.php">Déconnexion</a>
        
    </nav>

    <main>
       <video width="700" height="500" controls>
            <source src="images/7189835-uhd_2160_3840_25fps.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la lecture de vidéos.
       </video>


        <img src="images/amis-vue-cote-smartphone_23-2149452645.avif" alt="Image de présentation 1" />
        <p class="image-description">L'unité et la passion de chaque joueur sont les piliers d'une équipe.</p>

        <img src="images/femmes-s-amusant-au-festival-gastronomie_23-2149500474.jpg" alt="Image de présentation 2" />
        <p class="image-description">La détermination à atteindre de nouveaux sommets guide chaque moment sur le terrain.</p>

        <img src="images/portrait-jeune-fille-masque-facial_23-2150163937.jpg" alt="Image de présentation 3" />
        <p class="image-description">Chaque joueur apporte une histoire unique à l'équipe, créant une fraternité inébranlable.</p>

        <p style="font-size: 18px;">Connectez-vous dès maintenant pour profiter de toutes les fonctionnalités de l'application et restez informé sur les dernières actualités de votre équipe nationale.</p>
    </main>
    <footer>
        &copy; 2024 IsepChat
    </footer>
</body>
</html>
