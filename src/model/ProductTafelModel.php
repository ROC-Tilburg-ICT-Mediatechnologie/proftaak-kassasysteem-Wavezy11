<?php
namespace Acme\model;

use Acme\system\Database;

class ProductTafelModel extends Model
{
    protected static string $tableName = "product_tafel";
    protected static string $primaryKey = "idproduct_tafel";

    public function __construct($env = '../.env')
    {
        parent::__construct($env);
    }

    /**
     * @param array $bestelling
     * @return int
     */
    public function saveBestelling($bestelling): int
    {
        
        return $result;
    }

    /**
     * @param $idTafel
     * @return array
     */
    public function getBestelling($idTafel): array
    {
        $products = $this->getAll(['idtafel' => $idTafel, 'betaald' => 0]);

        $bestelling['idTafel'] = $idTafel;
        $bestelling['datumtijd'] = isset($products[0])
            ? (int)$products[0]->getColumnValue('datumtijd') : 0;
        $bestelling['betaald'] = 0;
        $bestelling['products'] = []; // Initialize the products array

        foreach ($products as $product) {
            $idProduct = $product->getColumnValue('idproduct');
            $bestelling['products'][] = $idProduct;
        }

        return $bestelling;
    }
}
