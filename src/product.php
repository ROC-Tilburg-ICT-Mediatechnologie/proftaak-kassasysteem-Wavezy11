<?php

namespace Acme;

use Acme\model\ProductModel;

require "../vendor/autoload.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="bestellingdoorvoeren.php" method="post">
    <?php

    // QUESTION: Wat doet ?? in de code-regel hier onder?
    // Antwoord: als $idTafel iets heeft, blijft het voor wat het is, als ie leeg is of NULL is, dan returnt ie als "false"
    $idTafel = $_GET['idtafel'] ?? false;
    if ($idTafel) {
        echo "<input type='hidden' name='idtafel' value='$idTafel'>";

        // DONE: alle producten ophalen uit de database en als inputs laten zien (maak gebruik van ProductModel class)
        // Zoiets als dit:
        // foreach ( ... ) {
        //      echo "<div>";
        //      echo "<label><input type='checkbox' name='products[]' value='{$idproduct}'>{$naam}</label>";
        //      echo "<label>Aantal:<input type='number' name='product{$idproduct}'></label>";
        //      echo "</div>";
        // }
        $p = new ProductModel();
        $producten = $p->getAll();
        echo "<form method='POST' action='bestellingdoorvoeren.php'";
        foreach($producten as $product){
            $idproduct = $product->getColumnValue('idproduct');
            $naam = $product->getColumnValue('naam');
            $prijs = $product->getColumnValue('prijs');
            echo "<div>";
            echo "<label><input type='checkbox' name='products[{$naam}]' value='{$idproduct}'>{$naam}</label>";
            echo " " . "<label>Aantal:<input type='number' value='0' onKeyDown='return false'";
            echo " name='products[{$naam}]'></label>";
            echo "</div>";
        }
        echo "<input type='submit' value='Doorgaan'></form>";
        $_POST['idtafel'] = $_GET['idtafel'];

    } else {
        // QUESTION: Wat gebeurt hier?
        // Antwoord: als er geen tafelID mee word gegeven laat ie een error zien.
        http_response_code(404);
        include('error_404.php');
        die();
    }

    ?>

</form>
</body>
</html>