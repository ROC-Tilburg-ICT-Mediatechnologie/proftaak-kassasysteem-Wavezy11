<?php

use Acme\classes\Rekening;

require "../vendor/autoload.php";

$idTafel = $_POST['idTafel'] ?? null;

if ($idTafel) {
    $rekening = new Rekening($idTafel);
    
    $rekening->setPaid($idTafel);
    echo "Payment successful";
} else {
    echo "Error: Table ID not provided";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button onclick="window.location.href='index.php'">hoofdpagina</button>
</body>
</html>
