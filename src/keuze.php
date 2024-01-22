<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toevoegen of afrekenen</title>
    <link rel="stylesheet" href="index.css">
</head>
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
.hoi {
    height: 50px;
    width: 125px;
    background-color: green;
    border-radius: 15px;
    text-align: center;
    line-height: 40px;  
}
.doei {
    height: 50px;
    width: 125px;
    background-color: red;
    border-radius: 15px;
    text-align: center;
    line-height: 40px;  
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
    /* font-size: 30px; */
}

    </style>
<body>
<?php
$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
    
    echo "<div class='hoi'><a href='product.php?idtafel={$idTafel}'>toevoegen</a></div>";
    echo "<div class='doei'><a href='rekening.php?idtafel={$idTafel}'>afrekenen</a></div>";
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
</body>
</html>