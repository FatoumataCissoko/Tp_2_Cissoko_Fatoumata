<?php
// Affichage des données reçues via la méthode POST
var_dump($_POST);
// Inclusion des fonctions nécessaires
require_once("../functions/functions.php");
require_once("result.php");
// Boucle pour traiter chaque adresse
for ($i = 0; $i < $_POST['nbr']; $i++) {
  // Crée un tableau associatif avec les données de l'adresse actuelle
  $tab["street" . $i] = $_POST["street" . $i];
  $tab["street_nb" . $i] = $_POST["street_nb" . $i];
  $tab["type" . $i] = $_POST["type_" . $i];
  $tab["city" . $i] = $_POST["city_" . $i];
  $tab["zipcode" . $i] = $_POST["zipcode" . $i];

  // Appel a la fonction insertAdresse pour insérer l'adresse dans la base de données

  insertAdresse($tab, $i);
  // Message de succès pour la session
  $msg = "Insérées avec succés";
  session_start();
  // Stocke le message dans la session
  $_SESSION["msg"] = $msg;
  
  // Redirection vers la page d'accueil après le traitement de toutes les adresses
  header("Location: ../gestion/index.php");
}
