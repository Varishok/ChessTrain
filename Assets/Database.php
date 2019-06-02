<?php
include_once(ROOT.'/Assets/config/db_params.php');
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
        $this->link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    public function insert($sql) {
        try {
            $this->link->query($sql);
            return $this->link->insert_id;
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function select($sql) {
        try {
            if ($select_rows = $this->link->query($sql))
                return ($select_rows->fetch_array() > 0) ? $this->link->query($sql) : false;
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function update($sql) {
        try {
            $stmt = $this->link->query($sql);
            return $stmt;
        }
        catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
    public function delete($sql) {
        try {
            $stmt = $this->link->query($sql);
            return $stmt;
        }
        catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
}