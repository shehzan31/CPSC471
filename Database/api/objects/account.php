<?php
class Account {
    // database connection and table name
    private $conn;
    private $table_name1 = "Patient_account";
    private $table_name2 = "Doctor_account";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($username, $password) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name1 as p
                    WHERE p.Username = $username";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        if ($stmt->rowCount() != 1) {
            $query =   "SELECT *
                        FROM $this->database.$this->table_name2 as p
                        WHERE p.Username = $username and p.Password = $password";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        return $stmt;
    }
}