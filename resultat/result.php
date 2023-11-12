<a href="formulaires.php">Page dinsertion</a><br>
<a href="index.php">Accueil</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Connexion a la BD :
    $server_name = 'localhost';
    $user_name = "root";
    $pwd="";
    $BaseDonnees_name = "ecom1_tp2";
    
    $connexion =  mysqli_connect($server_name,$user_name,$pwd,$BaseDonnees_name);

    //Validation de la connexion :

    if ($connexion->connect_error){

        echo("Erreur de connexion " .$connexion->connect_error);
    }

    //Preparation de ma requete SQL d'insertion :

    $stmt = $connexion->prepare("INSERT INTO address (street, street_nb, type, city, zipcode) 
    VALUES (?, ?, ?, ?, ?)");

    // Liaison entre les paramètres :

    $stmt->bind_param("sisss", $street, $street_nb, $type, $city, $zipcode);

}

// Insertion de chaque champs d’adresses :
for ($i = 1; $i <= $_POST["nombre_Adresse"]; $i++) {
        
    $street = $_POST["street_$i"];
    $street_nb = $_POST["street_nb_$i"];
    $type = $_POST["type_$i"];
    $city = $_POST["city_$i"];
    $zipcode = $_POST["zipcode_$i"];
    if (!$stmt->execute()) {
        die("Erreur d'exécution de la requête: " . $stmt->error);
    //$stmt->execute();
    }

}


// Fermeture de la requête
$stmt->close();

// Pour close mes connexions
$connexion->close();

?>
