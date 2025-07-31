<?php
class Database {
    protected $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=blue_archive", "root", "");
    }
    public function getConnection() {
        return $this->pdo;
    }
}
?>