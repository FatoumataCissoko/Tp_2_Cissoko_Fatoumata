<a href="../gestion/index.php">Accueil</a>

<?php

// Informations de connexion à la base de données
$server_name = 'localhost';
$user_name = "root";
$pwd = "";
$BaseDonnees_name = "ecom1_tp2";

// Connexion à la base de données
$connexion = mysqli_connect($server_name, $user_name, $pwd, $BaseDonnees_name);

// Vérifier si la connexion a échoué
if (mysqli_connect_error()) {
    die("Erreur de connexion " . mysqli_connect_error());
}

// Sélectionner la base de données
mysqli_select_db($connexion, $BaseDonnees_name);

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Préparer la requête d'insertion
    $stmt = mysqli_prepare($connexion, "INSERT INTO address (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

    // Vérifier si la préparation de la requête a échoué
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . mysqli_error($connexion));
    }

    // Variables pour les données à insérer
    $street = "";
    $street_nb = 0;
    $type = "";
    $city = "";
    $zipcode = "";

    // Lier les paramètres de la requête
    
    mysqli_stmt_bind_param($stmt, "sisss", $street, $street_nb, $type, $city, $zipcode);

    // Boucle pour récupérer et insérer les données pour chaque adresse
    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        // Vérifier si les données de l'adresse actuelle existent dans la requête POST
        if (isset($_POST["street$i"])) {
            $street = $_POST["street$i"];
            $street_nb = $_POST["street_nb$i"];
            $type = $_POST["type$i"];
            $city = $_POST["city$i"];
            $zipcode = $_POST["zipcode$i"];

            // Exécuter la requête d'insertion
            if (!mysqli_stmt_execute($stmt)) {
                die("Erreur d'exécution de la requête: " . mysqli_stmt_error($stmt));
            }
        }
    }

    // Fermeture du statement
    mysqli_stmt_close($stmt);
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>