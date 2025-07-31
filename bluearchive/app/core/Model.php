<?php
abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    
    abstract public function all($filter = null);

    public function getDb() {
        return $this->db;
    }
}


?>