<?php

namespace Acme\classes;

use Acme\model\ProductTafelModel;
use Acme\model\TafelModel;
use Acme\system\Database;

class Rekening
{
    private ProductTafelModel $productTafelModel;
    private TafelModel $model;

    public function __construct(Database $db, $idTafel)
    {
        $this->productTafelModel = new ProductTafelModel();
        $this->idTafel = $idTafel;

        
        $this->model = new TafelModel($db);
    }

    public function getBill($idTafel)
    {
     
        $products = $this->model->getBestelling($idTafel);

        $output = "Rekening voor tafel $idTafel: ";

        foreach ($products['products'] as $idProduct) {
         
            $product = $this->productTafelModel->getBestelling($idProduct);

           
            $naam = isset($product['naam']) ? $product['naam'] : 'Onbekend';
            $prijs = isset($product['prijs']) ? $product['prijs'] : 0;

            $output .= "- $naam: $prijs ";
        }

        $total = $this->calculateTotal($products['products']);
        $output .= "Totaal: $total";

        return $output;
    }

  
    private function calculateTotal($products)
    {
    
        return 42; 
    }
    public function getBestelling($idTafel)
    {
     
        $query = "SELECT * FROM your_table WHERE idTafel = :idTafel";
        $params = [':idTafel' => $idTafel];

        $result = $this->db->query($query, $params);

      
        return $result;
    }
}
