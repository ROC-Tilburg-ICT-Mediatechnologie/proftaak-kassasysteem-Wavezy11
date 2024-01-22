<?php
namespace Acme\model;

use Acme\system\Database;

use \PDO; 
class Model
{
    protected Database $db;

    public function __construct($env = '../.env')
    {
        $this->db = Database::getInstance($env);
    }
    
        public function setColumnValue($column, $value)
        {
            $this->columns[$column] = $value;
        }
    
        public function getColumnValue($column)
        {
            return $this->columns[$column];
        }
    
     
        public function save(): int
        {
            $query = "REPLACE INTO " . static::$tableName . " (" . implode(
                    ",",
                    array_keys(
                        $this->columns
                    )
                ) . ") VALUES(";
            $keys = array();
            foreach ($this->columns as $key => $value) {
                $keys[":" . $key] = $value;
            }
            $query .= implode(",", array_keys($keys)) . ")";
            $s = $this->db->getPreparedStatement($query);
            $s->execute($keys);
            return $this->db->lastInsertId();
        }
    
   
        public function delete($id)
        {
            $query = "DELETE FROM " . static::$tableName . " WHERE "
                . static::$primaryKey . "=:id LIMIT 1";
            $s = $this->db->getPreparedStatement($query);
            $s->execute(array(':id' => $id));
        }
    
        private function createFromDb($column)
        {
            if (is_array($column) && !empty($column)) {
                foreach ($column as $key => $value) {
                    $this->columns[$key] = $value;
                }
            } else {
                $this->columns = [];
            }
        }   
    
        /**
         * Get all items
         * Conditions are combined by logical AND
         *
         * @example getAll(array(name=>'Bond',job=>'artist'),'age DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND job='artist' ORDER BY age DESC LIMIT 0,25
         */
        public function getAll(
            $condition = array(),
            $order = null,
            $startIndex = null,
            $count = null
        ) {
            $query = "SELECT * FROM " . static::$tableName;
            if (!empty($condition)) {
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:" . $key . " AND ";
                }
            }
            $query = rtrim($query, ' AND ');
            if ($order) {
                $query .= " ORDER BY " . $order;
            }
            if ($startIndex !== null) {
                $query .= " LIMIT " . $startIndex;
                if ($count) {
                    $query .= "," . $count;
                }
            }
            return $this->get($query, $condition);
        }
    
        /**
         * Pass a custom query and condition
         *
         * @example get('SELECT * FROM TABLE WHERE name=:user OR age<:age',array(name=>'Bond',age=>25))
         */
        public function get($query, $condition = array())
        {
            $s = $this->db->getPreparedStatement($query);
            foreach ($condition as $key => $value) {
                $condition[':' . $key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $result = $s->fetchAll(PDO::FETCH_ASSOC);
            $collection = array();
            $className = get_called_class();
            foreach ($result as $row) {
                $item = new $className();
                $item->createFromDb($row);
                array_push($collection, $item);
            }
            return $collection;
        }
    
        public function getOne(
            $condition = array(),
            $order = null,
            $startIndex = null
        ) {
            $query = "SELECT * FROM " . static::$tableName;
            if (!empty($condition)) {
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:" . $key . " AND ";
                }
            }
            $query = rtrim($query, ' AND ');
            if ($order) {
                $query .= " ORDER BY " . $order;
            }
            if ($startIndex !== null) {
                $query .= " LIMIT " . $startIndex . ",1";
            }
            $s = $this->db->getPreparedStatement($query);
            foreach ($condition as $key => $value) {
                $condition[':' . $key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $row = $s->fetch(PDO::FETCH_ASSOC);
            $className = get_called_class();
            $item = new $className();
            $item->createFromDb($row);
            return $item;
        }
    
        public function getByPrimaryKey($value)
        {
            $condition = array();
            $condition[static::$primaryKey] = $value;
            return $this->getOne($condition);
        }
    
        /**
         * Get the number of items
         */
        public function getCount($condition = array()): int
        {
            $query = "SELECT COUNT(*) FROM " . static::$tableName;
            if (!empty($condition)) {
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:" . $key . " AND ";
                }
            }
            $query = rtrim($query, ' AND ');
            $s = $this->db->getPreparedStatement($query);
            foreach ($condition as $key => $value) {
                $condition[':' . $key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $countArr = $s->fetch();
            return $countArr[0];
        }
    }