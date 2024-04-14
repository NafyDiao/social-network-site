<?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "projet") or die("Erreur connexion " . mysqli_connect_errno($con));

// Vérification si le formulaire a été soumis
if(isset($_GET['q'])) {
    // Récupération du terme de recherche
    $search_term = $_GET['q'];

    // Requête SQL pour rechercher les publications
    $query = "SELECT * FROM publication WHERE titre LIKE '%$search_term%' OR description LIKE '%$search_term%'";
    $result = mysqli_query($con, $query);

    // Vérification s'il y a des résultats
    if(mysqli_num_rows($result) > 0) {
        echo "<h1>Résultats de la recherche pour '{$search_term}'</h1>";
        // Affichage des résultats
        while($publication = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<h2>{$publication['titre']}</h2>";
            echo "<p>{$publication['description']}</p>";
            // Afficher l'image si elle existe
            if(!empty($publication['image'])) {
                echo "<img src='uploads/{$publication['image']}' alt='Image de la publication'>";
            }
            echo "</div>";
        }
    } else {
        echo "<h1>Aucun résultat trouvé pour '{$search_term}'</h1>";
    }
} else {
    echo "<h1>Aucun terme de recherche spécifié</h1>";
}

// Fermeture de la connexion à la base de données
mysqli_close($con);
?>
