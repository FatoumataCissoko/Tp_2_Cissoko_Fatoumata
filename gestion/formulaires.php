<a href="index.php">Retour a l'accueil</a>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Recuperer le nombre d'adresse et s'assurer que sa existe dans les donnees POST:

    $nombre_Adresse = isset($_POST["nombre_Adresse"]) ? intval($_POST["nombre_Adresse"]) : 0;
   
    // Verifier que le nombre est positif:
        if ($nombre_Adresse <= 0) {
            echo "<p>Le nombre d'adresses doit être positif SVP.</p>";
        } else {

        echo "<div class='container'>";
        echo "<h2>Remplissez les adresses</h2>";
        echo "<form action='result.php' method='post'>";
        
        //La saisie des adresses par l'utilisateur:
                //STREET:
        for ($i = 1; $i <= $nombre_Adresse; $i++) {
            echo "<div class='address-form'>";
            echo "<h2> Adresse $i</h2>";
            echo "<label for='street_$i'>Street:</label>";
            echo "<input type='text' name='street_$i' maxlength='60' required>";
                    //STREET_NB:
            echo "<label for='street_nb_$i'>Street_nb:</label>";
            echo "<input type='number' name='street_nb_$i' required>";
                    //TYPE:
            echo "<label for='type_$i'>Type:</label>";
            echo "<input type='text' name='type_$i' maxlength='30' required>";
                //CITY:
            echo "<label for='city_$i'>City:</label>";
            echo "<select name='city_$i' required>";
            echo "<option value='Montreal'>Montreal</option>";
            echo "<option value='Laval'>Laval</option>";
            echo "<option value='Toronto'>Toronto</option>";
            echo "<option value='Quebec'>Quebec</option>";
            echo "</select>";
                    //ZIPCODE:
            echo "<label for='zipcode_$i'>Zip Code:</label>";
            echo "<input type='text' name='zipcode_$i' pattern='\w{6}' title='Six carateres required' required>";

            echo "<br>";
            echo "</div>";


        }
    echo "<input type='hidden' name='nombre_Adresse' value='$nombre_Adresse'>";
    echo "<br>";
    echo "<input type='submit' value='Soumettre'>";
    
   
    echo "</form>";
    echo "<br>";
    echo "<br>";
    echo "</div>";

}
     
}

// Connexion à la BD
$server_name = 'localhost';
$user_name = "root";
$pwd = "";
$BaseDonnees_name = "ecom1_tp2";

$connexion = mysqli_connect($server_name, $user_name, $pwd, $BaseDonnees_name);

// Validation de la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion " . $connexion->connect_error);
}

$connexion->select_db($BaseDonnees_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $connexion->prepare("INSERT INTO address (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $connexion->error);
    }

    $stmt->bind_param("sisss", $street, $street_nb, $type, $city, $zipcode);

    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        $street = $_POST["street_$i"];
        $street_nb = $_POST["street_nb_$i"];
        $type = $_POST["type_$i"];
        $city = $_POST["city_$i"];
        $zipcode = $_POST["zipcode_$i"];
        

       
if (!$stmt->execute()) {
            die("Erreur d'exécution de la requête: " . $stmt->error);
        }
    }

    $stmt->close();
}

$connexion->close();






if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Affichage des adresses soumises pour la validation:
    echo "<div class='container'>";
    echo "<h2>Adresse soumise</h2>";
    
        for ($i = 1; $i <= $nombre_Adresse; $i++) {
            echo "<div class='adresse-result'>";
            echo "<h2>Adresse $i</h2>";
            echo "<p><strong> Street: </strong> " . htmlspecialchars($_POST["street_$i"]) . "</p>";
            echo "<p><strong> Street_nb: </strong> " . htmlspecialchars($_POST["street_nb_$i"]) . "</p>";
            echo "<p><strong> Type: </strong> " . htmlspecialchars($_POST["type_$i"]) . "</p>";
            echo "<p><strong> City: </strong> " . htmlspecialchars($_POST["city_$i"]) . "</p>";
            echo "<p><strong> Zip Code: </strong> " . htmlspecialchars($_POST["zipcode_$i"]) . "</p>";
            echo "<br>";

        
            echo "</div>";
        }

    echo "</div>";

}

?>


