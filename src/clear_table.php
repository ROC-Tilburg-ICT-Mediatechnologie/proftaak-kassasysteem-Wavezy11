<?php
// clear_table.php
use Acme\classes\Rekening;

require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? null;

if ($idTafel) {
    $rekening = new Rekening();

    $rekening->clearTable($idTafel);
    echo "Table cleared for the next customer";
} else {
    echo "Error: Table ID not provided";
}
?>
