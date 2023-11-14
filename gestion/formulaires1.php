<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../page/style1.css">
    <title>forms1</title>
</head>
<body>
    
</body>
</html>
<a href="index.php">Retour a l'accueil</a>

<?php
// Verification de la requête est de type POST:
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer le nombre d'adresses et s'assurer qu'il est défini dans les données POST:
    $nombre_Adresse = isset($_POST["nombre_Adresse"]) ? intval($_POST["nombre_Adresse"]) : 0;

    // Vérifier que le nombre saisie par l'utilisteur est positif:
    if ($nombre_Adresse <= 0) {
        echo "<p>Le nombre d'adresses doit être positif SVP.</p>";
    } else {
        // Afficher le formulaire d'adresse:
        echo "<div class='container'>";
        echo "<h2>Remplissez les adresses</h2>";
        echo "<form action='../resultat/result.php' method='post'>";

        // Boucle pour générer les champs d'adresse en fonction du nombre spécifique:
        for ($i = 1; $i <= $nombre_Adresse; $i++) {
            echo "<div class='address-form'>";
            echo "<h2> Adresse $i</h2>";
                //STREET:
            echo "<label for='street_$i'>Street:</label>";
            echo "<input type='text' name='street_$i' maxlength='60' required>";
                //STREET_NB:
            echo "<label for='street_nb_$i'>Street_nb:</label>";
            echo "<input type='number' name='street_nb_$i' required>";
                //TYPE:
            echo "<label for='type_$i'>Type:</label>";
            echo "<select name='type_$i' required>";
            echo "<option value='Livraison'>Livraison</option>";
            echo "<option value='Facturation'>Facturation</option>";
            echo "<option value='Lieu'>Lieu</option>";
            echo "<option value='Autres'>Autres</option>";
            echo "</select>";
                //CITY:
            echo "<label for='city_$i'>City:</label>";
            echo "<select name='city_$i' required>";
            echo "<option value='Montreal'>Montreal</option>";
            echo "<option value='Laval'>Laval</option>";
            echo "<option value='Toronto'>Toronto</option>";
            echo "<option value='Quebec'>Quebec</option>";
            echo "</select>";
                //ZIP CODE:
            echo "<label for='zipcode_$i'>Zip Code:</label>";
            echo "<input type='text' name='zipcode_$i' pattern='\w{6}' title='Six caracteres required' required>";
            echo "<br>";
            echo "</div>";
        }

        // Ajouter un champ cacher,pour stocker le nombre d'adresses:
        echo "<input type='hidden' name='nombre_Adresse' value='$nombre_Adresse'>";
        echo "<br>";
        // Bouton de soumission du formulaire:
        echo "<input type='submit' name='submit' value='Soumettre'>";
        echo "</form>";
        echo "<br>";
        echo "<br>";
        echo "</div>";
    }
}
?>