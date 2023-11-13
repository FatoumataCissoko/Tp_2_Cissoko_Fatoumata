<a href="../gestion/index.php">Accueil</a><br

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
    if (isset($_POST["street_$i"])) {
        $street = $_POST["street_$i"];
        $street_nb = $_POST["street_nb_$i"];
        $type = $_POST["type_$i"];
        $city = $_POST["city_$i"];
        $zipcode = $_POST["zipcode_$i"];

        if (!$stmt->execute()) {
            die("Erreur d'exécution de la requête: " . $stmt->error);
        }
    }
   
}

     // Fermeture de la requête statement
     $stmt->close();

    // Pour fermer ma connexions
    mysqli_close($connexion);
?>