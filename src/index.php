<?php

use Acme\model\TafelModel;
use Acme\system\Database;

require "../vendor/autoload.php";

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: navy;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #D3D3D3;
        }

        pre {
            height: 200px;
            width: 200px;
            font-size: 25px;
        }

        div {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
            font-size: 30px;
        }
    </style>
    <title>Kiezen tafel</title>
</head>
<body>
<pre>
<?php
    // Create an instance of Database
    $envpath = __DIR__ . '/../.env';

    // Maak een instantie van de Database-klasse
    $database = Database::getInstance($envpath);
    
    // Maak een instantie van de TafelModel-klasse en geef de Database-instantie door
    $tafelModel = new TafelModel($database);
    
    // Haal alle tafels op
    $tafels = $tafelModel->getAllTafels();
    
    // Nu kun je $tafels itereren of andere bewerkingen uitvoeren
    foreach ($tafels as $tafel) {
        $idTafel = $tafel->getColumnValue('idtafel');
        $omschrijving = $tafel->getColumnValue('omschrijving');
        // Doe iets met elke tafel, bijvoorbeeld:
        echo "<div><a href='keuze.php?idtafel={$idTafel}'>{$omschrijving}</a></div>";
    }
?>
</body>
</html>
