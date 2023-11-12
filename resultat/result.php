<a href="index.php">Accueil</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connexion a la BD :
    $server_name = 'localhost';
    $user_name = "root";
    $pwd = "";
    $BaseDonnees_name = "ecom1_tp2";

    $connexion =  mysqli_connect($server_name, $user_name, $pwd, $BaseDonnees_name);

    // Validation de la connexion :
    if (mysqli_connect_error()) {
        echo ("Erreur de connexion " . mysqli_connect_error());
    }

    // Preparation de ma requete SQL d'insertion :
    $stmt = $connexion->prepare("INSERT INTO address (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

    // Liaison entre les paramètres :
    $stmt->bind_param("sisss", $street, $street_nb, $type, $city, $zipcode);
}

// Insertion de chaque champ d’adresses :
for ($i = 1; $i <= $_POST["nombre_Adresse"]; $i++) {
    $street = $POST["street" . $i];
    $street_nb = $POST["street_nb" . $i];
    $type = $POST["type" . $i];
    $city = $POST["city" . $i];
    $zipcode = $POST["zipcode" . $i];

    if (!$stmt->execute()) {
        die("Erreur d'exécution de la requête: " . $stmt->error);
    }
}

// Fermeture de la requête 
$stmt->close();

// Pour fermer mes connexions
$connexion->close();
?>