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
    // Antwoord: is een Null Coalescing Operator..
    $idTafel = $_GET['idtafel'] ?? false;
    if ($idTafel) {
        echo "<input type='hidden' name='idtafel' value='$idTafel'>";

        // TODO: alle producten ophalen uit de database en als inputs laten zien (maak gebruik van ProductModel class)
        // Zoiets als dit:
        


        $productmodel = new \Acme\model\ProductModel();
    $products = $productmodel->getAllProducts();
   
    
 

        foreach ($products as $product) {
            $idproduct = $product['idproduct'];
            $naam = $product['naam'];
            $prijs = $product['prijs'];
             echo "<div>";
             echo "<input type='checkbox' name='products[]' value='{$idproduct}'>{$naam}";
             echo "Aantal:<input type='number' name='product{$idproduct}'>";
             echo "</div>";
        }
        echo "<button>Volgende</button>";
    } else {
        // QUESTION: Wat gebeurt hier?
        // Antwoord: als er een error verschijnt breekt de website af.
        http_response_code(404);
        include('error_404.php');
        die();
    }
    ?>

</form>
</body>
</html>
