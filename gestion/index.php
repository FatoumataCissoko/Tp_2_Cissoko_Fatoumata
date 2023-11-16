<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../page/style.css">
    <title>MON TP 2</title>
</head>

<body>
    <div class="container">
        <h1>Combien d'adresse voulez_vous saisir: </h1>
        <label id="msg_succes" for=""><?php if (isset($_SESSION["msg"])) echo ($_SESSION["msg"]) ?></label>
        <form action="formulaires1.php" method="post">
            <input id="btn_adress" type="number" name="nombre_Adresse" placeholder="Veuillez rentrer le nombre d'adresses" required>
            <input id="btn_create" type="submit" values="Submit">
        </form>
    </div>
</body>

</html>
<?php
session_destroy();
?>