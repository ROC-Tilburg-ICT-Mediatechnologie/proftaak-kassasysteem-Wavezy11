<?php
// reset_table.php
use Acme\classes\Rekening;

require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? null;

if ($idTafel) {
    $rekening = new Rekening();
    $rekening->resetTable($idTafel);
  
    echo "success";
} else {
    echo "error"; 
}
?>
