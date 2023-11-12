<a href="../index.php">Retour a l'accueil</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_Adresse = isset($_POST["nombre_Adresse"]) ? intval($_POST["nombre_Adresse"]) : 0;

    if ($nombre_Adresse <= 0) {
        echo "<p>Le nombre d'adresses doit être positif SVP.</p>";
    } else {
        echo "<div class='container'>";
        echo "<h2>Remplissez les adresses</h2>";
        echo "<form action='../resultat/result.php' method='post'>";

        for ($i = 1; $i <= $nombre_Adresse; $i++) {
            echo "<div class='address-form'>";
            echo "<h2> Adresse $i</h2>";
            echo "<label for='street_$i'>Street:</label>";
            echo "<input type='text' name='street_$i' maxlength='60' required>";
            echo "<label for='street_nb_$i'>Street_nb:</label>";
            echo "<input type='number' name='street_nb_$i' required>";
            echo "<label for='type_$i'>Type:</label>";
            echo "<select name='type_$i' required>";
            echo "<option value='Livraison'>Livraison</option>";
            echo "<option value='Facturation'>Facturation</option>";
            echo "<option value='Lieu'>Lieu</option>";
            echo "<option value='Autres'>Autres</option>";
            echo "</select>";
            echo "<label for='city_$i'>City:</label>";
            echo "<select name='city_$i' required>";
            echo "<option value='Montreal'>Montreal</option>";
            echo "<option value='Laval'>Laval</option>";
            echo "<option value='Toronto'>Toronto</option>";
            echo "<option value='Quebec'>Quebec</option>";
            echo "</select>";
            echo "<label for='zipcode_$i'>Zip Code:</label>";
            echo "<input type='text' name='zipcode_$i' pattern='\w{6}' title='Six carateres required' required>";
            echo "<br>";
            echo "</div>";
        }

        echo "<input type='hidden' name='nombre_Adresse' value='$nombre_Adresse'>";
        echo "<br>";
        echo "<input type='submit' name='submit' value='Soumettre'>";
        echo "</form>";
        echo "<br>";
        echo "<br>";
        echo "</div>";
    }
}

$server_name = 'localhost';
$user_name = "root";
$pwd = "";
$BaseDonnees_name = "ecom1_tp2";

$connexion = mysqli_connect($server_name, $user_name, $pwd, $BaseDonnees_name);

if (mysqli_connect_error()) {
    die("Erreur de connexion " . mysqli_connect_error());
}

mysqli_select_db($connexion, $BaseDonnees_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare($connexion, "INSERT INTO address (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erreur de préparation de la requête: " . mysqli_error($connexion));
    }

    $street = "";
    $street_nb = 0;
    $type = "";
    $city = "";
    $zipcode = "";

    mysqli_stmt_bind_param($stmt, "sisss", $street, $street_nb, $type, $city, $zipcode);

    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        if (isset($POST["street$i"])) {
            $street = $POST["street$i"];
            $street_nb = $POST["street_nb$i"];
            $type = $POST["type$i"];
            $city = $POST["city$i"];
            $zipcode = $POST["zipcode$i"];

            if (!mysqli_stmt_execute($stmt)) {
                die("Erreur d'exécution de la requête: " . mysqli_stmt_error($stmt));
            }
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='container'>";
    echo "<h2>Adresse soumise</h2>";

    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        echo "<div class='adresse-result'>";
        echo "<h2>Adresse $i</h2>";
        if (isset($POST["street$i"])) {
            echo "<p><strong> Street: </strong> " . htmlspecialchars($POST["street$i"]) . "</p>";
            echo "<p><strong> Street_nb: </strong> " . htmlspecialchars($POST["street_nb$i"]) . "</p>";
            echo "<p><strong> Type: </strong> " . htmlspecialchars($POST["type$i"]) . "</p>";
            echo "<p><strong> City: </strong> " . htmlspecialchars($POST["city$i"]) . "</p>";
            echo "<p><strong> Zip Code: </strong> " . htmlspecialchars($POST["zipcode$i"]) . "</p>";
            echo "<br>";
        }
        echo "</div>";
    }

    echo "</div>";
}
?>