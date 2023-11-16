<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../page/style1.css">
  <title>Formulaire d'affichage</title>

</head>

<body>

  <?php
   // Démarrage de la session
  session_start();
   // Enregistrement du nombre d'adresses dans la session
  $_SESSION["nombre"] = $_POST["nombre_Adresse"];
  for ($i = 0; $i <  $_POST["nombre_Adresse"]; $i++) {
    $_SESSION["street" . $i] = $_POST["street" . $i];
    $_SESSION["street_nb" . $i] = $_POST["street_nb" . $i];
    $_SESSION["type" . $i] = $_POST["type_" . $i];
    $_SESSION["city" . $i] = $_POST["city_" . $i];
    $_SESSION["zipcode" . $i] = $_POST["zipcode" . $i];
  }
// Enregistrement des données de chaques champs adresses dans la session
  for ($i = 0; $i < $_POST["nombre_Adresse"]; $i++) { ?>
  <!---Affichage des données dans un formulaire !-->
    <h2><?php echo "Adresse" . $i + 1 ?></h2>
    <form action="../resultat/traitement.php" method="post">
      <input hidden type="text" name="nbr" value="<?php echo $_POST['nombre_Adresse'] ?>">
      <div> <label for="nombre_Adresse">Street: </label>
        <input type="text" name="<?php echo "street" . $i ?>" value="<?php echo $_POST["street" . $i] ?>">
      </div>
      <div><label for="nombre_Adresse">Street_nb: </label>
        <input type="number" name="<?php echo "street_nb" . $i ?>" value="<?php echo $_POST["street_nb" . $i] ?>">
      </div>
      <div><label for="nombre_Adresse">Type: </label>
        <input type="text" name="<?php echo "type_" . $i ?>" value="<?php echo $_POST["type_" . $i] ?>">
      </div>
      <div><label for="nombre_Adresse">City: </label>
        <input type="text" name="<?php echo "city_" . $i ?>" value="<?php echo $_POST["city_" . $i] ?>">
      </div>
      <div><label for="nombre_Adresse">Zipcode: </label>
        <input type="text" name="<?php echo "zipcode" . $i ?>" value="<?php echo $_POST["zipcode" . $i] ?>">
      </div>
    <?php } ?><br>
    <!-----button pour modifier le formulaire !--->
    <button id="btn_modify" formaction="formulaires1.php">Modifier</button>
    <!-----button pour la soumission du formulaire dans la BD !--->
    <button type="submit">Soumettre</button>

    </form>
</body>

</html>