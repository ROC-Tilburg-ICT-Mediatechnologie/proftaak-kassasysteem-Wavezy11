<?php 
use Acme\model\TafelModel;
use Acme\system\Database;
use Acme\classes\rekening;
require "../vendor/autoload.php";
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rekening</title>
    </head>
    <body>

    <?php
    $idTafel = $_GET['idtafel'] ?? null;
    $envpath = __DIR__ . '/../.env';

    if ($idTafel) {
        // Maak een instantie van de Database-klasse
        $database = Database::getInstance($envpath);

        // Maak een instantie van de Rekening-klasse en geef de Database-instantie door
        $rekening = new Rekening($database, $idTafel);

        // Haal de rekening op
        $rekeningOutput = $rekening->getBill($idTafel);

        // Toon de rekening in HTML
        echo "<h1>Rekening</h1>";
        echo "<p>$rekeningOutput</p>";

        // TODO: bestelling op betaald zetten
    } else {
        http_response_code(404);
        include('error_404.php');
        die();
    }

    ?>

    </body>
    </html>
