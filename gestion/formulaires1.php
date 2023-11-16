<a href="index.php">Retour a l'accueil</a>
<?php
session_start();


if (isset($_SESSION["nombre"])) {
    $nbr = $_SESSION["nombre"];
} else {
    $nbr = $_POST["nombre_Adresse"];
}

for ($i = 0; $i < $nbr; $i++) { ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page/style1.css">
        <title>Formulaire saisie</title>

    </head>

    <body>
        <div class="container">
            <h2><?php echo "Adresse" . $i + 1 ?></h2>
            <form id="formulaires1" action="formulaires2.php" method="post">
                <input hidden type="number" name="nombre_Adresse" value="<?php echo $nbr ?>">
                <div class="div_formulaires1"> <label class="label0_formulaires1" for="nombre_Adresse">Street: </label>
                    <input class="input0_formulaires1" type="text" name="<?php echo "street" . $i ?>" value="<?php if (isset($_SESSION["street" . $i])) echo ($_SESSION["street" . $i]) ?>" required>
                </div>
                <div class="div_formulaires1"><label class="label1_formulaires1" for="nombre_Adresse">Street_nb: </label>
                    <input type="number" class="input1_formulaires1" name="<?php echo "street_nb" . $i ?>" value="<?php if (isset($_SESSION["street_nb" . $i])) echo ($_SESSION["street_nb" . $i]) ?>" required>
                </div>

                <div class="div_formulaires1"> <label class="label2_formulaires1" for=""> Type adresse: </label>
                    <select class="input2_formulaires1" name="<?php echo "type.$i" ?>" required>
                        <option value="<?php if (isset($_SESSION["type" . $i])) echo ($_SESSION["type" . $i]) ?>"><?php if (isset($_SESSION["type" . $i])) echo ($_SESSION["type" . $i]) ?> </option>
                        <option value="Livraison">Lieu</option>
                        <option value="Livraison">Livraison</option>
                        <option value="Facture">Facture</option>
                        <option value="Autre">Autres</option>
                    </select>
                </div>
                <div class="div_formulaires1"> <label class="label3_formulaires1" for=""> City: </label>
                    <select class="input3_formulaires1" name="<?php echo "city.$i" ?>" required>
                        <option value="<?php if (isset($_SESSION["city" . $i])) echo ($_SESSION["city" . $i]) ?>"><?php if (isset($_SESSION["city" . $i])) echo ($_SESSION["city" . $i]) ?> </option>
                        <option value="Toronto">Toronto</option>
                        <option value="Montréal">Montréal</option>
                        <option value="Québec">Quebec</option>
                        <option value="Ottawa">Ottawa</option>
                    </select>
                </div>
                <div class="div_formulaires1"><label class="label4_formulaires1" for="nombre_Adresse">Zipcode: </label>
                    <input type="text" class="input4_formulaires1" name="<?php echo "zipcode" . $i ?>" value="<?php if (isset($_SESSION["zipcode" . $i])) echo ($_SESSION["zipcode" . $i]) ?>" pattern='\w{6}' title='Six caracteres required' required>
                </div>
            <?php } ?>
            <button id="btn_submit" type="submit">Envoyer</button>
            </form>
        </div>
    </body>

    </html>