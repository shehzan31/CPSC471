<?php

class Orders {

    // database connection and table name
    private $conn;
    private $table_name = "Orders";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($Doctor_ID, $H_number, $Test_id) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_number, Test_id) VALUES
        (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$Doctor_ID, $H_number, $Test_id]);
        return $stmt;
    }
}