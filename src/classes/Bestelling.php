<?php
// Bestelling.php
namespace Acme\classes;

use Acme\model\ProductTafelModel;
use DateTime;

class Bestelling
{
    private int $idTafel;
    private array $products; 
    private bool $paid;
    private int $dateTime;

    public function __construct(int $idTafel)
    {
        $this->idTafel = $idTafel;
        $this->products = array();
        $this->dateTime = (new DateTime)->getTimestamp();
    }

    /**
     * @param array $products array van idproducts
     */
    public function addProducts(array $products): void
    {
        foreach ($products as $product) {
           
            if (isset($this->products[$product])) {
              
                $this->products[$product]++;
            } else {
             
                $this->products[$product] = 1;
            }
        }
    }

    public function delProduct(int $idProduct): void
    {
        if (isset($this->products[$idProduct])) {
          
            if ($this->products[$idProduct] > 1) {
                $this->products[$idProduct]--;
            } else {
                unset($this->products[$idProduct]);
            }
        }
    }

    public function resetProducts(): void
    {
        $this->products = array();
    }

    public function saveBestelling($env = '../.env'): int
    {
        $bm = new ProductTafelModel($env);
        return $bm->saveBestelling($this->getBestelling());
    }

    public function getBestelling(): array
    {
        return [
            'idtafel'  => $this->idTafel,
            "products" => $this->products,
            "datetime" => $this->dateTime
        ];
    }
}
