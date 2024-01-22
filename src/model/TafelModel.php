<?php

namespace Acme\model;

use Acme\system\Database;

class TafelModel extends Model
{
    protected static string $tableName = "tafel";
    protected static string $primaryKey = "idtafel";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }


    /**
     * Get all tafels
     *
     * @return array
     */
    public function getAllTafels(): array
    {
        return $this->getAll();
    }
}
