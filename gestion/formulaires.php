<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Récupérer le nombre d'adresse et s'assurer que sa existe dans les données POST:

    $nombre_Adresse = isset($_POST["nombre_Adresse"]) ? intval($_POST["nombre_Adresse"]) : 0;
   
    // Vérifier que le nombre est positif:
    if ($nombre_Adresse <= 0) {
        echo "<p>Le nombre d'adresses doit être positif SVP.</p>";
    } else {
        
    echo "<div class='container'>";
    echo "<h2>Remplissez les adresses</h2>";
    echo "<form action='result.php' method='post'>";
   
    //La saisie des adresses par l'utisteur:
            //STREET
    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        echo "<div class='address-form'>";
        echo "<h3> Adresse $i</h3>";
        echo "<label for='street_$i'>Street:</label>";
        echo "<input type='text' name='street_$i' maxlength='60' required>";
                //STREET_NB
        echo "<label for='street_nb_$i'>Street_nb:</label>";
        echo "<input type='number' name='street_nb_$i' required>";
                //TYPE
        echo "<label for='type_$i'>Type:</label>";
        echo "<input type='text' name='type_$i' maxlength='30' required>";
                //HINT
        echo "<label for='hint_$i'>Hint:</label>";
        echo "<select name='hint_$i' required>";
                //LIVRAISON,FACTURATION et LIEU
        echo "<option value='livraison'>Livraison</option>";
        echo "<option value='facturation'>Facturation</option>";
        echo "<option value='lieu'>Lieu</option>";
        echo "</select>";
            //CITY
        echo "<label for='city_$i'>City:</label>";
        echo "<select name='city_$i' required>";
        echo "<option value='Montreal'>Montreal</option>";
        echo "<option value='Laval'>Laval</option>";
        echo "<option value='Toronto'>Toronto</option>";
        echo "<option value='Quebec'>Quebec</option>";
        echo "</select>";
                //ZIPCODE
        echo "<label for='zipcode_$i'>Zip Code:</label>";
        echo "<input type='text' name='zipcode_$i' pattern='\d{8}' title='Six digits required' required>";
        
        echo "<br>";
        echo "</div>";


    }
echo "<input type='hidden' name='nombre_addresse' value='$nombre_Adresse'>";
echo "<br>";
echo "<input type='submit' value='Soumettre'>";
    
   
echo "</form>";
echo "<br>";
echo "<br>";
echo "</div>";

}
     
}
?>
