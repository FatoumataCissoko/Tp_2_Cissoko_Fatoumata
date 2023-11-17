<?php
// Fonction pour insérer une adresse dans la base de données

function insertAdresse($data, $i)
{
    // Utilisation de la connexion à la base de données définie globalement
    global $conn;
    // Requête SQL pour l'insertion d'une adresse
    $query = "INSERT INTO address VALUES (NULL,?,?,?,?,?)";
    // Préparation de la requête SQL
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Liaison des paramètres avec les valeurs
        mysqli_stmt_bind_param(
            $stmt,
            "sisss",
            $data['street' . $i],
            $data['street_nb' . $i],
            $data['type' . $i],
            $data['city' . $i],
            $data['zipcode' . $i]
        );
        // Exécution de la requête préparée
        $result = mysqli_stmt_execute($stmt);
    }
}
