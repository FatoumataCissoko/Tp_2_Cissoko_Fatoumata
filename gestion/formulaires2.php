<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../page/style1.css">
    <title>forms2</title>
</head>
<body>
    
</body>
</html>
<a href="index.php">Retour a l'accueil</a>
<?php

require_once("formulaires1.php");

// Connexion à la BD:
$server_name = 'localhost';
$user_name = "root";
$pwd = "";
$BaseDonnees_name = "ecom1_tp2";

// Connexion à la BD MySQL:
$connexion = mysqli_connect($server_name, $user_name, $pwd, $BaseDonnees_name);

// Vérifier si la connexion a échoué:
if (mysqli_connect_error()) {
    die("Erreur de connexion " . mysqli_connect_error());
}

// Sélectionner la BD:
mysqli_select_db($connexion, $BaseDonnees_name);

// Vérifier si la requête est de type POST:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Préparer la requête d'insertion:
    $stmt = mysqli_prepare($connexion, "INSERT INTO address (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

    // Vérifier si la préparation de la requête a échoué:
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . mysqli_error($connexion));
    }

    // Variables pour les données à insérer:
    $street = "";
    $street_nb = 0;
    $type = "";
    $city = "";
    $zipcode = "";

    // Lier les paramètres de la requête:
    mysqli_stmt_bind_param($stmt, "sisss", $street, $street_nb, $type, $city, $zipcode);

    // Boucle pour récupérer et insérer les données pour chaque adresse:
    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        // Vérifier si les données de l'adresse actuelle existent dans la requête POST:
        if (isset($_POST["street_$i"])) {
            $street = $_POST["street_$i"];
            $street_nb = $_POST["street_nb_$i"];
            $type = $_POST["type_$i"];
            $city = $_POST["city_$i"];
            $zipcode = $_POST["zipcode_$i"];

            // Exécuter la requête d'insertion:
            if (!mysqli_stmt_execute($stmt)) {
                die("Erreur d'exécution de la requête: " . mysqli_stmt_error($stmt));
            }
        }
    }

    // Fermeture du statement:
    mysqli_stmt_close($stmt);
}

    // Fermeture de la connexion à la BD:
    mysqli_close($connexion);

    // Affichage des adresses soumises pour la validation:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='container'>";
    echo "<h2>Adresse soumise</h2>";

    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        echo "<div class='adresse-result'>";
        echo "<h2>Adresse $i</h2>";
        // Vérifier si les données de l'adresse actuelle existent dans la requête POST:
        if (isset($_POST["street_$i"])) {
            echo "<p><strong> Street: </strong> " . htmlspecialchars($_POST["street_$i"]) . "</p>";
            echo "<p><strong> Street_nb: </strong> " . htmlspecialchars($_POST["street_nb_$i"]) . "</p>";
            echo "<p><strong> Type: </strong> " . htmlspecialchars($_POST["type_$i"]) . "</p>";
            echo "<p><strong> City: </strong> " . htmlspecialchars($_POST["city_$i"]) . "</p>";
            echo "<p><strong> Zip Code: </strong> " . htmlspecialchars($_POST["zipcode_$i"]) . "</p>";
            echo "<br>";
        }
        echo "</div>";
    }

    echo "</div>";
}
?>