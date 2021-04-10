<?php
class Database {

    //specifiy database credentials
    private $dbhost = "cpsc-471.c4emtqoxkf0g.us-east-2.rds.amazonaws.com";
    private $dbport = "3306";
    private $dbname = "HealthDatabase";
    private $charset = 'utf8';

    private $username = "admin";
    private $password = "?2Y\$CBeL*J=txYpU";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->dbhost . ";port=" . $this->dbport . ":dbname=" . $this->dbname . ";charset=" . $this->charset, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

}

?>