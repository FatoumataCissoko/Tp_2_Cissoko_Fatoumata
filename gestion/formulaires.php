<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Récupérer le nombre d'adresse et s'assurer que sa existe dans les données postées:

    $nombre_Adresse = isset($_POST["nombre_Adresse"]) ? intval($_POST["nombre_Adresse"]) : 0;
   
    // Vérifier que le nombre est positif:
    if ($nombre_Adresse <= 0) {
        echo "<p>Le nombre d'adresses doit être positif SVP.</p>";
    } else {
        
    echo "<div class='container'>";
    echo "<h2>Remplissez les adresses</h2>";
    echo "<form action='result.php' method='post'>";
   
    //La saisie des adresses par l'utisteur:
    
    for ($i = 1; $i <= $nombre_Adresse; $i++) {
        echo "<div class='address-form'>";
        echo "<h3> Adresse $i</h3>";
        echo "<label for='street_$i'>Street:</label>";
        echo "<input type='text' name='street_$i' maxlength='50' required>";
    }
}
     
}
?>
