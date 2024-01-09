<?php

use Acme\classes\Rekening;

require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? null;
if ($idTafel) {
    // TODO: bestelling ophalen en tonen op een mooie manier door gebruik te maken van Rekening.php
    // $rekening = new Rekening($idTafel);

     $rekening = new Rekening();

    $orderDetails = $rekening->getBill($idTafel);

    if (!empty($orderDetails)) {
 
        echo "<h1>Order Details for Table $idTafel</h1>";
        echo "<p>Date: {$orderDetails['datumtijd']['formatted']}</p>";
        echo "<ul>";
        foreach ($orderDetails['products'] as $idProduct => $productDetails) {
            echo "<li>{$productDetails['data']['product']} - Quantity: {$productDetails['aantal']}</li>";
        }
        echo "</ul>";

        // TODO: bestelling op betaald zetten
        $rekening->setPaid($idTafel);
    }

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welkom</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>