<?php
class Account {
    // database connection and table name
    private $conn;
    private $table_name = "Account";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($username, $password) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as p
                    WHERE p.Username = $username and p.Password = $password";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;    
    }
}