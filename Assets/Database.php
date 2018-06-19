<?php
include(ROOT.'/Assets/config/db_params.php');
class Database {
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $name = DB_NAME;
    public $link;
    public function __construct() {
        $this->connectDB();
    }
    private function connectDB() {
        $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->name, $this->user, $this->pass, array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
    }
    public function insert($sql) {
        try {
            $this->link->exec($sql);
            return $this->link->lastInsertId();
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function select($sql) {
        if ($select_rows = $this->link->query($sql))
            return ($select_rows->fetchColumn() > 0) ? $this->link->query($sql) : false;
    }
    public function update($sql) {
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();
        }
        catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
    public function delete($sql) {
        try {
            $this->link->exec($sql);
            return 0;
        }
        catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
}