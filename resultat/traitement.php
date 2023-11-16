<?php
var_dump($_POST);
require_once ("../functions/functions.php");
require_once("result.php");
for ($i=0; $i < $_POST['nbr']; $i++) { 
 $tab["street".$i]=$_POST["street".$i];
 $tab["street_nb".$i]=$_POST["street_nb".$i];
 $tab["type".$i]=$_POST["type_".$i];
 $tab["city".$i]=$_POST["city_".$i];
 $tab["zipcode".$i]=$_POST["zipcode".$i];
  insertAdresse($tab,$i);
  $msg="Insérées avec succés";
  session_start();
  $_SESSION["msg"]=$msg;
  header("Location: ../gestion/index.php");
}
?>